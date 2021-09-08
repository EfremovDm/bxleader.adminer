<?php
namespace BxLeader\Adminer;

use \Bitrix\Main\Application,
    \Bitrix\Main\Config\Option,
    \Bitrix\Main\Web\Json;

/**
 * Designs helper
 */
class Designs {

    public static function getDesignsList($bReverse = false) {

        $arDesigns = $bReverse ? array('default' => '') : array('' => 'default');
        $sDesignsPath = Application::getDocumentRoot() . BX_ROOT . '/css/bxleader.adminer/designs/*';

        foreach (glob($sDesignsPath, GLOB_ONLYDIR) as $sFilePath) {
            $sFilePath = str_replace(array('\\', Application::getDocumentRoot()), array('/', ''), $sFilePath);
            if (file_exists(Application::getDocumentRoot() . $sFilePath . '/adminer.css')) {
                if ($bReverse)
                    $arDesigns[basename($sFilePath)] = $sFilePath . '/adminer.css';
                else
                    $arDesigns[$sFilePath . '/adminer.css'] = basename($sFilePath);
            }
        }
        return $arDesigns;
    }

    public static function getUserDesign($bByName = false, $sDefaultDesign = 'ng9') {
        global $USER;
        $iUserId = $USER->GetID();
        $arDesigns = self::getDesignsList(true);
        $sOption = Option::get('bxleader.adminer', 'user_design');
        $arUsersDesign = !empty($sOption) ? Json::decode($sOption) : array();
        return isset($arUsersDesign[$iUserId]) && isset($arDesigns[$arUsersDesign[$iUserId]])
            ? ($bByName ? $arUsersDesign[$iUserId] : $arDesigns[$arUsersDesign[$iUserId]])
            : ($bByName ? $sDefaultDesign : $arDesigns[$sDefaultDesign]);
    }

    public static function setUserDesign($sDesign) {
        global $USER;
        $iUserId = $USER->GetID();
        $arDesigns = self::getDesignsList();
        $sOption = Option::get('bxleader.adminer', 'user_design');
        $arUsersDesign = !empty($sOption) ? Json::decode($sOption) : array();
        if (!isset($arUsersDesign[$iUserId]) || $arUsersDesign[$iUserId] != $arDesigns[$sDesign]) {
            $arUsersDesign[$iUserId] = $arDesigns[$sDesign];
            Option::set('bxleader.adminer', 'user_design', Json::encode($arUsersDesign));
        }
    }
}
