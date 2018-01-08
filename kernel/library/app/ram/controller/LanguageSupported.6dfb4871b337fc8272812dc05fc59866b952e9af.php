<?php
class LanguageSupported
{
    public function Opening()
    {
        $outputs = new Karmate\Models\LangOutputs;
        $mylanguage = $outputs::$langOutput;

        echo $mylanguage.VISITOR_LANG;
    }
}
