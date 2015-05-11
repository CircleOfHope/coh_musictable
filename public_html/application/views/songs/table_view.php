<table style="margin-top: 10px" class="spaced">
  <thead>
    <tr>
      <th>Title</th>
      <th>Artist</th>
      <th>First Line</th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
   <?php foreach($songs as $song) { ?>
    <tr class="search_result_row">
      <td><?=$song->Title?></td>
      <td><?=$song->Artist?></td>
      <td><?=$song->LyricsExcerpt?></td>
      <td></td>
      <td></td>
      <td><a href="<?=site_url("songs/detail/$song->id")?>">View</a></td>
      <td><?php if($admin) { ?><a href="<?=site_url("songs/edit/$song->id")?>">Edit</a><?php } ?></td>
    </tr>
     <?php } ?>
  </tbody>
</table>
<?php HtmlUtil::writePagingLinks("", $page_index, $total_pages); ?>
