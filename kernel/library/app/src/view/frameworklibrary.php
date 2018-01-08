<?php
namespace Karmate\Kernel\Library\App\Src\View;

class FrameworkLibrary
{
    /**
    * String
    */
    private static $appDir              =       __DIR__;

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
            self::extractFrameworkLibrary();
        }
    }

    /**
    * extractFrameworkLibrary function
    */
    private function extractFrameworkLibrary()
    {
        /* extractFrameworkLibrary tags */
        $search = self::$content;
        $loop   = self::search('>>', '<<', $search);
		$fwLibraryConf = (require self::$appDir.DS.'conf'.DS.'fwlibrary.php');
		foreach ($loop as $key) {
			foreach ($fwLibraryConf as $keyIn => $valueIn) {
				$content = str_ireplace($keyIn, $valueIn, $key);
				self::$content   = str_ireplace($key, $content, self::$content);
			}
		}
        /* extractFrameworkLibrary tags finish */

        /* extractFrameworkLibrary tags*/
        self::$content = str_replace('>>','<?php ', self::$content);
        self::$content = str_replace('<<',' ?>', self::$content);
        /* extractFrameworkLibrary tags finish */
    }

    /* Search tag function*/
    public function search($first, $last, $search)
    {
        @preg_match_all('/'. preg_quote($first, '/'). '(.*?)'. preg_quote($last, '/'). '/i', $search, $m);
        return @$m['1'];
    }
}
