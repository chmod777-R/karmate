<?php
namespace Karmate\Kernel;

class Shell
{
    /**
    * Construct function
    * Runs some functions
    */
    public function __construct()
    {
        #RUN
        self::getBottomKernelIncludes();
        self::setIndex();
    }

    /**
    * Get bottom kernel includes function
    * Run the files that need to be included after every page.
    */
    private function getBottomKernelIncludes()
    {
        require_once __DIR__.DS.'shell'.DS.'bottomkernelincludes.php';
        new Shell\BottomKernelIncludes;
    }


    /**
    * Set index function
    * default Index.HTML content = <iframe src="FW.PHP" height="100%" width="100%"></iframe>
    */
    private function setIndex()
    {
        $indexFile = [
        'html'      =>    ROOT_DIR.'index.html'
        ];
        foreach ($indexFile as $key => $value)
        {
            if(is_readable($value))
            {
                unlink($value);
            }
        }
    }

	public function __destruct()
	{
	}
}
