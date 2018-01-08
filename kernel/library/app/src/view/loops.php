<?php
namespace Karmate\Kernel\Library\App\Src\View;

class Loops
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
    * Array
    */
    public static $loopsConf            =       null;

    /**
    * Array
    */
    public static $transferConf         =       null;

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
            self::extractLoops();
        }
    }

    /**
    * extractLoops function
    */
    private function extractLoops()
    {
        #SET
        self::$loopsConf    = (require self::$appDir.DS.'conf'.DS.'loops.php');
        self::$transferConf = (require self::$appDir.DS.'conf'.DS.'transfer.php');
        /* Start Loops*/
        self::if();
    }

    /**
    * Loop : if
    * @var html
    * depends elseif, else, endif
    */
    private function if()
    {

        /* if tags*/
        self::$content = str_replace("{".self::$loopsConf['if']."(","<?php if(",self::$content);
        self::$content = str_replace(")/}","):?>",self::$content);
        /* if tags finish */

        /* if tags*/
        $search = self::$content;
        $loop   = self::search("<?php if(", "):?>", $search);
        foreach ($loop as $key) {
            $key_last        = str_ireplace(self::$transferConf['1'], 'self::$transfer["', $key);
            $key_last        = str_ireplace(self::$transferConf['2'], '"]', $key_last);
            self::$content   = str_ireplace("<?php if(".$key."):?>", "<?php if(".$key_last."):?>", self::$content);
        }
        /* if tags finish */

        self::elseif();
    }

    /**
    * Loop : if
    * @var html
    * elseif
    */
    private function elseif()
    {
         /* elseif tags*/
        self::$content = str_replace("{".self::$loopsConf['elseif']."(","<?php elseif(",self::$content);
        self::$content = str_replace(")/}","):?>",self::$content);
        /* elseif tags finish */

        /* elseif tags*/
        $search = self::$content;
        $loop = self::search("<?php elseif(", "):?>", $search);
        foreach ($loop as $key) {
            $key_last        = str_ireplace(self::$transferConf['1'], 'self::$transfer["', $key);
            $key_last        = str_ireplace(self::$transferConf['2'], '"]', $key_last);
            self::$content   = str_ireplace("<?php elseif(".$key."):?>", "<?php elseif(".$key_last."):?>", self::$content);
        }

        /* elseif tags finish */


        self::else();
    }

    /**
    * Loop : if
    * @var html
    * elseif
    */
    private function else()
    {
        self::$content = str_replace("{".self::$loopsConf['else']."/}","<?php else: ?>",self::$content);
        self::endif();
    }
    /**
    * Loop : if
    * @var html
    * endif
    */
    private function endif()
    {
        self::$content = str_replace("{".self::$loopsConf['endif']."/}","<?php endif ?>",self::$content);
    }

    /* Search tag function*/
    public function search($first, $last, $search)
    {
        @preg_match_all('/'. preg_quote($first, '/'). '(.*?)'. preg_quote($last, '/'). '/i', $search, $m);
        return @$m['1'];
    }
}
