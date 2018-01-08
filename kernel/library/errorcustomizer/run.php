<?php
namespace Karmate\Kernel\Library\ErrorCustomizer;

class Run
{
    /**
     * Notification type for css design
     */
    public static $appDir      = __DIR__;

    /**
     * Notification type for css design
     */
    public static $exploreFile = null;

    /**
     * Construct function
     */
	public function __construct($exploreFile)
	{
        #RUN
        $languageSupport               = new \Karmate\Kernel\Library\Language\Client;
        $languageSupport->libraryDir   = self::$appDir;
        $languageSupport->libraryName  = 'ErrorCustomizer';
        $languageSupport->run('Support');

        #SET
        self::$exploreFile = $exploreFile;

        #RUN -> FileExist
        if(self::$exploreFile != null) $return = self::fileExist();

        if($return == '1') self::customizeIt();
	}

    private function fileExist()
    {
        $exploreFile = new Src\FileExist(self::$exploreFile);
        return $exploreFile::$return;
    }

    private function customizeIt()
    {
        $customize = new Src\CustomizeIt(self::$exploreFile, self::$appDir);
    }

}
