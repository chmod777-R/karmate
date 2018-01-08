<?php
namespace Karmate\Kernel\Library\App\Src\View;

class OpenRam
{
    /**
    * String
    */
    private static $ramDir             =       null;

    /**
    * String
    */
    private static $viewName           =       null;

    /**
    * String
    */
    private static $transfer           =       null;

    /**
    * Construct function
    * This function processes the incoming values and returns.
    */
    public function __construct($viewName = null, $ramDir = null, $transfer = null)
    {
        #SET
        self::$viewName     =  $viewName;
        self::$ramDir       =  $ramDir;
        self::$transfer     =  $transfer;

        #RUN
        if(self::$viewName  !=  null or self::$ramDir != null) {
            self::open();
        }
    }

    /**
    * open function
    */
    private function open()
    {
		#INCLUDE
		    include self::$ramDir.self::IPaL(self::$viewName).'.php';
		#!INCLUDE
    }

    /**
    * IPaL
    * A function that performs ram editing according to IP address
    */
    private function IPaL($viewName)
    {

        if(getenv("HTTP_CLIENT_IP")) {
            $ip = getenv("HTTP_CLIENT_IP");
        }
        elseif(getenv("HTTP_X_FORWARDED_FOR")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
            if (strstr($ip, ',')) {
                $tmp = explode (',', $ip);
                $ip = trim($tmp[0]);
            }
        } else {
            $ip = getenv("REMOTE_ADDR");
        }
        $lastIPaL = $viewName.".".sha1(md5(base64_encode($ip)));
        return $lastIPaL;
    }
}
