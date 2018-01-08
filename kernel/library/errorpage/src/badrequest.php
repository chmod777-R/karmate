<?php
namespace Karmate\Kernel\Library\ErrorPage\Src;

class BadRequest
{
    /**
    * ERROR
    */
    private static $error              =               null;

    /**
    * Construct function
    * RUN 400
    */
    public function __construct($token = null)
    {
        $illegalTryControl = (1 != $token) ? new CreateError('illegalTry') : 0 ;
        #RUN
        self::e400();
    }
    /**
    * ERROR 400 GENERATOR
    * GETS USER 400 ERROR PAGE
    */
    public static function e400()
    {
        #HEADER
        header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request", true, 400);
        #SET
        self::$error = (include_once ROOT_DIR.CONF_DIR_['apps'].DS.CONF_['default_app'].DS.CONF_APP_['error_pages'].DS.'400.php');
    }

}
