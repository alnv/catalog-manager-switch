<?php

namespace CatalogManager\CMSwitch;

class TemplateSwitcher extends \Frontend {


    protected $arrActiveController = [];


    public function __construct() {

        parent::__construct();

        if ( empty( $this->arrActiveController ) && \Input::get( 'ctlgSwitch' ) && $this->Database->tableExists( 'tl_switch_template_controller' ) ) {

            $objEntity = $this->Database->prepare( 'SELECT * FROM tl_switch_template_controller WHERE id = ?' )->limit( 1 )->execute( \Input::get( 'ctlgSwitch' ) );

            if ( $objEntity->numRows ) {

                $this->arrActiveController = $objEntity->row();
            }
        }
    }


    public function switchMainTemplate( $strTemplate, $objModule ) {

        // @todo check module id

        return $this->arrActiveController['customTemplate'] ?: $strTemplate;
    }


    public function switchView( &$objModule ) {

        // @todo check module id

        if ( $this->arrActiveController['overwritePagination'] ) {

            $objModule->setOffset( $this->arrActiveController['offset'] );
            $objModule->setPerPage( $this->arrActiveController['perPage'] );
            $objModule->setPagination( $this->arrActiveController['addPagination'] );
        }

        if ( $this->arrActiveController['listTemplate'] ) $objModule->setTemplate( $this->arrActiveController['listTemplate'] );
        if ( $this->arrActiveController['overwriteFastMode'] ) $objModule->setFastMode( $this->arrActiveController['fastMode'], $this->arrActiveController['preventFieldFromFastMode'] );
        if ( $this->arrActiveController['overwriteTableView'] ) $objModule->setTableView( $this->arrActiveController['enableTableView'], $this->arrActiveController['activeTableColumns'] );
    }
}