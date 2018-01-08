<?php
namespace Karmate\Kernel\Library\App\Src\View;

class Extract
{
    /**
    * String
    */
    private static $appDir          =          __DIR__;

    /**
    * String
    */
    public static $content             =       null;

    /**
    * Array
    */
    public static $transfer            =       null;

    /**
    * Construct function
    * This function processes the incoming values and returns.
    */
    public function __construct($content = null, $transfer = null)
    {
        #SET
        self::$content      =  $content;
        self::$transfer     =  $transfer;

        #RUN
        if(self::$content  !=  null or self::$transfer != null) {
            self::extract();
        }
    }

    /**
    * Extract function
    */
    private function extract()
    {
       #RUN
       if (self::php() == '1') $control4 = new  extractPHP(self::$content);

       #SET
       if($control4) self::$content = $control4::$content;

	   #RUN
       if (self::loops() == '1') $control1 = new Loops(self::$content);

       #SET
       if($control1) self::$content = $control1::$content;

       #RUN
        if (self::$transfer != null) {
            if (self::untransferedVariables() == '1') $control2 = new CreateError('untransferedVariable');
            $control3 = new Transfers(self::$content, self::$transfer);
            #SET
            self::$content = $control3::$content;
        }

		#RUN
        $control6 = new ViewProgrammingShortcuts(self::$content);
        if($control6) {
            self::$content = $control6::$content;
        }

        #RUN
        $control5 = new FrameworkLibrary(self::$content);
        if($control5) {
            self::$content = $control5::$content;
        }

    }

    /**
    * untransferedVariables function
    */
    private function untransferedVariables()
    {
        $variablesTag = "/@\/(.*?)\/@/i";
        $find = preg_match_all($variablesTag, self::$content, $untransferedVariable,PREG_SET_ORDER);

        foreach ($untransferedVariable as $untransferedVariableContent) {
            array_shift($untransferedVariableContent);
            foreach ($untransferedVariableContent as $untransferedVariableContentIn) {
                if(!isset(self::$transfer[$untransferedVariableContentIn])) {
                    return '1';
                } else {
                    return '0';
                }
            }
        }
    }

    /**
    * PHP function
    */
    private function php()
    {
        $phpTag = "/{{(.*?)}}/i";
        $find = preg_match_all($phpTag, self::$content, $phpContent,PREG_SET_ORDER);
        if($phpContent != null) {
            return '1';
        } else {
            return '0';
        }
    }


    /**
    * Loops extract function
    */
    private function loops()
    {
        $loops = (require self::$appDir.DS.'conf'.DS.'loops.php');
        $total = count($loops);
        foreach ($loops as $key => $value) {
            if(stristr(self::$content, $value)) {
                return '1';
            } else {
                return '0';
            }
        }
    }
}
