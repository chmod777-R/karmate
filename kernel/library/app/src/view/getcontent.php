<?php
namespace Karmate\Kernel\Library\App\Src\View;

class GetContent
{

    /**
    * String
    */
    private static $location           =       null;

    /**
    * String
    */
    public static $content             =       null;

    /**
    * String
    */
    public static $transfer            =       null;

    /**
    * Construct function
    * This function processes the incoming values and returns.
    */
    public function __construct($location, $transfer)
    {
        #SET
        self::$location      =  $location;
        self::$transfer      =  $transfer;

        if(is_readable($location)) {
            self::$content = self::open();
        }
    }

    /**
    * Open function
    */
    private function open()
    {
         ob_start();
         require_once self::$location;
         $content = ob_get_contents();
         ob_end_clean();
         return $content;
    }
}
