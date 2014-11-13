<?php

class SqlUtil
{
  public static function constructWhere($clauses)
  {
    if (count($clauses) == 0)
      return "";
    
    return implode(" AND ", $clauses); 
  }  
}
