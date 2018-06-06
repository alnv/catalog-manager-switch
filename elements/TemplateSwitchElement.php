<?php

namespace CatalogManager\CMSwitch;

class TemplateSwitchElement extends \ContentElement {


    protected $arrController = [];
    protected $strTemplate = 'ce_template_switch';


    public function generate() {

        if ( TL_MODE == 'BE' ) {

            $objTemplate = new \BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### TEMPLATE SWITCH ###';

            return $objTemplate->parse();
        }

        return parent::generate();
    }


    protected function compile() {

        $objEntities = $this->Database->prepare( 'SELECT * FROM tl_switch_template_controller WHERE fid = ? ORDER BY id ASC' )->execute( $this->id );

        if ( $objEntities->numRows ) {

            while ( $objEntities->next() ) {

                $blnActive = \Input::get( 'ctlgSwitch' ) && \Input::get( 'ctlgSwitch' ) == $objEntities->id ? true : false;
                $arrSwitch = $objEntities->row();

                $strIcon = $arrSwitch['icon'] ?: '';

                if ( $arrSwitch['iconActive'] && $blnActive ) $strIcon = $arrSwitch['iconActive'] ?: '';

                $arrSwitch['css'] = $blnActive ? ' active' : '';
                $arrSwitch['icon'] = $this->getIcon( $strIcon );
                $arrSwitch['action'] = $this->generateActionAttribute( $arrSwitch['id'] );

                $this->arrController[] = $arrSwitch;
            }
        }

        $this->Template->controllers = $this->arrController;
    }


    protected function getIcon( $strSingleSrc ) {

        $arrImage = [];

        if ( !$strSingleSrc ) return $arrImage;

        $objFile = \FilesModel::findByUuid( $strSingleSrc );

        if ( $objFile !== null ) {

            $arrImage = $objFile->row();

            if ( !$arrImage['meta'] ) {

                $arrImage['meta'] = [

                    'title' => ''
                ];
            }
        }

        return $arrImage;
    }


    protected function generateActionAttribute( $strId ) {

        $strBind = '&';
        $strUrl = ampersand( \Environment::get('indexFreeRequest') );

        if ( strpos( $strUrl, 'ctlgSwitch' ) !== false ) return preg_replace( '/ctlgSwitch=[^&]*/i', ( 'ctlgSwitch=' . $strId ), $strUrl );

        if ( strpos( $strUrl, '?' ) === false )  $strBind = '?';

        return $strUrl  . $strBind . 'ctlgSwitch=' . $strId;
    }
}