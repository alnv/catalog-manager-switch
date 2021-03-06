<?php

$GLOBALS['TL_DCA']['tl_switch_template_controller'] = [

    'config' => [

        'dataContainer' => 'Table',

        'onsubmit_callback' => [ [ 'CatalogManager\CMSwitch\tl_switch_template_controller', 'setForeignId' ] ],

        'sql' => [

            'keys' => [

                'id' => 'primary'
            ]
        ]
    ],

    'list' => [

        'sorting' => [

            'mode' => 2,
            'flag' => 2,
            'fields' => [ 'id', 'name' ],
            'panelLayout' => 'filter;sort,search,limit',
            'filter' => [ [ 'fid=?', \Input::get('id') ] ]
        ],

        'label' => [

            'showColumns' => true,
            'fields' => [ 'name' ]
        ],

        'operations' => [

            'edit' => [

                'label' => &$GLOBALS['TL_LANG']['tl_switch_template_controller']['edit'],
                'href' => 'act=edit',
                'icon' => 'header.gif'
            ],

            'delete' => [

                'label' => &$GLOBALS['TL_LANG']['tl_switch_template_controller']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ],

            'show' => [

                'label' => &$GLOBALS['TL_LANG']['tl_switch_template_controller']['show'],
                'href' => 'act=show',
                'icon' => 'show.gif'
            ]
        ],

        'global_operations' => [

            'all' => [

                'label' => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            ]
        ]
    ],

    'palettes' => [

        '__selector__' => [ 'overwritePagination', 'overwriteTableView', 'overwriteFastMode' ],

        'default' => '{general_settings},name,isDefault,icon,iconActive;{view_settings},overwriteTableView,overwriteFastMode;{template_settings},listTemplate,customTemplate;{pagination_legend},overwritePagination;'
    ],

    'subpalettes' => [

        'overwritePagination' => 'addPagination,perPage,offset',
        'overwriteFastMode' => 'fastMode,preventFieldFromFastMode',
        'overwriteTableView' => 'enableTableView,activeTableColumns'
    ],

    'fields' => [

        'id' => [

            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ],

        'tstamp' => [

            'sql' => "int(10) unsigned NOT NULL default '0'"
        ],

        'fid' => [

            'sql' => "int(10) unsigned NOT NULL default '0'"
        ],

        'name' => [

            'label' => &$GLOBALS['TL_LANG']['tl_switch_template_controller']['name'],
            'inputType' => 'text',

            'eval' => [

                'maxlength' => 128,
                'doNotCopy' => true,
                'tl_class' => 'w50',
                'mandatory' => true
            ],

            'search' => true,
            'sorting' => true,
            'exclude' => true,

            'sql' => "varchar(128) NOT NULL default ''"
        ],

        'icon' => [

            'label' => &$GLOBALS['TL_LANG']['tl_switch_template_controller']['icon'],
            'inputType' => 'fileTree',

            'eval' => [

                'files' => true,
                'filesOnly' => true,
                'tl_class' => 'clr',
                'fieldType' => 'radio',
                'extensions' => $GLOBALS['TL_CONFIG']['validImageTypes']
            ],

            'exclude' => true,
            'sql' => "binary(16) NULL"
        ],

        'iconActive' => [

            'label' => &$GLOBALS['TL_LANG']['tl_switch_template_controller']['iconActive'],
            'inputType' => 'fileTree',

            'eval' => [

                'files' => true,
                'filesOnly' => true,
                'tl_class' => 'clr',
                'fieldType' => 'radio',
                'extensions' => $GLOBALS['TL_CONFIG']['validImageTypes']
            ],

            'exclude' => true,
            'sql' => "binary(16) NULL"
        ],

        'isDefault' => [

            'label' => &$GLOBALS['TL_LANG']['tl_switch_template_controller']['isDefault'],
            'inputType' => 'checkbox',

            'eval' => [

                'tl_class' => 'w50 m12',
            ],

            'exclude' => true,
            'sql' => "char(1) NOT NULL default ''"
        ],

        'overwriteTableView' => [

            'label' => &$GLOBALS['TL_LANG']['tl_switch_template_controller']['overwriteTableView'],
            'inputType' => 'checkbox',

            'eval' => [

                'tl_class' => 'clr',
                'submitOnChange' => true
            ],

            'exclude' => true,
            'sql' => "char(1) NOT NULL default ''"
        ],

        'enableTableView' => [

            'label' => &$GLOBALS['TL_LANG']['tl_switch_template_controller']['enableTableView'],
            'inputType' => 'checkbox',

            'eval' => [

                'tl_class' => 'clr'
            ],

            'exclude' => true,
            'sql' => "char(1) NOT NULL default ''"
        ],

        'overwriteFastMode' => [

            'label' => &$GLOBALS['TL_LANG']['tl_switch_template_controller']['overwriteFastMode'],
            'inputType' => 'checkbox',

            'eval' => [

                'tl_class' => 'clr',
                'submitOnChange' => true
            ],

            'exclude' => true,
            'sql' => "char(1) NOT NULL default ''"
        ],

        'fastMode' => [

            'label' => &$GLOBALS['TL_LANG']['tl_switch_template_controller']['fastMode'],
            'inputType' => 'checkbox',

            'eval' => [

                'tl_class' => 'clr'
            ],

            'exclude' => true,
            'sql' => "char(1) NOT NULL default ''"
        ],

        'preventFieldFromFastMode' => [

            'label' => &$GLOBALS['TL_LANG']['tl_switch_template_controller']['preventFieldFromFastMode'],
            'inputType' => 'checkbox',

            'eval' => [

                'multiple' => true,
                'tl_class' => 'clr'
            ],

            'options_callback' => [ 'CatalogManager\CMSwitch\tl_switch_template_controller', 'getFastModeFields' ],

            'exclude' => true,
            'sql' => "blob NULL"
        ],

        'activeTableColumns' => [

            'label' => &$GLOBALS['TL_LANG']['tl_switch_template_controller']['activeTableColumns'],
            'inputType' => 'checkboxWizard',

            'eval' => [

                'multiple' => true,
                'tl_class' => 'clr'
            ],

            'options_callback' => [ 'CatalogManager\CMSwitch\tl_switch_template_controller', 'getAllColumns' ],

            'exclude' => true,
            'sql' => "blob NULL"
        ],

        'listTemplate' => [

            'label' => &$GLOBALS['TL_LANG']['tl_switch_template_controller']['listTemplate'],
            'inputType' => 'select',

            'eval' => [

                'chosen' => true,
                'maxlength' => 64,
                'tl_class' => 'w50',
                'includeBlankOption' => true
            ],

            'options_callback' => [ 'CatalogManager\CMSwitch\tl_switch_template_controller', 'getListTemplates' ],

            'exclude' => true,
            'sql' => "varchar(64) NOT NULL default ''"
        ],

        'customTemplate' => [

            'label' => &$GLOBALS['TL_LANG']['tl_switch_template_controller']['customTemplate'],
            'inputType' => 'select',

            'eval' => [

                'chosen' => true,
                'maxlength' => 64,
                'tl_class' => 'w50',
                'includeBlankOption' => true
            ],

            'options_callback' => [ 'CatalogManager\CMSwitch\tl_switch_template_controller', 'getCustomTemplates' ],

            'exclude' => true,
            'sql' => "varchar(64) NOT NULL default ''"
        ],

        'overwritePagination' => [

            'label' => &$GLOBALS['TL_LANG']['tl_switch_template_controller']['overwritePagination'],
            'inputType' => 'checkbox',

            'eval' => [

                'tl_class' => 'clr',
                'submitOnChange' => true
            ],

            'exclude' => true,
            'sql' => "char(1) NOT NULL default ''"
        ],

        'addPagination' => [

            'label' => &$GLOBALS['TL_LANG']['tl_switch_template_controller']['addPagination'],
            'inputType' => 'checkbox',

            'eval' => [

                'tl_class' => 'clr'
            ],

            'exclude' => true,
            'sql' => "char(1) NOT NULL default ''"
        ],

        'perPage' => [

            'label' => &$GLOBALS['TL_LANG']['tl_switch_template_controller']['perPage'],
            'inputType' => 'text',
            'default' => 0,

            'eval' => [

                'rgxp' => 'natural',
                'tl_class' => 'w50'
            ],

            'exclude' => true,
            'sql' => "smallint(5) unsigned NOT NULL default '0'"
        ],

        'offset' => [

            'label' => &$GLOBALS['TL_LANG']['tl_switch_template_controller']['offset'],
            'inputType' => 'text',
            'default' => 0,

            'eval' => [

                'rgxp' => 'natural',
                'tl_class' => 'w50'
            ],

            'exclude' => true,
            'sql' => "smallint(5) unsigned NOT NULL default '0'"
        ]
    ]
];