<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js" type="text/javascript"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js" type="text/javascript"></script>
<script src="http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js" type="text/javascript"></script>
<script	src="<?= base_url("/scripts/shared.js") ?>"></script>
<script	src="<?= base_url("/scripts/edit_song.js") ?>"></script>

<?php if ($showUpdated) { ?>
  <div class="floating-info">Song saved</div>
<script>
  $('.floating-info').delay(3000).fadeOut();
</script>
<?php } ?>
<h1><?= $song->Title ?></h1><?= anchor('songs/detail/'.$song->id,'[Detail]') ?>
<div class="line"></div>

<div class="column-one">

  <form id="edit-song" data-song-id="<?= $id ?>" action='<?= site_url("songs/edit/".$id); ?>' method="post">
      
    <table>
      <tr>
        <td><label for="title">Title</label></td>
        <td><input id="title" name="title" type="text" class="required" value="<?= $song->Title ?>" /></td>
      </tr>
      <tr>
        <td><label for="artist">Artist</label></td>
        <td><input id="artist" name="artist" type="text" value="<?= $song->Artist ?>" /></td>
      </tr>
      <tr>
        <td><label for="scripture">Scripture</label></td>
        <td><input id="scripture" name="scripture" type="text" value="<?= $song->Scripture ?>" /></td>
      </tr>
      <tr>
        <td><label for="lyrics-excerpt">Lyrics Excerpt</label></td>
        <td><input id="lyrics-excerpt" name="lyricsexcerpt" type="text" value="<?= $song->LyricsExcerpt ?>" /></td>
      </tr>
      <tr>
        <td valign="top"><label for="notes">Notes</label></td>
        <td><textarea id="notes" name="notes"><?= $song->Notes ?></textarea></td>
      </tr>
      <tr>
        <td><label for="quarantined">Quarantined</label></td>
        <td><input type="checkbox" name="quarantined" value="quarantined" <?= ($song->Quarantined) ? "checked=\"checked\"" : "" ?> /></td>
      </tr>
    </table>

    <br />
    <button type="submit" name="submit" class="button" id="submit_btn"><?= $id != 0 ? 'Update' : 'Add' ?></button>
  </form>    
</div>

<div class="column-two">

<?php foreach ($allltags as $tagtypename => $tag) { ?>
    <h4><?= $tagtypename ?></h4>
    <div class="line"></div>
    <?php if ($id == 0) { ?>
  <p class="gray-message">Save the song before adding tags.</p>
  <?php } else { ?>
  <ul class="basic horizontal tags edit">
    <?php foreach ($tag as $tagid => $t) { ?>
    <li data-key="<?= $tagid ?>" class="tag iecss3 <?= array_key_exists($tagid, $tags) ? "selected" : "" ?>"><?= $t ?></li>
    <?php } ?>
  </ul>
  <div class="clear"></div>
  <?php } ?>
<?php } ?>
  <a id="cmdShowNewTagForm" href="javascript:void(0);" title="New tag">New Tag</a>
  <h4>Attachments</h4>
  <div class="line"></div>
<?php if ($id == 0) { ?>
  <p class="gray-message">Save the song before adding attachments.</p>
<?php } else { ?>
  <table>
    <?php foreach ($attachments as $a) { ?>
    <tr data-key="<?= $a->id ?>">
    <td><a href="<?= MiscUtil::standardizeUrl($a->Url) ?>" title="<?= $a->Name ?>" target="_blank"><?= $a->Name ?></a><button class="small-button attachment-delete">Delete</button></td>
    </tr>
    <?php } ?>
    <tr>
      <td><a id="cmdShowNewAttachmentForm" href="javascript:void(0);" title="New attachment">New Attachment</a></td>
    </tr>
  </table>
<?php } ?>
</div><!-- .column-two -->

<div class="clear"></div>

<div id="dlgNewAttachment" style="display: none" title="New attachment">
  <form class="dialog">
    <fieldset>
      <label for="txtNewAttachmentName">Name</label>
      <input id="txtNewAttachmentName" name="name" type="text" class="required text ui-widget-content ui-corner-all" />
      <label for="txtNewAttachmentUrl">URL</label>
      <input id="txtNewAttachmentUrl" name="url" type="text" class="required ui-widget-content ui-corner-all" />
    </fieldset>
  </form>
</div>

<div id="dlgNewTag" style="display: none" title="New tag">
  <form class="dialog">
    <fieldset>
      <label for="txtNewTagName">Name</label>
      <input id="txtNewTagName" name="name" type="text" class="required text ui-widget-content ui-corner-all" />
      <label for="txtNewTagType">TagType</label>
      <select id="txtNewTagType" name="tagtype" class="required ui-widget-content ui-corner-all">
      <?php foreach ($alltagtypes as $tagtypeid => $tagtypename) { ?>
      <option value="<?= $tagtypeid ?>"><?= $tagtypename ?></option>
      <?php } ?>
      </select>
    </fieldset>
  </form>
</div>
