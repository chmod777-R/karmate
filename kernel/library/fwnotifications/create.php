<?php
namespace Karmate\Kernel\Library\FwNotifications;

class create
{
    /**
    * Notification type for css design
    * @var string
    */
	public $type               = 'warning';

    /**
    * Notification type for css design
    * @var const
    */
	public $message            = null;

    /**
    * Notification type for css design
    */
    public static $appDir      = __DIR__;

    /**
    * Notification type for css design
    * @var string
    */
    public $cssFile            = ROOT_LINK.'kernel/library/fwnotifications/bulma-0.6.1/css/bulma.css';

    /**
    * Construct function
    */
	public function __construct()
	{
        #RUN
        $languageSupport               = new \Karmate\Kernel\Library\Language\Client;
        $languageSupport->libraryDir   = self::$appDir;
        $languageSupport->libraryName  = 'FWNotifications';
        $languageSupport->run('Support');

        #SET
        $this->message = FWNotifications_LIBRARY['1'];
	}

    /**
     * Function that prints the incoming message
     */
	private function print()
	{
        echo '<!DOCTYPE html>
		        <html>
		          <head>
			      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        	  	    <meta charset="utf-8">
        	   		<title>EVENT->'.strtoupper($this->type).' | '.substr(strip_tags($this->message),0 , 150).'</title>
        			<link rel="stylesheet" type="text/css" href="'.$this->cssFile.'" media="screen" />
        		  </head>
				  <body>
				    <div class="notification is-'.$this->type.'">
					  <span>'.$this->message.'</span>
        			</div>
				  </body>
        	    </html>';
	}

    /**
     * Destruct function
     *
     * Start printing function
     */
    public function __destruct()
    {
            self::print();
    }

}
