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
    <?php $count = 1; foreach($songs as $song): ?>
    <tr <?php if($count % 2 == 0) echo 'class="alt"'; ?>>
      <td><?=$song->Title?></td>
      <td><?=$song->Artist?></td>
      <td><?=$song->LyricsExcerpt?></td>
      <td></td>
      <td></td>
      <td><a href="<?=site_url("songs/detail/$song->id")?>">View</a></td>
      <td><?php if($admin) { ?><a href="<?=site_url("songs/edit/$song->id")?>">Edit</a><?php } ?></td>
    </tr>
    <?php $count++; endforeach; ?>
  </tbody>
</table>
<?php if (isset($url)) { HtmlUtil::writePagingLinks($url, $page_index, $total_pages, array(
    "search_string" => $search_string,
    "language" => $language
)); } ?>
