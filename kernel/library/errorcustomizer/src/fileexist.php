<?php
namespace Karmate\Kernel\Library\ErrorCustomizer\Src;

class FileExist
{
    /**
     * String
     */
    public static $file   = null;

    /**
     * Return
     */
    public static $return = '0';

    /**
     * Construct function
     * The application resolves language options
     */
	public function __construct($file)
	{
        #SET
        self::$file = $file;

        #RUN -> run
        if(self::$file != null) self::run();

        if(self::$file == null) new CreateError('fileEmpty');
	}

    private function run()
    {

        if(is_readable(self::$file)) {
            self::$return = '1';
        }
    }

}
