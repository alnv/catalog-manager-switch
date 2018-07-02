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

        $strPerPage = '';
        $strPage = 'page_e' . $this->switchModuleId;
        $objEntities = $this->Database->prepare( 'SELECT * FROM tl_switch_template_controller WHERE fid = ? ORDER BY id ASC' )->execute( $this->id );
        $objModule = $this->Database->prepare( 'SELECT * FROM tl_module WHERE id = ?' )->limit( 1 )->execute( $this->switchModuleId );

        if ( $objModule->numRows ) $strPerPage = $objModule->catalogPerPage;

        if ( $objEntities->numRows ) {

            while ( $objEntities->next() ) {

                $blnActive = \Input::get( 'ctlgSwitch' ) && \Input::get( 'ctlgSwitch' ) == $objEntities->id ? true : false;
                $arrSwitch = $objEntities->row();
                $strIcon = $arrSwitch['icon'] ?: '';

                if ( $arrSwitch['isDefault'] && !$arrSwitch['perPage'] && (int) \Input::get( $strPage ) > 1 ) $arrSwitch['perPage'] = $strPerPage;

                if ( $arrSwitch['iconActive'] && $blnActive ) $strIcon = $arrSwitch['iconActive'] ?: '';

                if ( !\Input::get( 'ctlgSwitch' ) && $arrSwitch['isDefault'] ) {

                    $blnActive = true;
                    $strIcon = $arrSwitch['iconActive'] ?: $arrSwitch['icon'];
                }

                $arrSwitch['css'] = $blnActive ? ' active' : '';
                $arrSwitch['icon'] = $this->getIcon( $strIcon );
                $arrSwitch['action'] = $this->generateActionAttribute( $arrSwitch['id'], $strPerPage == $arrSwitch['perPage'], $strPage );

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


    protected function generateActionAttribute( $strId, $blnPagination, $strPage ) {

        $strBind = '&';
        $strUrl = ampersand( \Environment::get('indexFreeRequest') );

        if ( strpos( $strUrl, $strPage ) !== false && !$blnPagination ) {

            $strReplace = $strPage . '=1';
            $strPageToReplace = $strPage . '=' . \Input::get( $strPage );
            $strUrl = str_replace( $strPageToReplace, $strReplace, $strUrl );
        }

        if ( strpos( $strUrl, 'ctlgSwitch' ) !== false ) return preg_replace( '/ctlgSwitch=[^&]*/i', ( 'ctlgSwitch=' . $strId ), $strUrl );

        if ( strpos( $strUrl, '?' ) === false )  $strBind = '?';

        return $strUrl  . $strBind . 'ctlgSwitch=' . $strId;
    }
}