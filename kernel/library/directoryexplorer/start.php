<?php
namespace Karmate\Kernel\Library\DirectoryExplorer;

class Start
{

	/**
    * String
    */
    public static $dir     =       null;

    /**
    * Notification type for css design
    */
    public static $appDir      = __DIR__;

    /**
    * String Result
    */
    public static $result      = null;

	/**
    * Construct function
    */
    public function __construct($dir = null)
    {
        #SET
        self::$dir = $dir;
        #RUN
        $languageSupport               = new Karmate\Kernel\Library\Language\Client;
        $languageSupport->libraryDir   = self::$appDir;
        $languageSupport->libraryName  = 'DirectoryExplorer';
        $languageSupport->run('Support');

        switch (self::$dir) {
            case CONF_DIR_Configurations:
                self::$result = SRC\FileCheck::dir(ROOT_DIR.CONF_DIR_Configurations);
                break;

            case CONF_DIR_Templates:
                self::$result = SRC\FileCheck::dir(ROOT_DIR.CONF_DIR_Templates);
                break;
            case CONF_DIR_Library:
                self::$result = SRC\FileCheck::dir(ROOT_DIR.CONF_DIR_Library);
                break;

            default:
                die(DirectoryExplorer_LIBRARY['1']);
                break;
        }
    }


    /**
     * Destruct function
     */
    public function __destruct()
    {
        return self::$result;
    }
}
