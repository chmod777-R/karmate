<?php
namespace Karmate\Kernel\Library\Language;

class Client
{
    /**
    * This variable specifies the directory where the application is running.
    */
    private static $languageLibraryDir         =           null;

    /**
    * This variable specifies the directory of the library for which language support is to be provided.
    * @var $libraryDir
    */
    public $libraryDir                         =            null;

    /**
    * This variable specifies the name of the library for which language support will be provided.
    * @var $libraryName
    * Constant is assigned according to this name.
    * For example LibraryName['1']
    */
    public $libraryName                        =            null;

    /**
     * Construct function
     * This is the client of the framework providing the language support library.
     */
    public function __construct()
    {
        #SET
        self::$languageLibraryDir   =   __DIR__;
        #RUN
        new Src\Language(self::$languageLibraryDir);
    }

    public function run($operation = null)
    {
         if($operation != 'Doc') {
            self::controlVariables();
        }

        switch ($operation) {
            case 'Support':
                new Src\Support($this->libraryDir, $this->libraryName);
                break;

             case 'Doc':
                new Src\Doc;
                break;

            default:
                new Src\CreateError('undefinedFunction');
                new Src\CreateError('doc');
                break;
        }
    }

    private function controlVariables()
    {
        if($this->libraryDir == null)
        {
            new Src\CreateError('emptyVariableLanguageDir');
        }
        if($this->libraryName == null)
        {
            new Src\CreateError('emptyVariableLanguageName');
        }
        if(!is_readable($this->libraryDir))
        {
           new Src\CreateError('languageDirNotFound');
        }
    }
}
