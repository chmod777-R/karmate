<?php
namespace Karmate\Kernel\Library\ErrorCustomizer\Src;

class PrintIt
{
    /**
     * String
     */
    public static $appDir          = null;

    /**
     * String
     */
    public static $fileContent     = null;

    /**
     * String
     */
    public static $fileFull        = null;

    /**
     * String
     */
    public static $line            = null;

    /**
     * String
     */
    public static $message         = null;

    /**
     * Construct function
     */
    public function __construct($fileFull = null , $line = null , $message = null, $appDir = null)
    {
        #SET
        self::$appDir   = self::appDirLinkMiner($appDir);
        self::$fileFull = $fileFull;
        self::$line     = $line;
        self::$message  = $message;

        #RUN -> echo CSS
        self::echoCSS();
        #RUN -> message
        self::message();
        #RUN -> codes
        trim(self::codes());
        #RUN -> echo JS
        self::echoJS();
    }

    private function echoCSS()
    {
        echo '<link crossorigin="anonymous" href="'.ROOT_LINK.'kernel/library/errorcustomizer/style/style.css" media="all" rel="stylesheet" />';
    }

    private function echoJS()
    {
        echo '<script src="'.ROOT_LINK.'kernel/library/errorcustomizer/style/script.js"></script>';
    }

    private function getFileContent()
    {
        $file    = fopen(self::$fileFull, 'r');
        $content = fread($file, filesize(self::$fileFull));
        $content = explode("\r\n",$content);
        fclose($file);

        /* LIMIT */
        $limit       = 5;
        /* LIMIT */
        $contentLast = null;
        for ($i=0; $i < self::$line  ; $i++) {
                $contentLast .= $content[$i]."\r\n";
        }

        for ($i=self::$line+$limit; $i > self::$line  ; $i--) {
            $contentLast .= $content[$i]."\r\n";
        }

        return highlight_string($contentLast."\r\n".'....Please review the file for the rest.');
    }

    private function message()
    {
        $illegal_try = new \Karmate\Kernel\Library\FwNotifications\create;
        $illegal_try->type    ='danger';
        $illegal_try->message = '<br>'.'Caught exception: <p><b><pre><code>'.self::$message.'</code></pre></b></p><br>'.'<h4>line : <pre><code>'.self::$line.'</code></pre></h4></font><br>';
    }

    private function codes()
    {

        self::getFileContent();

    }

    private function appDirLinkMiner($appDir)
    {
        $ROOT_DIR = str_replace('/', DS, ROOT_DIR);
        $appDir = str_ireplace($ROOT_DIR, null, $appDir);
        $appDirLink = ROOT_LINK.$appDir;
        $appDirLink = str_replace(DS, '/', $appDirLink);
        return $appDirLink;
    }

}
