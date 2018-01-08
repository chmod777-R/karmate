<?php
namespace Karmate\Kernel\Library\App\Src;

class ControllerProgrammingShortCuts
{
    /**
    * @var
    */
    public static $content   = null;

    /**
    * String
    */
    private static $appDir   =          __DIR__;

    /**
    * Construct function
    */
    public function __construct($content = null, $appDir = null)
    {
        #SET
        self::$content = $content;
        self::$appDir  = $appDir;
        #RUN
        self::resolve();
    }

    /*
    * Resolve function
    */
    private function resolve()
    {
       /* extractFrameworkLibrary tags*/
        $search = self::$content;
        $loop   = self::search('>>', '<<', $search);
        $fwLibraryConf = (require self::$appDir.DS.'conf'.DS.'fwlibrary.php');
        $templateConfigs = (require ROOT_DIR.CONF_DIR_['apps'].DS.CONF_['default_app'].DS.'config'.DS.'controllerprogrammingshortcuts.php');
        foreach ($loop as $key) {
            foreach ($fwLibraryConf as $keyIn => $valueIn) {
                $content = str_ireplace($keyIn, $valueIn, $key);
                self::$content   = str_ireplace($key, $content, self::$content);
            }
            foreach ($templateConfigs as $keyIn => $valueIn) {
                $content = str_ireplace($keyIn, $valueIn, $key);
                self::$content   = str_ireplace($key, $content, self::$content);
            }
        }
        /* extractFrameworkLibrary tags finish */

        /* extractFrameworkLibrary tags*/
        self::$content = str_replace('>>', null, self::$content);
        self::$content = str_replace('<<', null, self::$content);
        /* extractFrameworkLibrary tags finish */
    }

    /* Search tag function*/
    public function search($first, $last, $search)
    {
        @preg_match_all('/'. preg_quote($first, '/'). '(.*?)'. preg_quote($last, '/'). '/i', $search, $m);
        return @$m['1'];
    }
}
