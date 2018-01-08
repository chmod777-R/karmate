<?php
namespace Karmate\Kernel\Library\App\Src\View;

class GetTheme
{
    /**
    * String
    */
    private static $appDir              =       __DIR__;

    /**
    * String
    */
    public static $themeType            =       null;

    /**
    * String
    */
    public static $themeName            =       null;

    /**
    * String
    */
    public static $themePath            =       null;

    /**
    * Construct function
    * This function processes the incoming values and returns.
    */
    public function __construct($themeType = null, $themeName = null, $themePath = null)
    {
        #SET
        self::$themeType =  $themeType;
        self::$themeName =  $themeName;
        self::$themePath =  $themePath;

        #RUN
        self::getTheme(self::$themePath.DS.self::$themeName, self::$themeType, self::$themeName);
    }

    /**
    * getTheme function
    */
    private function getTheme($path, $type, $themeName = null)
    {
        $files = array();
        if(is_readable($path)) {
            foreach(scandir($path) as $f) {
                if(!$f || $f[0] == '.') {
                continue;
                }
                if(is_dir($path . '/' . $f)) {
                    $files[] = array(
                        "name" => $f,
                        "type" => "folder",
                        "path" => $path . '/' . $f,
                        "items" => self::getTheme($path . '/' . $f)
                    );
                } else {
                    $files[] = array(
                        "name" => $f,
                        "type" => "file",
                        "path" => $path . '/' . $f,
                        "size" => filesize($path . '/' . $f)
                    );
                    $extension = pathinfo($f);
                    $extension = $extension["extension"];
                    if($extension == $type) {
                        if($type=="js") {
                            echo "\r<script type='text/javascript' src='".ROOT_LINK.CONF_APP_['themes'].DS.$themeName.DS.$f."'></script>\n";
                        } elseif($type=="css") {
                            echo"\r<link href='".ROOT_LINK.CONF_APP_['themes'].DS.$themeName.DS.$f."' rel='stylesheet'>\n";
                        }
                    }
                }
            }
            echo"\r";
        } else {
            new CreateError('themeIsNotFound');
        }
return $files;
    }
}
