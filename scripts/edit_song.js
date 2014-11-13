function ToggleTag(tagEl) {
	var songId = $('#edit-song').data('song-id');
	var isOn = $(tagEl).hasClass('selected');
	var id = $(tagEl).data('key');
	if (isOn) {
		console.log(String.format('Removing tag {0} from song {1}', id, songId));
		$.post(base_url + 'ajax/remove_tag_from_song', { tagid: id, songid: songId })
			.success(function () { console.log('Remove tag successful'); });
	} else {
		console.log(String.format('Adding tag {0} from song {1}', id, songId));
		$.post(base_url + 'ajax/add_tag_to_song', { tagid: id, songid: songId })
			.success(function () { console.log('Add tag successful'); });
	}
	$(tagEl).toggleClass('selected');
}

function ToggleLanguage(languageEl) {
	var songId = $('#edit-song').data('song-id');
	var isOn = $(languageEl).hasClass('selected');
	var id = $(languageEl).data('key');
	if (isOn) {
		console.log(String.format('Removing language {0} from song {1}', id, songId));
		$.post(base_url + 'ajax/remove_language_from_song', { langid: id, songid: songId })
			.success(function () { console.log('Remove language successful'); });
	} else {
		console.log(String.format('Adding language {0} from song {1}', id, songId));
		$.post(base_url + 'ajax/add_language_to_song', { langid: id, songid: songId })
			.success(function () { console.log('Add language successful'); });
	}
	$(languageEl).toggleClass('selected');
}

function DeleteAttachment(buttonEl) {
	if (!confirm('Are you sure you want to delete this attachment?')) return;

	var attachmentId = $(buttonEl).closest('tr').data('key');
	console.log(String.format('Deleting attachment {0}', attachmentId));
	$.post(base_url + 'ajax/remove_attachment', { id: attachmentId }).success(function () {
		console.log('Delete attachment successful');
		window.location.reload();
	});
}

function CreateAttachment() {
	if ($('#dlgNewAttachment form').validate().form() != true) return;

	var songId = $('#edit-song').data('song-id');
	var name = $('#txtNewAttachmentName').val();
	var url = $('#txtNewAttachmentUrl').val();
	console.log(String.format('Creating attachment for song {0}', songId));
	$.post(base_url + 'ajax/create_attachment', { songid: songId, name: name, url: url }).success(function () {
		console.log('Create attachment successful');
		window.location.reload();
	});
}

$(document).ready(function () {

	jQuery.extend(jQuery.validator.messages, {
		required: '&nbsp;*'
	});

	$('#edit-song').validate({});

	$('.attachment-delete').button({ icons: { primary: 'ui-icon-closethick' }, text: false })
		.click(function (e) { DeleteAttachment(this); });

	$('#dlgNewAttachment form').validate();
	$('#cmdShowNewAttachmentForm').click(function (e) {
		$('#dlgNewAttachment').dialog(
		{
			modal: true,
			buttons: {
				"Create": CreateAttachment,
				Cancel: function () { $(this).dialog("close"); }
			},
			beforeClose: function () {
				$('#dlgNewAttachment input').val("");
				$('#dlgNewAttachment form').validate().resetForm();
			}
		});
	});

	$('.tag').click(function (e) { ToggleTag(this); });
        $('.language').click(function (e) { ToggleLanguage(this); });

});
