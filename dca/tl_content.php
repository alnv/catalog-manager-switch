<?php

$GLOBALS['TL_DCA']['tl_content']['palettes']['catalogTemplateSwitcher'] = '{type_legend},type,headline;{switch_template_legend},switchTemplateController;{template_legend:hide},customCatalogElementTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['fields']['switchTemplateController'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_content']['switchTemplateController'],

    'inputType' => 'dcaWizard',

    'foreignTable' => 'tl_switch_template_controller',
    'foreignField' => 'fid',

    'eval' => [

        'fields' => [],
        'headerFields' => [],
        'orderField' => 'id DESC',

        'listCallback' => [ 'CatalogManager\CMSwitch\tl_content', 'generateWizardList' ],
    ]
];