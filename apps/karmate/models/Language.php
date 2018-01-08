<?php
namespace Karmate\Models;
class Language
{
	/**
	* Visitors language
	*/
	private static $visitorLang;

	/**
	* Homepage languages
	*/
	public static $motto;


	/**
	* Construct function
	* gets visitorLang and set it
	*/
    public function __construct($visitorLang = null)
    {
		#SET
		self::$visitorLang = $visitorLang;
		#RUN
		self::setTexts();

    }

	/**
	* Set texts function
	*/
	private function setTexts()
	{
		switch (self::$visitorLang) {
			case 'en':
				self::$motto = 'we do not claim to do everything, we believe that we have prepared the appropriate environment to do everything together :)';
				break;

			case 'tr':
				self::$motto = 'her şeyi yaptığımızı iddia etmiyoruz, her şeyi beraber yapabilmek için uygun ortamı hazırladığımıza inanıyoruz :)';
				break;

			case 'es':
				self::$motto = 'no pretendemos hacer todo, creemos que hemos preparado el entorno adecuado para hacer todo juntos :)';
				break;

			case 'de':
				self::$motto = 'wir behaupten nicht, alles zu tun, wir glauben, dass wir die passende Umgebung vorbereitet haben, um alles zusammen zu machen :)';
				break;

			default:
				die('No language support yet :(');
				break;
		}


	}

}
