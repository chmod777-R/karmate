<?php
namespace Karmate\Kernel\InnerKernel;

class Source
{
	/**
	* String
	* sourceDir sets inner kernel source files path
	*/
	private static $sourceDir		=		null;

	/**
	* Const
	* DIRECTORY_SEPARATOR
	*/
	const DS 						= 		DIRECTORY_SEPARATOR;

    /**
    * getSource function
    * Requires innerkernel source files
    */

	public static function getSource()
	{
		#SET
		self::$sourceDir = __DIR__.self::DS.'src'.self::DS;

		#REQUIRE_ONCE -> Requirement checks
		require_once self::$sourceDir.self::DS.'requirementchecks.php';

		#REQUIRE_ONCE -> Constants
		require_once self::$sourceDir.self::DS.'constants.php';

		#REQUIRE_ONCE -> Upper kernel includes
		require_once self::$sourceDir.self::DS.'upperkernelincludes.php';

		#REQUIRE_ONCE -> Set PHP
		require_once self::$sourceDir.self::DS.'setphp.php';
	}
}
