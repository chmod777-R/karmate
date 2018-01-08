<?php
namespace Karmate\Kernel\Library\SmartHttp\Src;

class Post
{
    /* SET RESULT */
    public static $result              = '1';

    /* POST DATA */
    private static $post_data          = null;

    /* SET SET */
    public static $SET                 = null;

    /* GET ALLOWED HTML TAGS */
    public static $allowed_html_tags   = null;

    /**
    *Construct function
    * Control login
    */
    public function __construct($SET, $allowed_html_tags)
    {
       #SET
        self::$post_data                = $_POST;
        self::$SET                      = $SET;
        self::$allowed_html_tags        = $allowed_html_tags;
        self::controls();
        #RUN TRY
        if(self::$result == '1')
        {
            self::run();
        }
    }

    /* Variable usage controls*/
    private function controls()
    {
        if(self::$post_data == null)
        {
            \LIBRARY\SMARTHTTP\smarthttp::errors("post_data_empty");
            self::$result = '0';
            define(self::$SET, "NULL");
        }

        if(self::$SET == null)
        {
            self::$result = '0';
        }

    }

    /* Run try function*/

    public function run()
    {
        self::$post_data    =   $_POST;
        self::re_solve();
        self::$result       =   self::$post_data;

        define(self::$SET, self::$post_data);
    }

    /* Resolve function */
    private function re_solve()
    {
        foreach (self::$post_data as $key => $value)
        {
            $value = addslashes($value);
            $value = strip_tags($value, self::$allowed_html_tags);
            self::$post_data[$key] = $value;
        }

    }
    /* Destruct function*/
    public function __destruct()
    {
        return self::$result;
    }
}
