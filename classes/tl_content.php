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
}