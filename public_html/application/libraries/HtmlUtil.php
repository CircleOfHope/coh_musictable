<?php

class HtmlUtil
{
  public static function getAnchor($link, $pageno, $fake, $text = '')
  {
    if($text == '')
      $text = $pageno;
    if($fake)
      return "&nbsp;$text&nbsp;";
    else
      return "&nbsp;<a onclick=\"javascript:document.forms.index_search_form.pageno.value = $pageno;document.forms.index_search_form.submit();return false;\" href=\"$link/$pageno\">$text</a>&nbsp;";
  }

  public static function writePagingLinks($link, $currentIx, $totalPages)
  {
    echo "<div class=\"paging-links\">";
    echo HtmlUtil::getAnchor($link, 1, $currentIx == 1, "&lt;&lt;");
    echo HtmlUtil::getAnchor($link, $currentIx-1, $currentIx == 1, "&lt;");
    for ($x = 1; $x <= $totalPages; $x++)
    {
      if ($x == $currentIx)
        echo "&nbsp;$x&nbsp;";
      else
      {
        echo HtmlUtil::getAnchor($link, $x, False);
      }
    }
    echo HtmlUtil::getAnchor($link, $currentIx+1, $currentIx == $totalPages, "&gt;");
    echo HtmlUtil::getAnchor($link, $totalPages, $currentIx == $totalPages, "&gt;&gt;");
    echo "</div>";
  }
}