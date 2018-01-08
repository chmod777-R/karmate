<?php
namespace Karmate\Kernel\Library\App\Src\View;

class Transfers
{
    /**
    * String
    */
    private static $appDir              =          __DIR__;

    /**
    * String
    */
    public static $content              =       null;

    /**
    * Array
    */
    public static $transferConf         =       null;

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
            self::extractTransfers();
        }
    }

    /**
    * extractTransfers function
    */
    private function extractTransfers()
    {
        self::$transferConf = (require self::$appDir.DS.'conf'.DS.'transfer.php');
        $content            = str_replace(self::$transferConf['1'],'<?=self::$transfer["',self::$content);
        $content            = str_replace(self::$transferConf['2'],'"]?>',$content);
        self::$content      = $content;
    }

}
