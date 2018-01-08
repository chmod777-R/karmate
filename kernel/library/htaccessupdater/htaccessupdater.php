<?php
namespace Karmate\Kernel\Library\HtaccessUpdater;

class HtaccessUpdater
{
    /**
    * Htaccess's default header text
    */
    private $contentHeader = '
    #----------------------------------------------------------------------------------------------------
    # This file automatically created and updated
    #----------------------------------------------------------------------------------------------------
    <IfModule mod_rewrite.c>
    RewriteEngine On
    ';

    /**
    * Htaccess's content text
    * @var $content
    */
    public $content = '';

    /**
    * Htaccess's default footer text
    */
    private $contentFooter = '
    Options All -Indexes
    ErrorDocument 403 '.ROOT_LINK.''.CONF_DIR_['apps'].'/'.CONF_['default_app'].'/'.CONF_APP_['error_pages'].'/403.php
    ErrorDocument 404 '.ROOT_LINK.''.CONF_DIR_['apps'].'/'.CONF_['default_app'].'/'.CONF_APP_['error_pages'].'/404.php
    ErrorDocument 401 '.ROOT_LINK.''.CONF_DIR_['apps'].'/'.CONF_['default_app'].'/'.CONF_APP_['error_pages'].'/401.php
    ErrorDocument 400 '.ROOT_LINK.''.CONF_DIR_['apps'].'/'.CONF_['default_app'].'/'.CONF_APP_['error_pages'].'/400.php
    RewriteRule ^'.CONF_APP_['public'].'/(.*)  '.CONF_DIR_['apps'].'/'.CONF_['default_app'].'/'.CONF_APP_['public'].'/$1 [NC]
    RewriteRule ^'.CONF_APP_['themes'].'/(.*)  '.CONF_DIR_['apps'].'/'.CONF_['default_app'].'/'.CONF_APP_['themes'].'/$1 [NC]
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$  '.ROOT_FILE.'?operation=$1 [QSA]
    </IfModule>
    #----------------------------------------------------------------------------------------------------';

    /**
    * Update function
    * Update the htaccess file according to the received data and the change of the name of the index file
    */
    public function update()
    {
        self::clean();
        #Auto_Htaccess Updater
        $f = touch(ROOT_DIR.DS.".htaccess");
        $f = fopen(ROOT_DIR.DS.".htaccess", "a+");
        fwrite($f, $this->contentHeader.$this->content.$this->contentFooter);
        fclose($f);

    }

    /**
    * Clean function
    * Clear old htaccess file
    */
    public function clean()
    {
        #Auto_Htaccess Cleaner
        $f = unlink(ROOT_DIR.DS.".htaccess");
    }

}
