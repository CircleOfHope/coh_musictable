<a onclick="$('div#inline_howto').removeAttr('hidden')">Are you new here? Click me!</a>
<div id="inline_howto" hidden="hidden">
Welcome to the Music Table! There are a few things you should know about the Table and how to use it:
<ol>
<li>Enter a keyword or several in the text box (see table below for enhancements to multi-word search).</li>
<li>You can limit your search to songs with particular tags listed in the multi-selects. (Shift-click and Ctrl-click may help.)</li>
<li>There is a "Non-English" shortcut button that selects every language but English for you.</li>
<li>Report issues/fixes to <a href="mailto:luke&commat;circleofhope.net">luke&commat;circleofhope.net</a></li>
</ol>
<table id="search_syntax_help" name="search_syntax_help" class="search_syntax_help">
<th colspan="2">Search Syntax Help</th>
<tr><td>+praise</td><td>all results must contain this word</td></tr>
<tr><td>-praise</td><td>show no results that match this word</td></tr>
<tr><td>prais*</td><td>show results for praise, praised, praises, praising, etc. (only works for suffixes)</td></tr>
<tr><td colspan="2">For a more complete selection, see <a href="https://dev.mysql.com/doc/refman/5.5/en/fulltext-boolean.html">here</a>.</td></tr>
</table>
</div>
<h1>Music Database</h1>
<br />
<form id="index_search_form" action="<?=site_url('songs/index')?>" method="post">
<div>
        <input type="hidden" id="pageno" name="pageno" value="1">
	<input id="search_string" name="search_string" type="text" style="width: 200px" value="<?php if(isset($search_string)) echo $search_string; ?>" />
        <button type="button" onclick="javascript:for(i=0;i<$('#tagtype_Language\\[\\]')[0].children.length;i++){if($('#tagtype_Language\\[\\]')[0].children[i].text == 'English'){$('#tagtype_Language\\[\\]')[0].children[i].selected=false;}else{$('#tagtype_Language\\[\\]')[0].children[i].selected=true;}}">Non-English</button>
        <button type="button" onclick="javascript:$('option').removeAttr('selected');$('#search_string').val('');">Clear Form</button>
	<button type="submit" name="submit_btn" class="button" id="submit_btn">Search</button><br />
</div>
<br />
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
<br />
<?php if($admin) { ?><a href="<?= site_url('songs/edit/0') ?>">Add New Song</a><?php } ?>
<div id="results-table">
	<?=$table?>
</div>
