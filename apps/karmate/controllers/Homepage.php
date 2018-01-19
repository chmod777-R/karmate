<?php
class Homepage
{
	public function Opening($param, $param2)
	{
		$language = new Karmate\Models\Language(VISITOR_LANG);

		$homepageTransfers = [
			'rootLink' => ROOT_LINK,
			'project'  => 'Karmate',
			'version'  => '1.0.2',
			'motto'    => $language::$motto
		];
		>> new FW: APP\View('homepage', $homepageTransfers); <<
	}
}
