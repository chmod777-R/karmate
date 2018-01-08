<?php
namespace Karmate\Kernel\Library\App\Src;

class Autoloader
{
#Autoload prepares the hierarchy of the files.

    /**
    * Models autoloader function
    * Makes autoload for model files in Template directory
    */
    public function model($className)
    {
        $orginClassName   = $className;
        $className         = ltrim($className, '\\');
        $fileName          = '';
        $namespace          = '';
        if ($lastNsPos      = strrpos($className, '\\')) {
            $namespace      = substr($className, 0, $lastNsPos);
            $namespace      = explode(DS, $namespace);
            if(count($namespace)< 1) {
                array_shift($namespace);
            }
            $namespace     = implode(DS, $namespace).DS;
            $className     = substr($className, $lastNsPos + 1);
            $fileName      = str_replace('\\', DS, $namespace);
			$fileName	   = strtolower($fileName);
        }
        $kernelFile        = stristr($namespace, "Kernel");
        $libraryFile       = stristr($namespace, CONF_DIR_['Library']);
        if(!$kernelFile and !$libraryFile) {
            $fileName          = ROOT_DIR.CONF_DIR_['apps'].DS.$fileName.$className.'.php';
			if(!is_file($fileName)) $fileName = strtolower($fileName);
            if(is_readable($fileName)) {
                #INCLUDE
                new \Karmate\Kernel\Library\ErrorCustomizer\Run($fileName);
                #!INCLUDE

                if (!class_exists($orginClassName)) {
                    new CreateError('userModelNameWrong', $fileName, $orginClassName);
                    die();
                }
            } else {
                new CreateError('userClassNotFound', $fileName, $orginClassName);
                die();
            }
        }
    }

    /**
    * Library autoloader function
    * Make autoload for the main libraries in the root directory
    */
    public function library($className)
    {
		$orginClassName   = $className;
        $className         = ltrim($className, '\\');
        $fileName          = '';
        $namespace          = '';
        if ($lastNsPos      = strrpos($className, '\\')) {
            $namespace      = substr($className, 0, $lastNsPos);
            $namespace      = explode(DS, $namespace);
            if(count($namespace)< 1) {
                array_shift($namespace);
            }
            $namespace     = implode(DS, $namespace).DS;
            $className     = substr($className, $lastNsPos + 1);
            $fileName      = str_replace('\\', DS, $namespace);
			$fileName	   = strtolower($fileName);
			$path 		   = $fileName;
        }
        $kernelFile        = stristr($namespace, "KERNEL");
        $libraryFile       = stristr($namespace, CONF_DIR_['library']);
        if($libraryFile and !$kernelFile) {
            $fileName          = ROOT_DIR.$fileName.$className.'.php';
			if(!is_file($fileName)) $fileName = strtolower($fileName);

            if(is_readable($fileName)) {
				#Librarys requirements control
				self::librarysRequirementsControl($path);
                #INCLUDE
                new \Karmate\Kernel\Library\ErrorCustomizer\Run($fileName);
                #!INCLUDE
                if (!class_exists($orginClassName)) {
                    new CreateError('libraryClassNotFound', $fileName, $orginClassName);
                    die();
                }
            } else {
				self::downloadLibraryFromKermate($fileName, $orginClassName);
            }
        }
    }

	/**
	* Librarys requirement control function
	*/
	private function librarysRequirementsControl($path)
	{
		if(is_file($path.DS.'conf'.DS.'requirements.php')){
			$x = new \Karmate\Kernel\InnerKernel\Src\RequirementChecks;
			$x::setApacheRequirements($path.DS.'conf'.DS, 'requirements.php');
		}
	}

	/**
	* Download library from kermate function
	* Download the missing library from Karmate servers.
	*/
	private function downloadLibraryFromKermate($fileName, $orginClassName)
	{
		$orginClassName = strtolower($orginClassName);
		#Download package
		define('BUFSIZ', 4095);
		$tar = $orginClassName.'.tar.gz';
		$URL = CONF_['packages_repo'].$tar;
		$explodedURL = explode('\\' , $URL);
		$localFilePath = ROOT_DIR.CONF_DIR_['library'].DS.$tar;
		$URL = str_replace('\\', '/', $URL);
		$remoteFile = fopen($URL, 'r');
		if(!$remoteFile) { new CreateError('libraryClassNotFound', $fileName, $orginClassName); die; }
		$localFile  = fopen($localFilePath, 'w');
		while(!feof($remoteFile))
		fwrite($localFile, fread($remoteFile, BUFSIZ), BUFSIZ);
		fclose($remoteFile);
		fclose($localFile);
		#Download package finishs
		chmod(ROOT_DIR.CONF_DIR_['library'].DS.$tar, 0777);

        new CreateError('libraryClassDownloaded', '', $orginClassName);
	}
}
