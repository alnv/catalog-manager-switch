<?php

namespace CatalogManager\CMSwitch;

class tl_switch_template_controller extends \Backend {


    public function setForeignId( \DataContainer $objDataContainer ) {

        $strId = $objDataContainer->id;
        $strFid = \Input::get('foreignId') ? (int) \Input::get('foreignId') : 0;

        $this->Database->prepare( 'UPDATE tl_switch_template_controller %s WHERE id = ?' )->set([ 'fid' => $strFid ])->execute( $strId );
    }


    public function getCustomTemplates() {

        return [];
    }


    public function getListTemplates() {

        return [];
    }


    public function getModules() {

        return [];
    }
}