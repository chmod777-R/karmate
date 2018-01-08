<?php
namespace Karmate\Kernel\Library\SmartHttp;

class SmartHttp
{

    // /**
    // *
    // * @var $
    // */
    // public                                = null;

    /**
    * DO
    * @var $ do
    */
    public $do                                = null;

    /* SET RESULT */
    public $result                            = null;

    /* GET DATA */
    public $get_data                          = null;

    /* SET SET */
    public $SET                               = 'LINK_DATA';

    /* GET DELIMITER */
    public  $delimiter                        = ',';

    /* GET EQUALIZER */
    public  $equalizer                        = ':';

    /* GET ALLOWED HTML TAGS  */
    public  $allowed_html_tags                = '<DS></DS>';

    /**
    * Construct Function
    */
	public function __construct()
	{
	}

    /* Run function*/

    public function run()
    {
        switch ($this->do) {
            case 'get':

                new SRC\get($this->get_data, $this->SET, $this->delimiter, $this->equalizer, $this->allowed_html_tags);
                $this->result = SRC\get::$result;
                break;

            case 'post':

                new SRC\post($this->SET, $this->allowed_html_tags);
                $this->result = SRC\post::$result;
                break;

            default:
                self::errors("misusage");
                break;
        }

    }


    /**
    * Errors Function
    * Its a error bridge
    * @param $ error
    * Its redirects to errors
    */
    public static function errors($error)
    {
        switch ($error) {
            case 'misusage':
                new ERRORS\misusage;
                break;

            case 'get_data_empty':
                new ERRORS\get_data_empty;
                break;

            case 'post_data_empty':
                new ERRORS\post_data_empty;
                break;

            default:
                die('error is not defined');
                break;
        }
    }
}
