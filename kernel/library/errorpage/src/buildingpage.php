<?php
namespace Karmate\Kernel\Library\ErrorPage\Src;

class BuildingPage
{
    /**
    * ERROR
    */
    private static $error              =               null;

    /**
    * Construct function
    * RUN Building page
    */
    public function __construct($token = null)
    {
        $illegalTryControl = (1 != $token) ? new CreateError('illegalTry') : 0 ;
        #RUN
        self::e400();
    }
    /**
    * ERROR BUILDING PAGE GENERATOR
    * GETS USER BUILDING ERROR PAGE
    */
    public static function e400()
    {
        #SET
		$userPage    = ROOT_DIR.CONF_DIR_['apps'].DS.CONF_['default_app'].DS.CONF_APP_['error_pages'].DS.'building.php';
		if(is_file($userPage)) {
            self::$error = (include_once $userPage);
			die;
		} else {
			die('The page is building.');
		}

    }
}
