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
            'flag' => 1,
            'fields' => [ 'name' ],
            'panelLayout' => 'filter;sort,search,limit'
        ],

        'label' => [

            'showColumns' => true,
            'fields' => [ 'name' ]
        ],

        'operations' => [

            'edit' => [

                'label' => &$GLOBALS['TL_LANG']['tl_switch_template_controller']['edit'],
                'href' => 'act=edit&foreignId=' . \Input::get( 'fid' ),
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

        'default' => '{general_settings},name,moduleId,icon;{template_settings},listTemplate,customTemplate;{pagination_legend},addPagination,perPage,offset;'
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
            ],

            'search' => true,
            'sorting' => true,
            'exclude' => true,

            'sql' => "varchar(128) NOT NULL default ''"
        ],

        'moduleId' => [

            'label' => &$GLOBALS['TL_LANG']['tl_switch_template_controller']['moduleId'],
            'inputType' => 'select',

            'eval' => [

                'chosen' => true,
                'tl_class' => 'w50',
                'submitOnChange' => true,
                'includeBlankOption' => true
            ],

            'options_callback' => [ 'CatalogManager\CMSwitch\tl_switch_template_controller', 'getModules' ],

            'exclude' => true,
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ],

        'icon' => [

            'label' => &$GLOBALS['TL_LANG']['tl_switch_template_controller']['icon'],
            'inputType' => 'fileTree',

            'eval' => [

                'fieldType' => 'radio',
                'tl_class' => 'clr',
            ],

            'exclude' => true,
            'sql' => "binary(16) NULL"
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