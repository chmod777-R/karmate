<?php
namespace Karmate\Kernel\Library\Language\Src;

class Support
{
    /**
     * Construct function
     * The application resolves language options
     */
	public function __construct($libraryDir, $libraryName)
	{
				$useThisLang = CONF_APP_['default_lang'];
				if(!is_readable($libraryDir.DS.'lang'.DS.CONF_APP_['default_lang']))
				{
						$useThisLang = 'en';
				}
        $Language = (require $libraryDir.DS.'lang'.DS.$useThisLang.DS.'outputs.php');
        if(!defined($libraryName.'_LIBRARY')) {
            define($libraryName.'_LIBRARY', $Language);
        }

	}

}
