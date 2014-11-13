<h1>Music Database</h1>
<form id="index_search_form" action="<?=site_url('songs/index')?>" method="post">
	<div>
<?
$checked = ' checked="checked"';
?>
		<span><input type="radio" name="language" value="1" <?= $language == 1 ? $checked : '' ?> />English</span>
		<span><input type="radio" name="language" value="2" <?= $language == 2 ? $checked : '' ?> />Non-English</span>
		<span><input type="radio" name="language" value="3" <?= $language == 3 ? $checked : '' ?> />Both</span>
	</div>
	<input id="search_string" name="search_string" type="text" style="width: 180px" value="<?php if(isset($search_string)) echo $search_string; ?>" />
	<button type="submit" name="submit" class="button" id="submit_btn">Search</button>
</form>
<?php if($admin) { ?><a href="<?= site_url('songs/edit/0') ?>">Add New Song</a><?php } ?>
<div id="results-table">
	<?=$table?>
</div>
