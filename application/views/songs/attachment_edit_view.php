<?php
$options = array('Lyrics'=>'Lyrics','Video'=>'Video','PDF'=>'PDF','MP3'=>'MP3');
echo form_label('Type','attachment_type_'.$attachment->id);
echo form_dropdown('attachment_type_'.$attachment->id,$options,$attachment->Name);
echo form_label('URL','attachmend_url_'.$attachment->id);
?>
<input type="text" name="attachment_url_<?=$attachment->id?>" size="100" value="<?=$attachment->Url?>"  />
<?php
echo form_label('DELETE?', 'attachment_delete_'.$attachment->id);
echo form_checkbox('attachment_delete_'.$attachment->id, FALSE);
if($new) {
?>
<input type="hidden" name="attachment_new_<?=$attachment->id?>" value="checked"  />
<?php }?>
<br />
