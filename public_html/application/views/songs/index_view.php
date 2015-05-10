<a onclick="$('div#inline_howto').removeAttr('hidden')">Are you new here? Click me!</a>
<div id="inline_howto" hidden="hidden">
Welcome to the Music Table! There are a few things you should know about the Table and how to use it:<br />
<br />
1) You can choose between English and Non-English or Both for searching.<br />
2) You can search by keywords. Some of the main keywords we use are: Hymn, Declarative, Gospel, Psalm, Christmas, and Lent.<br />
3) Report issues/fixes to <a href="mailto:luke&commat;circleofhope.net">luke&commat;circleofhope.net</a><br />
</iframe></div>
<h1>Music Database</h1>
<form id="index_search_form" action="<?=site_url('songs/index')?>" method="post">
<div>
        <input type="hidden" id="pageno" name="pageno" value="1">
	<input id="search_string" name="search_string" type="text" style="width: 180px" value="<?php if(isset($search_string)) echo $search_string; ?>" />
        <button type="button" onclick="javascript:$('option').removeAttr('selected');$('#search_string').val('');">Clear Form</button>
	<button type="submit" name="submit_btn" class="button" id="submit_btn">Search</button><br />
</div>
<div>
<?php foreach ($allltags as $tagtypename => $tag) { ?>
<div style="display:inline-block">
    <label  style="display:block" for="tagtype_<?=$tagtypename?>[]"><?=$tagtypename?></label>

    <select id="tagtype_<?=$tagtypename?>[]" name="tagtype_<?=$tagtypename?>[]" multiple="multiple" title="<?=$tagtypename?>">
    <?php foreach ($tag as $tagid => $t) { ?>
    <option value="<?= $tagid ?>" <?php if(in_array($tagid, $selected_tags_flat)) { echo 'selected="selected"'; } ?>><?= $t ?></option>
    <?php } ?>
    </select>
</div>
<?php } ?>
</div>
</form>
<?php if($admin) { ?><a href="<?= site_url('songs/edit/0') ?>">Add New Song</a><?php } ?>
<div id="results-table">
	<?=$table?>
</div>
