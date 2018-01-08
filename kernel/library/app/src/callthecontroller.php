<?php
namespace Karmate\Kernel\Library\App\Src;

class CallTheController
{

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
    * @var ram_dir
    */
    private static $content   = null;

    /**
    * @var ram_dir
    */
    private static $ramDir    = null;

    /**
    * String
    */
    private static $appDir   = __DIR__;

    /**
    * Construct function
    */
    public function __construct($controller, $function, $params, $ramDir, $visitorLang)
    {
        self::$controller       =       $controller;
        self::$function         =       $function;
        self::$params           =       $params;
        self::$ramDir           =       $ramDir.DS.'controller'.DS;
        self::$visitorLang      =       $visitorLang;
        self::call();
    }

    /**
    * Call function
    * Make initial address to controller file
    */
    private function call()
    {
    	if(!isset(self::$params["0"])) {
            self::$params=array('null', 'null');
        }

		#SET
		define('VISITOR_LANG', self::$visitorLang);
		$appsDir 				= ROOT_DIR.DS.CONF_DIR_['apps'];
		$defaultAppDir 			= $appsDir.DS.CONF_['default_app'];
        $templateControllersDir = $defaultAppDir.DS.CONF_APP_['controllers'];
        $file 					= $templateControllersDir.DS.self::$controller.".php";

        if (file_exists($file)) {
            $openFile = fopen($file, 'r');
			$fileSize = filesize($file);
			if($fileSize == 0) { new \Karmate\Kernel\Library\ErrorPage\Error('buildingPage'); }
            self::$content = fread($openFile, $fileSize);

			#EXTRACT -> Controller programming shortcuts
            $extract = new ControllerProgrammingShortCuts(self::$content, self::$appDir);
            self::$content = $extract::$content;

			#GETRAM
            touch(self::$ramDir.DS.self::IPaL(self::$controller).".php");
            $controllerRam = fopen(self::$ramDir.DS.self::IPaL(self::$controller).".php","a");
            fwrite($controllerRam, self::$content);
            fclose($controllerRam);

			#Default function control
            if(!strstr(self::$content, CONF_APP_['default_function'])) {
                    new CreateError('defaultFunctionNotFound');
                    die;
            }

            #INCLUDE
            new \Karmate\Kernel\Library\ErrorCustomizer\Run(self::$ramDir.DS.self::IPaL(self::$controller).".php");
            #!INCLUDE

            fclose($openFile);

            if (class_exists(self::$controller)) {

                $reflection = new \ReflectionMethod(self::$controller, self::$function);
                if (!$reflection->isPublic()) {
                    new CreateError('thisMethodIsPrivate');
                }

                spl_autoload_register("self::autoloader");
                $controller = new self::$controller;
                if (method_exists(self::$controller, self::$function)) {
                    @call_user_func_array([self::$controller, self::$function],self::$params);
                } else {
                    new CreateError('methodNotFound');
					new \Karmate\Kernel\Library\ErrorPage\Error('404');
                }
            } else {
                new CreateError('classNotFound');
            }

        } else {
            new \Karmate\Kernel\Library\ErrorPage\Error('404');
        }
    }

    /**
    * Autloader function
    * Autoload prepares the hierarchy of the files.
    */
    public function autoloader($className)
    {
        /*	 use composer autloader for every request	*/

		/*	 use controller autloader for controller request	*/
        if(stristr($className, CONF_APP_['controllers'])) {
            new CreateError('misusageController', $className);
            die;
        }

		/*	 use models autloader for models request	*/
        elseif(stristr($className, CONF_APP_['models'])) {
            $autoloader = new Autoloader;
            $autoloader->model($className);
        }

		/*	 use 3rdparty library autloader for 3rdparty library request without composer :) */
        elseif(stristr($className, CONF_DIR_['library'])) {
            $autoloader = new Autoloader;
            $autoloader->library($className);
        }

		else {
			#Composer Autoloader
			$composerAutoloader = ROOT_DIR.CONF_DIR_['library'].DS.'vendor'.DS.'autoload.php';
			require $composerAutoloader;
			#Composer Autoloader
		}
    }

    /**
    * IPaL
    * A function that performs ram editing according to IP address
    */
    private function IPaL($controller)
    {
        if(getenv("HTTP_CLIENT_IP")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
            if (strstr($ip, ',')) {
                $tmp = explode (',', $ip);
                $ip = trim($tmp[0]);
            }
        } else {
            $ip = getenv("REMOTE_ADDR");
        }
        $lastIPaL = $controller.".".sha1(md5(base64_encode($ip)));
        return $lastIPaL;
    }

}
