<?php
namespace Karmate\Kernel\Library;

class Autoloader
{
    /**
    * Construct function
    * @param $run
    * The kernel autoloader is used to invoke kernel classes.
    */
    public function __construct($condition = '0')
    {
        switch ($condition) {
            case '1':
                spl_autoload_register("self::library");
                break;

            default:
                die('No excuise.');
                break;
        }
    }

    /**
    * Library function
    * The framework autoload the kernel library.
    */
    private function library($className)
    {
        if(stristr($className, 'Kernel\Library'))
        {
			$className 		   = str_ireplace('Karmate\\', null, $className);
            $className         = ltrim($className, '\\');
            $fileName          = '';
            $namespace         = '';
            if ($lastNsPos     = strrpos($className, '\\'))
            {
                $namespace     = substr($className, 0, $lastNsPos);
                $namespace     = ROOT_DIR.$namespace;
                $className     = substr($className, $lastNsPos + 1);
                $fileName      = str_replace('\\', DS, $namespace) . DS;
				$fileName 	   = strtolower($fileName);
            }
            $fileName    .= $className. '.php';
			if(!is_file($fileName)) $fileName = strtolower($fileName);
            if(is_readable($fileName))
            {
                require $fileName;
            }
            else
            {
                echo 'Kernel library not found. <br> File : '.$fileName;
				die;
            }
        }
    }
}
