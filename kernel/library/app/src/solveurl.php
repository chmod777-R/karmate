<?php
namespace Karmate\Kernel\Library\App\Src;

class SolveURL
{
    /**
    * String
    */
    private static $URL;

	/**
    * String
    */
    public static $visitorLang;

    /**
    * String
    */
    public static $controller;

    /**
    * String
    */
    public static $function;

    /**
    * String
    */
    public static $params;

    /**
    * Construct function
    * RUN somethinks
    */
    public function __construct()
    {
        #RUN
        self::getURL();
        self::explodeURL();
        self::chooseMethod();
        self::findParams();
    }

    /**
    * Get URL function
    * Link structure solutions
    */
    private function getURL()
    {
        #SET
        self::$URL = isset($_GET['operation']) && !empty($_GET['operation']) ?
        trim($_GET['operation'], '/') : CONF_APP_['default_controller'].'/'. CONF_APP_['default_function'];
    }

    /**
    * Explode URL function
    * Partition link structure by slash
    */
    private function explodeURL()
    {
        #Explode it
        self::$URL = explode('/', self::$URL);
    }

    /**
    * Choose method function
    * Select method
    */
    private function chooseMethod()
    {
        self::$controller = isset(self::$URL[0]) ? self::$URL[0] : CONF_APP_['default_controller'];
        self::$function   = isset(self::$URL[1]) ? self::$URL[1] : CONF_APP_['default_function'];
        array_shift(self::$URL);
        array_shift(self::$URL);
		if(strstr(self::$controller, ':')) {
			$explodedController = explode(':', self::$controller, 2);
			self::$visitorLang  = $explodedController[0];
			self::$controller   = $explodedController[1];
		} else {
			self::$visitorLang  = CONF_APP_['default_lang'];
		}
    }

    /**
    * Find params function
    * Extract parameters
    */
    private function findParams()
    {
        self::$params = self::$URL;
    }
}
