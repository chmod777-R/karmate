<?php
namespace Karmate\Kernel\Library\ErrorPage\Src;

class NotFound
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
        self::e404();
    }

    /**
    * ERROR 404 GENERATOR
    * GETS USER 404 ERROR PAGE
    */
    public static function e404()
    {
        #HEADER
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
        #SET
        self::$error = (include_once ROOT_DIR.CONF_DIR_['apps'].DS.CONF_['default_app'].DS.CONF_APP_['error_pages'].DS.'404.php');
    }

}
