<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use \Bitrix\Main\Application,
    \Bitrix\Main\Loader;

global $USER, $APPLICATION;

if (!$USER->IsAdmin()) {
	$APPLICATION->AuthForm('');
}

if (!Loader::includeModule('bxleader.adminer')) {
    die('Module not installed!');
}

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

/**
 * Main function
 *
 * @return AdminerPlugin
 */
function adminer_object() {

	$arPlugins = array(
        new AdminerBitrixCredentials(Application::getConnection()->getConfiguration()),
        new AdminerBitrixVersion(GetDirPath(GetPagePath(false, true))),
        new AdminerDesigns(),
        new AdminerDumpArray(),
        new AdminerDumpBz2(),
        new AdminerDumpDate(),
        new AdminerDumpJson(),
        new AdminerDumpMarkdown(),
        new AdminerDumpXml(),
		new AdminerDumpZip(),
        new AdminerPHPSerializedColumn(),
        new AdminerReadableDates(),
        new AdminerSearchAutocomplete(),
        new AdminerTableHeaderScroll(),
        new AdminerTablesFilter(),
	);

	return new AdminerPlugin($arPlugins);
}

include_once __DIR__ . '/../vendor/adminer-mysql.php';
