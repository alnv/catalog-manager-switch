<?php

namespace CatalogManager\CMSwitch;

use CatalogManager\Toolkit as Toolkit;
use CatalogManager\CatalogFieldBuilder as CatalogFieldBuilder;

class tl_switch_template_controller extends \Backend {


    public function setForeignId( \DataContainer $objDataContainer ) {

        $strId = $objDataContainer->id;
        $strFid = \Input::get('foreignId') ? (int) \Input::get('foreignId') : 0;

        $this->Database->prepare( 'UPDATE tl_switch_template_controller %s WHERE id = ?' )->set([ 'fid' => $strFid ])->execute( $strId );
    }


    public function getCustomTemplates() {

        $arrTableTemplates = $this->getTemplateGroup('mod_catalog_table');
        $arrListTemplates = $this->getTemplateGroup('mod_catalog_universal');

        return array_merge( $arrTableTemplates, $arrListTemplates );
    }


    public function getListTemplates() {

        return $this->getTemplateGroup( 'ctlg_view_' );
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


    public function getAllColumns( \DataContainer $objDataContainer ) {

        $arrReturn = [];
        $arrForbiddenTypes = [ 'upload' ];
        $strModuleId = $objDataContainer->activeRecord->moduleId;

        if ( !$strModuleId ) return $arrReturn;

        $objModule = $this->Database->prepare('SELECT * FROM tl_module WHERE id = ?')->limit( 1 )->execute( $strModuleId );
        $strTable = $objModule->catalogTablename;

        if ( !$strTable ) return $arrReturn;
        if ( !$this->Database->tableExists( $strTable ) ) return $arrReturn;


        $objCatalogFieldBuilder = new CatalogFieldBuilder();
        $objCatalogFieldBuilder->initialize( $strTable );
        $arrFields = $objCatalogFieldBuilder->getCatalogFields( true, null );

        foreach ( $arrFields as $strFieldname => $arrField ) {

            if ( !$this->Database->fieldExists( $strFieldname, $strTable ) ) continue;
            if ( in_array( $arrField['type'], Toolkit::excludeFromDc() ) ) continue;
            if ( $arrField['type'] == 'textarea' && $arrField['rte'] ) continue;
            if ( in_array( $arrField['type'], $arrForbiddenTypes ) ) continue;

            $arrReturn[ $strFieldname ] = Toolkit::getLabelValue( $arrField['label'], $strFieldname ) . '['. $strFieldname .']';
        }

        return $arrReturn;
    }


    public function getFastModeFields( \DataContainer $objDataContainer ) {

        $arrReturn = [];
        $strModuleId = $objDataContainer->activeRecord->moduleId;

        if ( !$strModuleId ) return $arrReturn;

        $objModule = $this->Database->prepare('SELECT * FROM tl_module WHERE id = ?')->limit( 1 )->execute( $strModuleId );
        $strTable = $objModule->catalogTablename;

        if ( !$strTable ) return $arrReturn;
        if ( !$this->Database->tableExists( $strTable ) ) return $arrReturn;

        $objFieldBuilder = new CatalogFieldBuilder();
        $objFieldBuilder->initialize( $strTable );
        $arrFields = $objFieldBuilder->getCatalogFields( true, null );

        foreach ( $arrFields as $strFieldname => $arrField ) {

            if ( !in_array( $arrField['type'], Toolkit::$arrDoNotRenderInFastMode ) ) continue;

            $arrReturn[ $strFieldname ] = Toolkit::getLabelValue( $arrField['_dcFormat']['label'], $strFieldname );
        }

        return $arrReturn;
    }
}