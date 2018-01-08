<?php
namespace Karmate\Kernel\Library\App\Src\View;

class ExtractPHP
{
    /**
    * String
    */
    private static $appDir              =          __DIR__;

    /**
    * String
    */
    public static $content              =       null;

    /**
    * Construct function
    * This function processes the incoming values and returns.
    */
    public function __construct($content = null)
    {
        #SET
        self::$content      =  $content;

        #RUN
        if(self::$content  !=  null) {
            self::extractPHP();
        }
    }

    /**
    * extractPHP function
    */
    private function extractPHP()
    {

        /* extractPHP tags*/
        self::$content = str_replace('>>','<?php ', self::$content);
        self::$content = str_replace('<<',' ?>', self::$content);
        /* extractPHP tags finish */

        /* extractPHP tags*/
        $search = self::$content;
        $loop   = self::search('<?php ', ' ?>', $search);
        $transferConf = (require self::$appDir.DS.'conf'.DS.'transfer.php');
        foreach ($loop as $key) {
            $key_last        = str_ireplace($transferConf['1'], 'self::$transfer["', $key);
            $key_last        = str_ireplace($transferConf['2'], '"]', $key_last);
            self::$content   = str_ireplace($key, $key_last, self::$content);
        }
        /* extractPHP tags finish */
    }


    /* Search tag function*/
    public function search($first, $last, $search)
    {
        @preg_match_all('/'. preg_quote($first, '/'). '(.*?)'. preg_quote($last, '/'). '/i', $search, $m);
        return @$m['1'];
    }
}
