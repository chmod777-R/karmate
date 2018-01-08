<?php
namespace Karmate\Kernel\Library\App\Src\View;

class GetRam
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
    public static $content             =       null;

    /**
    * Construct function
    * This function processes the incoming values and returns.
    */
    public function __construct($content = null, $ramDir = null, $viewName = null)
    {
        #SET
        self::$content      =  $content;
        self::$ramDir       =  $ramDir;
        self::$viewName     =  $viewName;

        #RUN
        if(self::$content  !=  null) {
            self::saveRam();
        }
    }

    /**
    * Extract function
    */
    private function saveRam()
    {
        touch(self::$ramDir.self::IPaL(self::$viewName).".php");
        $file = fopen(self::$ramDir.self::IPaL(self::$viewName).".php", "a");
        fwrite($file, self::$content);
        fclose($file);
    }

    /**
    * IPaL
    * A function that performs ram editing according to IP address
    */
    private function IPaL($viewName)
    {
        if(getenv("HTTP_CLIENT_IP")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
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
