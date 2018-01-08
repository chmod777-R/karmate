<?php
namespace Karmate\Kernel\Library\App\Src;

class RamCleaner
{
    /**
    * Construct function
    * Clears the controller caches that the user on the Ram folder is traversing.
    * @param $ramDir
    * @param $ramType
    */
    public function __construct($ramDir = null, $ramType = null)
    {
        switch ($ramType) {
            case 'controller':
                self::cleanRam($ramDir, 'controller');
                break;

            case 'model':
                self::cleanRam($ramDir, 'model');
                break;

            case 'view':
                self::cleanRam($ramDir, 'view');
                break;

            default:
                new CreateError('ramNotFound');
                break;
        }
    }

    /**
    *Clean ram function
    */
    private function cleanRam($ramDir = null, $type = null)
    {
        if ($ramDir == null or $type == null) {
            die;
        }

        foreach(glob($ramDir.DS.$type.DS.'*.php*') as $f) {
            @@unlink($f);
        }
    }

}
