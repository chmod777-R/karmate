<?php
namespace Karmate\Kernel\Library\App\Src;

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
    public function __construct($errorName, $fileName = '', $orginClassName = '')
    {
        switch ($errorName) {
            case 'methodNotFound':
            $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
            $frameworkNotifications->type    = "warning";
            $frameworkNotifications->message = App_LIBRARY['1'];
                break;

             case 'defaultFunctionNotFound':
            $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
            $frameworkNotifications->type    = "info";
            $frameworkNotifications->message = App_LIBRARY['2']."\t".'<span class="row"> => </span>'.CONF_APP_['default_function'];
                break;

             case 'classNotFound':
            $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
            $frameworkNotifications->type    = "warning";
            $frameworkNotifications->message = App_LIBRARY['3']."\t".'<span class="row"> => </span>'.CONF_APP_['default_controller'];
                break;

             case 'userClassNotFound':
            $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
            $frameworkNotifications->type    = "info";
            $frameworkNotifications->message = App_LIBRARY['5'].'<p class="class_name">'.$fileName.'</p><br><font color="red">'.$orginClassName.'</font>';
                break;

             case 'libraryClassNotFound':
            $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
            $frameworkNotifications->type    = "primary";
            $frameworkNotifications->message = App_LIBRARY['6'].'<p class="class_name">'.$fileName.'</p><br><font color="red">'.$orginClassName.'</font>';
                break;

             case 'ramNotFound':
            $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
            $frameworkNotifications->type    = "primary";
            $frameworkNotifications->message = App_LIBRARY['7'];
                break;

             case 'misusageController':
            $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
            $frameworkNotifications->type    = "primary";
            $frameworkNotifications->message = App_LIBRARY['8'].'<p class="class_name">'.$fileName.'</p><br><font color="red">'.$orginClassName.'</font>';
            $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
            $frameworkNotifications->type    = "info";
            $frameworkNotifications->message = App_LIBRARY['9'].'<p class="class_name">
            class Foo {
                <br>
                public function bar()
                <br>
                {
                    <br>
                    echo "BAR";
                    <br>
                }
                <br>
            }
            <br><br><br>
            class Foo2 extends Foo {
                <br>
                public function __construct()
                <br>
                {
                    <br>
                    Foo::bar();
                    <br>

                }
                <br>
            }
            </p>';
                break;

             case 'viewMisusage':
            $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
            $frameworkNotifications->type    = "primary";
            $frameworkNotifications->message = App_LIBRARY['10'];
                break;

             case 'viewAlreadyExist':
            $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
            $frameworkNotifications->type    = "primary";
            $frameworkNotifications->message = App_LIBRARY['11'];
                break;

             case 'viewIsNotReadable':
            $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
            $frameworkNotifications->type    = "primary";
            $frameworkNotifications->message = App_LIBRARY['12']."<span class='row'> => </span> <p class='view_is_not_readable'>".ROOT_DIR.CONF_['template'].DS.CONF_APP_Views.DS;
                break;

			case 'userModelNameWrong':
		    $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
		    $frameworkNotifications->type    = "info";
		    $frameworkNotifications->message = App_LIBRARY['19'];
		        break;

			case 'libraryClassDownloaded':
			$frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
			$frameworkNotifications->type    = "info";
			$frameworkNotifications->message = App_LIBRARY['20'].'<span class="row"> => </span> '.$orginClassName;
			    break;

            case 'thisMethodIsPrivate':
    		$frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
    		$frameworkNotifications->type    = "danger";
    		$frameworkNotifications->message = App_LIBRARY['21'];
    			  break;

            default:
            $frameworkNotifications = new \Karmate\Kernel\Library\FwNotifications\create;
            $frameworkNotifications->type    = "warning";
            $frameworkNotifications->message = 'Error not found.';
                break;
        }
    }

}
