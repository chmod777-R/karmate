<?php
namespace Karmate\Kernel\Library\App\Src\View;

class CreateError
{
    /**
    * String
    */
    public static $params;

    /**
    * Construct function
    * According to the incoming key.
    * @param $errorName
    * @param $fileName
    * @param orginClassName
    * @depends FWNOTIFICATIONS
    */
    public function __construct($errorName, $fileName = '', $orginClassName = '', $supportedExtensions = '')
    {
        switch ($errorName) {
            case 'viewNameIsEmpty':
                $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
                $frameworkNotifications->type    = "warning";
                $frameworkNotifications->message = App_LIBRARY['10'];
                die;
                break;

            case 'viewPathNotFound':
                $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
                $frameworkNotifications->type    = "warning";
                $frameworkNotifications->message = App_LIBRARY['11'];
                break;

            case 'viewFileNotFound':
                $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
                $frameworkNotifications->type    = "warning";
                $frameworkNotifications->message = App_LIBRARY['12'];
                break;

            case 'untransferedVariable':
                $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
                $frameworkNotifications->type    = "warning";
                $frameworkNotifications->message = App_LIBRARY['13'];
                break;

            case 'themeTypeEmpty':
                $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
                $frameworkNotifications->type    = "warning";
                $frameworkNotifications->message = App_LIBRARY['14'];
                break;

            case 'themeNameEmpty':
                $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
                $frameworkNotifications->type    = "warning";
                $frameworkNotifications->message = App_LIBRARY['15'];
                break;

            case 'unsupportedExtension':
                $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
                $frameworkNotifications->type    = "warning";
                $frameworkNotifications->message = App_LIBRARY['16'];
                break;

            case 'supportedExtensions':
                foreach ($supportedExtensions as $key => $value)
                {
                    $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
                    $frameworkNotifications->type    = "info";
                    $frameworkNotifications->message = App_LIBRARY['17'].'&nbsp;&nbsp;'.$value.',&nbsp;';
                }
                break;

            case 'themeIsNotFound':
                $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
                $frameworkNotifications->type    = "unsuccessful";
                $frameworkNotifications->message = App_LIBRARY['18'];
                break;

            default:
                $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
                $frameworkNotifications->type    = "warning";
                $frameworkNotifications->message = 'Error not found.';
                break;
        }
    }

}
