<?php
namespace Karmate\Kernel\Library\ErrorPage\Src;

class CreateError
{

    /**
     * Construct function
     */
    public function __construct($error = null)
    {
        switch ($error)
        {
            case 'illegalTry':
                $illegal_try = new Karmate\Kernel\Library\FwNotifications\Create;
                $illegal_try->type    ='warning';
                $illegal_try->message = ErrorPage_LIBRARY['1'];
                die;
                break;

            default:
                break;
        }
    }

}
