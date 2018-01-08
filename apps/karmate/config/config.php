<?php return [

        #TEMPLATE DEFAULTS
		'default_lang'           => 'en'                 ,
		'default_controller'     => 'Homepage'           ,
		'default_function'       => 'Opening'            ,

		#DB CONFIG
		#CONS -> NAME_DB
		'databaseConfig'         => array(
			                    'name'  => 'database.php',
								'name2' =>'anotherdb.php' #Another db
														),

        #TEMPLATE DIRECTORYS
        'controllers'            => 'controllers'        ,
        'models'                 => 'models'             ,
        'views'                  => 'views'              ,
        'themes'                 => 'themes'             ,
        'error_pages'            => 'error_pages'        ,
        'autorun'                => 'autorun'            ,
        'public'                 => 'public'			 ,
		'lang'					 => 'lang'

];
