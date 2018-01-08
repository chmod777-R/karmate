<?php
namespace Karmate\Kernel\InnerKernel\Src;

class Constants
{

    /**
    * @var protocol framework's runing protocol
    */
    public static $protocol    =    null;

    /**
    * Construct function
    * SET somethinks
    * RUN somethinks
    * GET somethinks
    */
    public function __construct()
    {
        #SET
        self::$protocol= $_SERVER["REQUEST_SCHEME"];

        #RUN
        self::set();

        #GET CONFIG
        self::getConfig();
    }

    /**
    * Set definitions function
    *
    * Function that defines constants
    */
    private static function set()
    {
        //--------------------------------------------------------------------------------------------------
        // Internal definitions
        //--------------------------------------------------------------------------------------------------
        // Each constant, session, function, or class defined on this page can be used from within the entire framework.
        //--------------------------------------------------------------------------------------------------
        //------------
        # Variables                                          = "CONTENT"
        //------------
        $protocol                                            = self::$protocol;
        $pathParts                                           = pathinfo($_SERVER["PHP_SELF"]);
        $httpHost                                            = $_SERVER['HTTP_HOST'];
        $requestURI                                          = $_SERVER['REQUEST_URI'];
        //MAIL TO MINER
        $mailToRootDirMiner                                  = array($httpHost, $requestURI, $protocol, $pathParts);
        $rootDir                                             = self::rootDirMiner($mailToRootDirMiner);
        //--------------------------------------------------------------------------------------------------
        //------------
        # Defines                                            ,  CONTENT
        //------------
        //DIRECTORY_SEPARATOR
        define( 'DS'                                         ,  DIRECTORY_SEPARATOR                  );
        //ROOT_DIR
        define( 'ROOT_DIR'                                   ,  $_SERVER['DOCUMENT_ROOT'].$rootDir   );
        //ROOT_LINK
        define( 'ROOT_LINK'                                  ,  self::rootLinkMiner()                );
        // ROOT_FILE
        define( 'ROOT_FILE'                                  ,  $pathParts['basename']               );
        // ROOT_FILE_NAME
        define( 'ROOT_FILE_NAME'                             ,  $pathParts['filename']               );
        // ROOT_FILE_EXTENSION
        define( 'ROOT_FILE_EXTENSION'                        ,  $pathParts['extension']              );
        // ROOT_DIR_CONTENT
        self::getDirConfigs();
        //GET CONFIG
        self::getConfig();
        //TEMPLATE CONFIGS
        self::getTemplateConfigs();
        //--------------------------------------------------------------------------------------------------
    }

    /**
    * Get dir configs function
    * Retrieve name settings for parent folders
    */
    private static function getDirConfigs()
    {
		$confDir    = ROOT_DIR.'kernel'.DS.'innerkernel'.DS.'conf'.DS;
	    if(!is_readable($confDir)) die('"'.$confDir.'" config dir not found');
        $dirConfigs = (require $confDir.'dirnames.php');
        if(!defined('CONF_DIR_')) {
            define( 'CONF_DIR_', $dirConfigs);
        }
    }

    /**
    * Get config function
    * It takes the main settings.
    */
    private static function getConfig()
    {
		$confDir    = ROOT_DIR.CONF_DIR_['configurations'].DS;
	    if(!is_readable($confDir)) die('"'.$confDir.'" config dir not found');
		$confFile   = $confDir.'app.php';
		if(!is_file($confFile)) die('"'.$confFile.'" config file not found');
        $configs = (require $confFile);
        if(!defined('CONF_')) {
            define( 'CONF_', $configs);
        }
    }

    /**
    * Get template configs function
    * Get personal settings for each template
    */
    private static function getTemplateConfigs()
    {
		$confDir    = ROOT_DIR.CONF_DIR_['apps'].DS.CONF_['default_app'].DS.'config'.DS;
		if(!is_readable($confDir)) die('"'.$confDir.'" config dir not found');

        $templateConfigs = (require $confDir.'config.php');
        if(!defined('CONF_APP_')) {
            define( 'CONF_APP_', $templateConfigs);
        }

		#Database
		$confDir    = ROOT_DIR.CONF_DIR_['apps'].DS.CONF_['default_app'].DS.'config'.DS;
		if(!is_readable($confDir)) die('"'.$confDir.'" config dir not found');
		foreach (CONF_APP_['databaseConfig'] as $key => $value) {
			if(is_file($confDir.$value)) {
				$templateConfigs = (require $confDir.$value);
				define(strtoupper($key.'_DB'), $templateConfigs);
			}
		}
    }

    /**
    * Root Dir Miner function
    *
    * Function that find correct ROOT_DIR
    */
    private static function rootDirMiner($mailToRootDirMiner)
    {
        $httpHost     =   $mailToRootDirMiner['0'];
        $requestURI   =   $mailToRootDirMiner['1'];
        $protocol     =   $mailToRootDirMiner['2'];
        $pathParts    =   $mailToRootDirMiner['3'];
        // $rootDir = str_ireplace($protocol.'://'.$httpHost, null, $requestURI);
        // $rootDir = str_ireplace($pathParts['filename'].'.'.$pathParts['extension'], null, $rootDir);
        // $rootDir = explode('/', $rootDir);
        // print_r($rootDir);exit;
        return $pathParts["dirname"].'/';
    }

    /**
    * Root Link Miner function
    *
    * Function that find correct ROOT_LINK
    */
    private static function rootLinkMiner()
    {
        return str_ireplace(_INDEX_, null, $_SERVER['PHP_SELF']);
    }

}
