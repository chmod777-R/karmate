<?php
namespace Karmate\Kernel\Library\App\Src\View;

class ThemeControl
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
    public static $themeConf            =       null;

    /**
    * String
    */
    public static $result               =       '0';

    /**
    * Construct function
    * This function processes the incoming values and returns.
    */
    public function __construct($themeType = null, $themeName = null)
    {
        #SET
        self::$themeType =  $themeType;
        self::$themeName =  $themeName;
        self::$themeConf =  (require self::$appDir.DS.'conf'.DS.'theme.php');

        #RUN
        self::getTheme();
    }

    /**
    * getTheme function
    */
    private function getTheme()
    {
        $controls = self::controls();
        if($controls == '1') die;
        self::$result = '1';
    }

    /**
    * controls function
    */
    private function controls()
    {
        $return = '0';
        if(self::$themeType == null) {
            new CreateError('themeTypeEmpty');
            $return = '1';
        }

        if(self::$themeName == null) {
            new CreateError('themeNameEmpty');
            $return = '1';
        }

        # Allowed extensions
        switch (self::$themeType) {
            case self::$themeConf['1']:
                # code...
                break;

            case self::$themeConf['2']:
                # code...
                break;

            default:
                new CreateError('unsupportedExtension');
                new CreateError('supportedExtensions','','',self::$themeConf);
                $return = '1';
                break;
        }
        return $return;
    }
}
