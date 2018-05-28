<?php

ClassLoader::addNamespace( 'CatalogManager\CMSwitch' );

ClassLoader::addClasses([

    'CatalogManager\CMSwitch\TemplateSwitchElement' => 'system/modules/catalog-manager-switch/elements/TemplateSwitchElement.php',
    'CatalogManager\CMSwitch\TemplateSwitcher' => 'system/modules/catalog-manager-switch/TemplateSwitcher.php',
    'CatalogManager\CMSwitch\tl_content' => 'system/modules/catalog-manager-switch/classes/tl_content.php'
]);

TemplateLoader::addFiles([

    'ce_template_switch' => 'system/modules/catalog-manager-switch/templates',
]);