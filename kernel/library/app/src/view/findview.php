<?php
namespace Karmate\Kernel\Library\App\Src\View;

class FindView
{

    /**
    * String
    */
    public static $result           =       null;

    /**
    * String
    */
    public static $viewName         =       null;

    /**
    * String
    */
    public static $viewPath         =       null;

    /**
    * String
    */
    public static $viewExtension    =       null;

    /**
    * Construct function
    * This function processes the incoming values and returns.
    */
    public function __construct($viewName, $viewExtension, $viewPath)
    {
        #SET
        self::$viewName      =  $viewName;
        self::$viewPath      =  $viewPath;
        self::$viewExtension = $viewExtension;
        if(!is_readable($viewPath)) {
            new CreateError('viewPathNotFound');
        }

        if(!file_exists($viewPath.DS.$viewName.$viewExtension)) {
            new CreateError('viewFileNotFound');
        }

        #SET
        self::$result = array('viewPath' => self::$viewPath, 'viewName' => self::$viewName, 'viewExtension' => self::$viewExtension );
    }

}
