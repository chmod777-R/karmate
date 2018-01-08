<?php
namespace Karmate\Kernel\Library\ErrorPage\Src;

class AuthorizationRequired
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
        self::e401();
    }

    /**
    * ERROR 401 GENERATOR
    * GETS USER 401 ERROR PAGE
    */
    public static function e401()
    {
        #HEADER
        header($_SERVER["SERVER_PROTOCOL"]." 401 Authorization Required", true, 401);
        #SET
        self::$error = (include_once ROOT_DIR.CONF_DIR_['apps'].DS.CONF_['default_template'].DS.CONF_APP_['eror_pages'].DS.'401.php');
    }

}
