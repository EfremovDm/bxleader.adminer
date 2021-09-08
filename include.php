<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

\Bitrix\Main\Loader::registerAutoLoadClasses('bxleader.adminer', array(
    'BxLeader\Adminer\Designs'     => 'lib/Designs.php',
    'BxLeader\Adminer\Security'    => 'lib/Security.php',
    'AdminerBitrixCredentials'     => 'vendor/plugins/AdminerBitrixCredentials.php',
    'AdminerBitrixVersion'         => 'vendor/plugins/AdminerBitrixVersion.php',
    'AdminerDesigns'               => 'vendor/plugins/AdminerDesigns.php',
    'AdminerDumpArray'             => 'vendor/plugins/AdminerDumpArray.php',
    'AdminerDumpBz2'               => 'vendor/plugins/AdminerDumpBz2.php',
    'AdminerDumpDate'              => 'vendor/plugins/AdminerDumpDate.php',
    'AdminerDumpJson'              => 'vendor/plugins/AdminerDumpJson.php',
    'AdminerDumpMarkdown'          => 'vendor/plugins/AdminerDumpMarkdown.php',
    'AdminerDumpXml'               => 'vendor/plugins/AdminerDumpXml.php',
    'AdminerDumpZip'               => 'vendor/plugins/AdminerDumpZip.php',
    'AdminerPHPSerializedColumn'   => 'vendor/plugins/AdminerPHPSerializedColumn.php',
    'AdminerPlugin'                => 'vendor/plugins/AdminerPlugin.php',
    'AdminerReadableDates'         => 'vendor/plugins/AdminerReadableDates.php',
    'AdminerSearchAutocomplete'    => 'vendor/plugins/AdminerSearchAutocomplete.php',
    'AdminerTableHeaderScroll'     => 'vendor/plugins/AdminerTableHeaderScroll.php',
    'AdminerTablesFilter'          => 'vendor/plugins/AdminerTablesFilter.php',
));
