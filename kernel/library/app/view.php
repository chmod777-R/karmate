<?php
namespace Karmate\Kernel\Library\App;

class View
{
    /**
    * @var $viewName
    * This variable specifies the name of the view file.
    */
    private static $viewName        =          null;

    /**
    * @var $viewExtension
    * This variable specifies the extension of the view file.
    */
    private static $viewExtension   =          '.view';

    /**
    * @var $viewPath
    * This variable specifies the path to the view file.
    */
    private static $viewPath        =          ROOT_DIR.CONF_DIR_['apps'].DS.CONF_['default_app'].DS.CONF_APP_['views'];

    /**
    * @var $themePath
    * This variable specifies the path to the view file.
    */
    private static $themePath        =          ROOT_DIR.CONF_DIR_['apps'].DS.CONF_['default_app'].DS.CONF_APP_['themes'];

    /**
    * @var $location
    * This variable specifies the path to the view file.
    */
    private static $location        =          null;

    /**
    * @var $content
    * This variable stores the contents of the view file.
    */
    private static $content         =          null;

    /**
    * @var $transfer
    * This variable takes what needs to be transferred.
    */
    private static $transfer        =          null;


    /**
    * @var $ramDir
    * This variable specifies the path to the ram file.
    */
    private static $ramDir          =          __DIR__.DS.'ram'.DS.'view'.DS;

    /**
    * Construct function
    * This function takes the necessary values and assigns it to the object, which executes the required classes according to the properties
    * of the object.
    */
    public function __construct($viewName = null, $transfer = null, $viewPath = null)
    {
        #SET-> viewName and viewPath
        self::$viewName = ($viewName == null) ? new Src\View\CreateError('viewNameIsEmpty') : $viewName ;
        self::$viewPath = ($viewPath == null) ? self::$viewPath : $viewPath ;
        self::$transfer = ($transfer == null) ? 'null' : $transfer ;

        #RUN-> FindView (Location)
        $view                    = new Src\View\FindView(self::$viewName, self::$viewExtension, self::$viewPath);

        #SET-> Location
        self::$location          = $view::$result['viewPath'].DS.$view::$result['viewName'].$view::$result['viewExtension'];

        #RUN-> GetContent
        $view                    = new Src\View\GetContent(self::$location, self::$transfer);
        self::$content           = $view::$content;
        unset($view);

        #RUN-> Extract
        $content                 = new Src\View\Extract(self::$content, self::$transfer);

        #SET -> Content
        self::$content           = $content::$content;

        #RUN -> GetRam
        $ram                     = new Src\View\GetRam(self::$content, self::$ramDir, self::$viewName);

        #RUN -> OpenRam
        $openRam                 = new Src\View\OpenRam(self::$viewName, self::$ramDir, self::$transfer);
    }

    public function theme($themeType = null, $themeName = null)
    {
        #RUN
        $control = new Src\View\ThemeControl($themeType, $themeName);
        if($control::$result == '1') new Src\View\GetTheme($themeType, $themeName, self::$themePath);
    }


}
