<?php
namespace THIRDPARTY\SMARTHTTP\ERRORS;

class post_data_empty
{
	public function __construct()
	{
	    /*
	    Misusage error
	    */

        $frameworkNotifications = new \KERNEL\LIBRARY\FWNOTIFICATIONS\create;
        $frameworkNotifications->type    = "info";
        $frameworkNotifications->message = '';
	}

}
