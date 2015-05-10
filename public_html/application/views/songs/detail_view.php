<h1><?=$song->Title ?></h1><?php if($admin){echo anchor('songs/edit/'.$song->id,'[Edit]');}?>
<div class="line"></div>

<div class="column-one">
        <?=($song->Quarantined)?'<span class="quarantine">This song is under quarantine.</span>':''?>
	<table class="spaced">

		<tr>
			<td>Title</td>
                        <td><?=$song->Title?></td>
		</tr>
		<tr>
			<td>Artist</td>
			<td><?=$song->Artist?></td>
		</tr>
		<tr>
			<td>Scripture</td>
			<td><?=$song->Scripture?></td>
		</tr>
		<tr>
			<td>Lyrics Excerpt</td>
			<td><?=$song->LyricsExcerpt?></td>
		</tr>
	</table>

	<div style="margin-top: 10px">Notes</div>
	<p><?=$song->Notes?></p>

	<h4>Attachments</h4>
	<table style="margin-top: 10px" class="spaced">
		<tr>
			<th>Name</th>
			<th>Location</th>
			<th></th>
                </tr>
                <?php $count = 1; ?>
                <?php foreach($attachments as $attachment): ?>
                <tr<?=($count%2==0)?" class=\"alt\"":"";?>>
                <td><?=$attachment->Name?></td>
                <td><?=parse_url($attachment->Url, PHP_URL_HOST)?></td>
                <td><a target="_blank" href="<?=$attachment->Url?>">View</a></td>
                <td><button onclick="$('iframe#attachment_viewer').attr('src','<?=$attachment->Url?>').attr('width',800).attr('height',600).attr('frameborder',1).removeAttr('hidden')">Inline</button></td>
                </tr>
                <?php $count++; endforeach; ?>
	</table>
<div id="inline_attachments"><iframe hidden="hidden" id="attachment_viewer" name="attachment_viewer" src="" width="0" height="0" frameborder="0"></iframe></div>
</div>

<div class="column-two">

<?php foreach ($allltags as $tagtypename => $tag) { ?>
    <h4><?= $tagtypename ?></h4>
    <div class="line"></div>
  <ul class="basic horizontal tags">
    <?php foreach ($tag as $tagid => $t) { ?>
    <?php if(array_key_exists($tagid, $tags)) { ?>
    <li data-key="<?= $tagid ?>" class="tag iecss3"><?= $t ?></li>
    <?php } } ?>
  </ul>
  <div class="clear"></div>
<?php } ?>

</div>

<div class="clear"></div>
