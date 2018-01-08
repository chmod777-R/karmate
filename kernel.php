<?php
namespace Karmate;

/**
* Call the inner kernel
*/
require_once __DIR__.DIRECTORY_SEPARATOR.'kernel'.DIRECTORY_SEPARATOR.'innerkernel'.'.php';

/**
* KERNEL
*/
class Kernel extends Kernel\InnerKernel
{
    /**
    * @var $condition
    */
    public static $condition         =         null;

    /**
    * Construct function
    * @var $condition runs the kernel autoloader
    */
    public function __construct($condition = '0')
    {
        #RUN
        new Kernel\InnerKernel;
        #SET
        self::$condition = $condition;

        #RUN -> Kernel condition control
        self::runControl();

		#RUN -> Kernel autoloader
        self::runAutoloader();

		#RUN -> Autorun middle top file
        self::autoRunMiddleTop();

		#RUN -> App
        self::app();

		#RUN -> Autorun middle bottom file
        self::autoRunMiddleBottom();
    }

    /**
    * Run control function
    * If the run value is not assigned or is empty, it gives an error and stops itself.
    * @var $condition
    */
    private static function runControl()
    {
        if(self::$condition == '0' or self::$condition == null) {
            self::kernelOff();
        }
    }

    /**
    * Run autoloader function
    * Run the kernel autoloader
    */
    private static function runAutoloader()
    {
        require_once __DIR__.DS.'kernel'.DS.'autoloader.php';
        new Kernel\Library\Autoloader('1');
    }

    /**
	* App function
	* This function runs, organize, edit and test user apps
	*/
    private static function app()
    {
        new Kernel\Library\App\Run;
    }

    /**
    * Kernel off function
    * Make an error if the kernel is not running
    */
    public static function kernelOff()
    {
        include_once ROOT_DIR.DS.'kernel'.DS.'off'.DS.'kernel.html';
        exit;
    }

    /**
    * RUN Autorun middle top function
    * Autoruns apps middle_top.php autorun file
    */
    public static function autoRunMiddleTop()
    {
        $autoRunDir  = ROOT_DIR.DS.CONF_DIR_['apps'].DS.CONF_['default_app'].DS.CONF_APP_['autorun'].DS;
        $file = $autoRunDir.'middle_top.php';
        if(file_exists($file)) {
            require_once $file;
        }
    }

    /**
    * RUN autoRunMiddleBottom function
    * Autoruns template middle_bottom.php autorun file
    */
    public static function autoRunMiddleBottom()
    {
        $autoRunDir  = ROOT_DIR.DS.CONF_DIR_['apps'].DS.CONF_['default_app'].DS.CONF_APP_['autorun'].DS;
        $file = $autoRunDir."middle_bottom.php";
        if(file_exists($file)) {
            require_once $file;
        }
    }

    /**
    * RUN shell function
    * The kernel is dependent on the root file. It works on your kernel.
    */
    public static function runShell()
    {
        require_once __DIR__.DS.'kernel'.DS.'shell'.'.php';
        new Kernel\Shell;
    }

    /**
    * Destruct function
    * Htaccess update after every refresh
    */
    public function __destruct()
    {
		self::runShell();

		$htaccessUpdater = new \Karmate\Kernel\Library\HtaccessUpdater\HtaccessUpdater;
		/** ********************************
		*@var $content					  ///
		* User htaccess settings          ///
		**********************************///
		$htaccessUpdater->content =  '';  ///
		/*********************************///
		$htaccessUpdater->update();
    }
}
