<?php

$GLOBALS['TL_DCA']['tl_content']['palettes']['catalogTemplateSwitcher'] = '{type_legend},type,headline;{switch_template_legend},switchModuleId,switchTemplateController;{template_legend:hide},customCatalogElementTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['fields']['switchTemplateController'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_content']['switchTemplateController'],

    'inputType' => 'dcaWizard',
    'foreignTable' => 'tl_switch_template_controller',
    'foreignField' => 'fid',

    'params' => [

        'fid' => \Input::get( 'id' )
    ],

    'eval' => [

        'tl_class' => 'clr',
        'showOperations' => true,
        'orderField' => 'id ASC',
        'fields' => [ 'id', 'name' ]
    ]
];

$GLOBALS['TL_DCA']['tl_content']['fields']['switchModuleId'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_content']['switchModuleId'],
    'inputType' => 'select',

    'eval' => [

        'chosen' => true,
        'mandatory' => true,
        'tl_class' => 'clr w50',
        'submitOnChange' => true,
        'includeBlankOption' => true
    ],

    'options_callback' => [ 'CatalogManager\CMSwitch\tl_content', 'getModules' ],

    'exclude' => true,
    'sql' => "int(10) unsigned NOT NULL default '0'"
];