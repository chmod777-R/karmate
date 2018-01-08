<?php
namespace Karmate\Kernel\Library\App;

class Run
{
    /**
    * String
    */
    private static $URL;

    /**
    * String
    */
    private static $appDir     =    __DIR__;

	/**
    * String
    */
    private static $visitorLang;

    /**
    * String
    */
    private static $controller;

    /**
    * String
    */
    private static $function;

    /**
    * String
    */
    private static $params;

    /**
    * @var ram_dir
    */
    private static $ramDir     =    __DIR__.DS.'ram';

    /**
    * Construct function
    * SET somethinks
    * RUN CallTheController class with @var
    * @param param
    */
    public function __construct()
    {
        #RUN
        self::runLanguage();
        self::runCleanRams();
        $SolveURL         = new SRC\SolveURL;
        #SET
        self::$visitorLang = $SolveURL::$visitorLang;
        self::$controller  = $SolveURL::$controller;
        self::$function    = $SolveURL::$function;
        self::$params      = $SolveURL::$params;

        #RUN
        new SRC\CallTheController(self::$controller, self::$function, self::$params, self::$ramDir, self::$visitorLang);

    }

    /**
    * Run clean rams function
    */

    private function runCleanRams()
    {
        $cleanControllerRam = new Src\RamCleaner(self::$ramDir, 'controller');
        $cleanModelRam      = new Src\RamCleaner(self::$ramDir, 'model');
        $cleanViewRam       = new Src\RamCleaner(self::$ramDir, 'view');
    }

    /**
    * Run language function
    */
    private function runLanguage()
    {
        $languageSupport               = new \Karmate\Kernel\Library\Language\Client;
        $languageSupport->libraryDir   = self::$appDir;
        $languageSupport->libraryName  = 'App';
        $languageSupport->run('Support');
    }

    /**
    * Destruct function
    */
    public function __destruct()
    {
    }
}
