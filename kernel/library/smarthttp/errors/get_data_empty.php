<?php
namespace THIRDPARTY\SMARTHTTP\ERRORS;

class get_data_empty
{
	public function __construct()
	{
	    /*
	    Misusage error
	    */
      $frameworkNotifications = new \KERNEL\LIBRARY\FWNOTIFICATIONS\create;
      $frameworkNotifications->type    = "info";
      $frameworkNotifications->message = '<p class="class_name">public function EXAMPLE($example)<br>
  {<br>
      $smart_http = new \LIBRARY\SMARTHTTP\smarthttp();<br>
      $smart_http->do = "get";<br>
      $smart_http->get_data = $deneme;<br>
      // $smart_http->SET = "INBOUND";<br>
      // $smart_http->delimiter = ",";<br>
      // $smart_http->equalizer = "=";<br>
  $smart_http->run();<br>
  echo @LINK_DATA["user_id"].@LINK_DATA["user_name"];<br>
  }<br></p>';
	}

}
