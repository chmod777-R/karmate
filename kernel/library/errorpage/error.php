<?php

namespace Karmate\Kernel\Library\ErrorPage;
class Error
{
    /**
    * App Dir
    */
    private static $appDir         =           __DIR__;

    /**
    * Construct function
    */
    public function __construct($error = null)
    {
        #RUN
        $languageSupport               = new  \Karmate\Kernel\Library\Language\Client;
        $languageSupport->libraryDir   = self::$appDir;
        $languageSupport->libraryName  = 'ErrorPage';
        $languageSupport->run('Support');

        switch ($error) {
            case '404':
                new SRC\NotFound('1');
                break;

            case '403':
                new SRC\Forbidden('1');
                break;

            case '401':
                new SRC\AuthorizationRequired('1');
                break;

            case '400':
                new SRC\BadRequest('1');
                break;

			case 'buildingPage':
	            new SRC\BuildingPage('1');
	            break;

             // case 'Another Error':
             //    new SRC\Error_Source('Token');
             //    break;

            default:
                # code...
                break;
        }
    }
}
