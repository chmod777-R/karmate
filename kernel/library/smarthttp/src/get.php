<?php
namespace Karmate\Kernel\Library\SmartHttp\Src;

class Get
{
    /* SET RESULT */
    public static $result              = '1';

    /* GET DATA */
    public static $get_data            = null;

    /* SET SET */
    public static $SET                 = null;

    /* GET DELIMITER */
    public static $delimiter           = null;

    /* GET EQUALIZER */
    public static $equalizer           = null;

    /* GET ALLOWED HTML TAGS */
    public static $allowed_html_tags   = null;

    /**
    *Construct function
    * Control login
    */
    public function __construct($get_data, $SET, $delimiter, $equalizer, $allowed_html_tags)
    {
       #SET
        self::$get_data                 = $get_data;
        self::$SET                      = $SET;
        self::$delimiter                = $delimiter;
        self::$equalizer                = $equalizer;
        self::$allowed_html_tags        = $allowed_html_tags;
        self::controls();
        #RUN TRY
        if(self::$result = '1')
        {
            self::run();
        }
    }

    /* Variable usage controls*/
    private function controls()
    {
        if(self::$get_data == "")
        {
            \LIBRARY\SMARTHTTP\smarthttp::errors("get_data_empty");
            self::$result = '0';
        }

        if(self::$SET == null)
        {
            self::$result = '0';
        }

        if(self::$delimiter == null)
        {
            self::$result = '0';
        }

        if(self::$equalizer == null)
        {
            self::$result = '0';
        }

    }

    /* Run try function*/

    public function run()
    {
        self::$get_data= explode(self::$delimiter, self::$get_data);
        foreach (self::$get_data as &$key)
        {
            $key = self::re_solve($key);
            $get_data2= explode(self::$equalizer, $key);
            foreach ($get_data2 as &$key2)
            {
                self::re_solve($key2);
                $get_data3[$get_data2["0"]] = $key2;
            }
        }
        self::$get_data = $get_data3;
        define(self::$SET, self::$get_data);
        self::$result = self::$get_data;
    }

    /* Resolve function */
    private function re_solve($key)
    {
            $key = addslashes($key);
            $key = strip_tags($key, self::$allowed_html_tags);
            $key = htmlspecialchars($key, ENT_COMPAT | ENT_XHTML);
            if (strstr($key, "'"))
            {
                $key = str_replace("'", '<!DS-- HACKED BY YOU -->', $key);
            }
        return $key;
    }
    /* Destruct function*/
    public function __destruct()
    {
        return self::$result;
    }
}
