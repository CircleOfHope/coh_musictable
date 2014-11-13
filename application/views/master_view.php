<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="The music database for Circle of Hope, a Christian church in Philadelphia Pennsylvania." />
<meta name="keywords" content="music database table jesus circle of hope philadelphia christian" />
<title>CoH Music Table | Music</title>
<?=link_tag("css/site.css")?>
<?=link_tag("css/song.css")?>
<script	src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
window.debug = <?= $this->config->item('log_threshold') >= 2 ? "true" : "false" ?>;
window.base_url = '<?= base_url() ?>';
</script>
</head>
<body>
<div id="center-pane">
  
  <!-- Header start -->
  <div id="page-header">
    <?=$header?>
  </div>
  <!-- Header end -->

  <!-- Content start-->
  <div id="page-content">
    <?=$content?>
  </div>
  <!-- Content end -->
  
  <!-- Footer start -->
  <div id="page-footer">
    <?=$footer?>
  </div>
  <!-- Footer end -->

</div>
</body>
</html>
