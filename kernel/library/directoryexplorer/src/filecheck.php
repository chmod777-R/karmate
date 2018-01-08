<?php
namespace Karmate\Kernel\Library\DirectoryExplorer\SRC;

class FileCheck
{

    /**
     * @var $dir
    */
    public static $dir        =        null;

    /**
     * @var $dir
    */
    public static $check      =        null;

    /**
     * string
    */
    public static $result     =        null;

    /**
    * Construct function
    */
    public static function dir($dir = null)
    {
        if($dir == null) {
            die(DirectoryExplorer_LIBRARY['2']);
        }
        #SET
        self::$dir   =   $dir;
        #RUN
        return self::check();
    }

    private static function check()
    {
        if(is_readable(self::$dir)) {
            return '1';
        } else {
            return '0';
        }
    }

}
