<?php
class Homepage
{
	public function Opening($param, $param2)
	{
		$language = new Karmate\Models\Language(VISITOR_LANG);

		$homepageTransfers = [
			'rootLink' => ROOT_LINK,
			'project'  => 'Karmate',
			'version'  => '1.0.0',
			'motto'    => $language::$motto
		];
		>> new FW: APP\View('homepage', $homepageTransfers); <<
	}
	public function deneme($deneme)
	{

		>> $smart = new FW: SmartHttp\SmartHttp; <<
		$smart->do = "get";
		$smart->get_data = $deneme;
		# If you do not use it will default to LINK_DATA.
		$smart->SET = "INBOUND";
		# If you do not use it, the default will be ",".
		$smart->delimiter = '|';
		#If you do not use it will default to ":".
		$smart->equalizer = '=';
		#IF WANTED TO ALLOW SOME HTML TAGS
		$smart->allowed_html_tags = '<b></b><i></i>';
		#
		$smart->run();
		echo @INBOUND["sa"];

	}
}
