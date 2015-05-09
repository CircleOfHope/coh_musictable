<?php

class HtmlUtil
{
  public static function writePagingLinks($link, $currentIx, $totalPages, $queryStringParams)
  {
    echo "<div class=\"paging-links\">";
    for ($x = 0; $x < $totalPages; $x++)
    {
      if ($x == $currentIx)
        echo sprintf("<span>%d</span>", $x + 1);
      else
      {
        $pageLink = $link . (strpos($link, '?') !== false ? "&" : "?");
        $pageLink .= "p=" . ($x + 1);
        if (isset($queryStringParams))
        {
          foreach ($queryStringParams as $key => $val)
          {
            $pageLink .= sprintf("&%s=%s", $key, urlencode($val));
          }
        }
        echo sprintf("<a href=\"%s\">%d</a>", $pageLink, $x + 1);
      }
      
      if ($x + 1 < $totalPages)
        echo "&nbsp;<b>|</b>&nbsp;";
    }
    echo "</div>";
  }
}