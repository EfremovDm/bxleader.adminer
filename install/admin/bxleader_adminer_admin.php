<?
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_before.php');

$path = \Bitrix\Main\Loader::getLocal('modules/bxleader.adminer/admin/bxleader_adminer_admin.php');

if (file_exists($path)) {
    include_once $path;
}
else {
    $arPath = pathinfo(__FILE__);
    ShowMessage($arPath['basename'] . ' not found!');
}
