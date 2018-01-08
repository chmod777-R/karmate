<?php
namespace Karmate\Kernel\Library\Language\Src;

class CreateError
{

    /**
    * Construct function
    * The application resolves language options
    */
    public function __construct($error = null)
    {
        switch ($error)
        {
            case 'undefinedFunction':
                $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
                $frameworkNotifications->type    = "warning";
                $frameworkNotifications->message = LANGUAGE_LIBRARY['1'];
                break;

            case 'emptyVariableLanguageDir':
                $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
                $frameworkNotifications->type    = "warning";
                $frameworkNotifications->message = LANGUAGE_LIBRARY['2'];
                break;

            case 'emptyVariableLanguageName':
                $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
                $frameworkNotifications->type    = "warning";
                $frameworkNotifications->message = LANGUAGE_LIBRARY['3'];
                break;

            case 'languageDirNotFound':
                $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
                $frameworkNotifications->type    = "warning";
                $frameworkNotifications->message = LANGUAGE_LIBRARY['4'];
                break;

            case 'doc':
                $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
                $frameworkNotifications->type    = "info";
                $frameworkNotifications->message = LANGUAGE_LIBRARY['6'].'<p class="class_name">$languageSupport = new \KERNEL\LIBRARY\LANGUAGE\Client;<br>
$languageSupport->run("Doc");<br></p>';
                break;

            default:
                echo LANGUAGE_LIBRARY['5'];
                break;
        }
    }

}
