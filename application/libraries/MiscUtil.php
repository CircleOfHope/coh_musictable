<?php

class MiscUtil
{

    public static function getRequestItem($key, $default = null)
    {
        $ci = &get_instance();
        $val = $ci->input->post($key);
        if ($val != false) return $val;
        $val = $ci->input->get($key);
        if ($val != false) return $val;
        return $default;
    }

    public static function getRequestItemInt($key, $default = null)
    {
        return intval(self::getRequestItem($key, $default));
    }
    
    public static function startsWith($string, $subString)
    {
        return !strncmp($string, $subString, strlen($subString));
    }
    
    public static function standardizeUrl($url)
    {
        if (strpos($url, '://') === false)
            return 'http://' . $url;
        else
            return $url;
    }

}
