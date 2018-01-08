<?php
namespace Karmate\Kernel\Library\Language\Src;

class Language
{
    /**
    * Construct function
    */
	public function __construct($appDir = null)
	{
				$useThisLang = CONF_APP_['default_lang'];
				if(!is_readable($appDir.DS.'lang'.DS.CONF_APP_['default_lang']))
				{
						$useThisLang = 'en';
				}
        $Language = (require $appDir.DS.'lang'.DS.$useThisLang.DS.'outputs.php');
            if(!defined('LANGUAGE_LIBRARY')) {
                define( 'LANGUAGE_LIBRARY', $Language);
            }
	}
}
