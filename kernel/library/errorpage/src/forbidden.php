<?php
namespace Karmate\Kernel\Library\ErrorPage\Src;

class Forbidden
{
    /**
    * ERROR
    */
    private static $error              =               null;

    /**
    * Construct function
    * RUN 404
    */
    public function __construct($token = null)
    {
        $illegalTryControl = (1 != $token) ? new CreateError('illegalTry') : 0 ;
        #RUN
        self::e403();
    }

    /**
    * ERROR 403 GENERATOR
    * GETS USER 403 ERROR PAGE
    */
    public static function e403()
    {
        #HEADER
        header($_SERVER["SERVER_PROTOCOL"]." 403 Forbidden", true, 403);
        #SET
        self::$error = (include_once ROOT_DIR.CONF_DIR_['apps'].DS.CONF_['default_app'].DS.CONF_APP_['error_pages'].DS.'403.php');
    }

}
