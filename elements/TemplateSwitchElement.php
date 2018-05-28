<?php

namespace CatalogManager\CMSwitch;

class TemplateSwitchElement extends \ContentElement {


    protected $strTemplate = 'ce_template_switch';


    public function generate() {

        if ( TL_MODE == 'BE' ) {

            $objTemplate = new \BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### TEMPLATE SWITCH ###';

            return $objTemplate->parse();
        }

        return parent::generate();
    }


    protected function compile() {}
}