/* String Extentions */
String.format = function () {
	var s = arguments[0];
	for (var i = 0; i < arguments.length - 1; i++) {
		var reg = new RegExp("\\{" + i + "\\}", "gm");
		s = s.replace(reg, arguments[i + 1]);
	}

	return s;
}

String.prototype.endsWith = function (suffix) {
	return (this.substr(this.length - suffix.length) === suffix);
}

String.prototype.startsWith = function (prefix) {
	return (this.substr(0, prefix.length) === prefix);
}

String.prototype.trim = function () {
	return $.trim(this);
}

/* Functions Extentions */
// Redirects the 'this' scope and other arguments and appends them after the method's explicitly provided arguments
// usage: var callback = fx.redirect(this1, arg1, arg2);
// then: this2.callback(arg3, arg4);
// which will translate to: this1.fx(arg1, arg2, this2, arg3, arg4)
Function.prototype.redirect = function (context) {
	var method = this;
	var outerArgs = Array.prototype.slice.call(arguments, 1);
	return function () {
		var newArgs = Array.prototype.slice.call(arguments);
		newArgs.unshift(this);
		var args = outerArgs.concat(newArgs);
		method.apply(context, args);
	};
}

// Captures the 'this' scope and returns a function which restores it when it is called, overwriting the current 'this' scope.
// usage: var callback = fx.delegate(this1, arg1, arg2);
// then: this2.callback(arg3, arg4);
// which will translate to: this1.fx(arg1, arg2, arg3, arg4)
Function.prototype.delegate = function (context) {
	var method = this;
	var outerArgs = Array.prototype.slice.call(arguments, 1);
	return function () {
		var newArgs = Array.prototype.slice.call(arguments);
		var args = outerArgs.concat(newArgs);
		method.apply(context, args);
	};
}

/* Array Extentions */
Array.prototype.remove = function (s) {
	var i = this.indexOf(s);
	if (i != -1) this.splice(i, 1);
}

/* Custom jQuery method */
$.postJson = function (url, jsonString, success) {
	return $.ajax({
		type: 'POST',
		url: url,
		data: jsonString,
		dataType: 'json',
		contentType: 'application/json; charset=utf-8',
		success: success
	});
}

/* Logging and error handling */
// This creates a dummy console object for us, if it doesn't exist, to write traces to
if (!('console' in this)) console = {};
'log info warn error dir clear'.replace(/\w+/g, function (f) {
	if (!(f in console)) console[f] = console.log || new Function;
});

function LogError(message) {
	if (window.logErrorRan)
		return;

	window.logErrorRan = true;
	if (window.debug)
		alert(message);

	//$.post(window.root + '/support/logjavascripterror', { error: message }); // TODO
}

$(document).ajaxError(function (event, xhr, ajaxOptions, thrownError) {
	if (thrownError == "")
		return;

	var message = String.format('Failed to call \'{0}\' because \'{1}\'', ajaxOptions.url, thrownError);
	LogError(message);
});

/* ValidValueBinding for KO */
ValidValueBinding = function (validator) {
	this.validator = validator;
	this.init = this.init.delegate(this);
	this.update = this.update.delegate(this);
}

ValidValueBinding.prototype.init = function (element, valueAccessor) {

	$(element).change(this.elementOnChange.redirect(this, valueAccessor));
}

ValidValueBinding.prototype.update = function (element, valueAccessor) {

	var value = ko.utils.unwrapObservable(valueAccessor());
	$(element).val(value);
}

ValidValueBinding.prototype.elementOnChange = function (valueAccessor, element) {

	var value = $(element).val();
	if (value == '')
		value = null;

	var valid = this.validator.element(element); // runs validation for this element
	if (!valid)
		return;

	var observable = valueAccessor();
	observable(value);
}
