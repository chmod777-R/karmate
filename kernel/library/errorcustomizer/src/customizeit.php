<?php
namespace Karmate\Kernel\Library\ErrorCustomizer\Src;

class CustomizeIt
{
    /**
     * String
     */
    public static $appDir     = null;

    /**
     * String
     */
    public static $file       = null;

    /**
     * Line
     */
    public static $line       = null;

    /**
     * String
     */
    public static $fileFull   = null;

    /**
     * String
     */
    public static $message   = null;

    /**
     * Construct function
     * The application resolves language options
     */
	public function __construct($file, $appDir)
	{
        #SET
        self::$file   = $file;
        self::$appDir = $appDir;
        #RUN -> run
        if(self::$file != null) self::run();

        if(self::$file == null) new CreateError('fileEmpty');

        #RUN -> search
        $isAnError      = self::search();

        #RUN -> Customize
        if($isAnError == '1') self::print();
	}

    private function run()
    {
       try {
            include self::$file;
        }
        catch ( \ParseError $e) {
            self::$line     = $e->getLine();
            self::$message  = $e->getMessage();
            self::$fileFull = $e->getFile();
        }
    }

    private function search()
    {
        if(stristr(self::$message, "error"))  return '1';
    }

    private function print()
    {
        new PrintIt(self::$fileFull, self::$line, self::$message, self::$appDir);
    }

}
