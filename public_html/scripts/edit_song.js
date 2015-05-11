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

function DeleteTag(buttonEl) {
	if (!confirm('Are you sure you want to delete this tag?')) return;

	var tagId = $(buttonEl).closest('tr').data('key');
	console.log(String.format('Deleting tag {0}', tagId));
	$.post(base_url + 'ajax/remove_tag', { id: tagId }).success(function () {
		console.log('Delete tag successful');
		window.location.reload();
	});
}

function CreateTag() {
	if ($('#dlgNewTag form').validate().form() != true) return;

	var name = $('#txtNewTagName').val();
	var tagtype = $('#txtNewTagType').val();
	console.log('Creating tag');
	$.post(base_url + 'ajax/add_tag', {name: name, tagtypeid: tagtype }).success(function () {
		console.log('Create tag successful');
		window.location.reload();
	});
}

$(document).ready(function () {

	jQuery.extend(jQuery.validator.messages, {
		required: '&nbsp;*Required field*'
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

	$('#dlgNewTag form').validate();
	$('#cmdShowNewTagForm').click(function (e) {
		$('#dlgNewTag').dialog(
		{
			modal: true,
			buttons: {
				"Create": CreateTag,
				Cancel: function () { $(this).dialog("close"); }
			},
			beforeClose: function () {
				$('#dlgNewTag input').val("");
				$('#dlgNewTag form').validate().resetForm();
			}
		});
	});

	$('.tag').click(function (e) { ToggleTag(this); });
});
