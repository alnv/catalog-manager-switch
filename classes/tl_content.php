<?php

namespace CatalogManager\CMSwitch;

class tl_content extends \Backend {


    public function generateWizardList( $objRecords, $strId ) {

        $strReturn = '';

        while ($objRecords->next()) {

            $strReturn .= '<li>' . $objRecords->name . ' (ID: ' . $objRecords->id . ')' . '</li>';
        }

        return '<ul id="sort_' . $strId . '">' . $strReturn . '</ul>';
    }


    public function getModules() {

        $arrReturn = [];

        $objModules = $this->Database->prepare('SELECT * FROM tl_module WHERE `type` = ?')->execute( 'catalogUniversalView' );

        if ( $objModules->numRows ) {

            while ( $objModules->next() ) {

                $arrReturn[ $objModules->id ] = $objModules->name;
            }
        }

        return $arrReturn;
    }
}