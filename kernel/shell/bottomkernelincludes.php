<?php
namespace Karmate\Kernel\Shell;

class BottomKernelIncludes
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
        self::autoRunBottom();
    }

    /**
    * Construct function
    * It will automatically include the file that will be included in the footer.
    */
    private function autoRunBottom()
    {
        $file = self::$autoRunDir."bottom.php";
        if(file_exists($file))
        {
            require_once $file;
        }
    }
}
