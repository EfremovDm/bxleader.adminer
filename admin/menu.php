<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

global $USER;
if (!$USER->IsAdmin()) {
    return false;
}

return array(
    'parent_menu' => 'global_menu_services',
    'section'     => 'bxleader_adminer',
    'sort'        => 1010,
    'url'         => 'bxleader_adminer_admin.php',
    'text'        => Loc::getMessage('BXLEADER_ADMINER_ADMIN_MENU_TEXT'),
    'title'       => Loc::getMessage('BXLEADER_ADMINER_ADMIN_MENU_TITLE'),
    'icon'        => 'bxleader_adminer_menu_icon',
    'module_id'   => 'bxleader.adminer',
);
