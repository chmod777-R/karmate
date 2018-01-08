<?php
namespace Karmate\Kernel\InnerKernel\Src;

class UpperKernelIncludes
{
    /**
    * autorun dir location
    */
    public static $autoRunDir  = ROOT_DIR.DS.CONF_DIR_['apps'].DS.CONF_['default_app'].DS.CONF_APP_['autorun'].DS;

    /**
    * Construct function
    * RUN autoRunTop
    */
    public function __construct()
    {
        #RUN
        self::autoRunTop();
    }

    /**
    * Autorun top function
	* Autoruns apps middle_top.php autorun file
    * It will automatically include the file that will be included in the header.
    */
    private function autoRunTop()
    {
        $file = self::$autoRunDir."top.php";
        if(file_exists($file))
        {
            require_once $file;
        }
    }
}
