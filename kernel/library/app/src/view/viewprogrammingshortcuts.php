<?php
namespace Karmate\Kernel\Library\App\Src\View;

class ViewProgrammingShortcuts
{
    /**
    * String
    */
    private static $appDir              =       __DIR__;

    /**
    * String
    */
    public static $content              =       null;

    /**
    * Construct function
    * This function processes the incoming values and returns.
    */
    public function __construct($content = null)
    {
        #SET
        self::$content      =  $content;

        #RUN
        if(self::$content  !=  null) {
            self::resolve();
        }
    }

    /**
    * resolve function
    */
    private function resolve()
    {
        /* user view programming shortcuts */
		$templateConfigs = (require ROOT_DIR.CONF_DIR_['apps'].DS.CONF_['default_app'].DS.'config'.DS.'viewprogrammingshortcuts.php');
		foreach ($templateConfigs as $key => $value) {
			self::$content  = str_ireplace($key, $value, self::$content);
		}
        /* user view programming shortcuts  finish */
    }


    /* Search tag function*/
    public function search($first, $last, $search)
    {
        @preg_match_all('/'. preg_quote($first, '/'). '(.*?)'. preg_quote($last, '/'). '/i', $search, $m);
        return @$m['1'];
    }
}
