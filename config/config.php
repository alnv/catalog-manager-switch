<?php

array_insert( $GLOBALS['TL_CTE'], 3, [

    'catalog-manager-switch' => [

        'catalogTemplateSwitcher' => 'CatalogManager\CMSwitch\TemplateSwitchElement'
    ]
]);

$GLOBALS['BE_MOD']['content']['article']['tables'][] = 'tl_switch_template_controller';

$GLOBALS['TL_HOOKS']['catalogManagerModifyMainTemplate'][] = [ 'CatalogManager\CMSwitch\TemplateSwitcher', 'switchMainTemplate' ];
$GLOBALS['TL_HOOKS']['catalogManagerBeforeInitializeView'][] = [ 'CatalogManager\CMSwitch\TemplateSwitcher', 'switchView' ];