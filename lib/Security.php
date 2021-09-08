<?php
namespace BxLeader\Adminer;

use \Bitrix\Main\Loader;

/**
 * Security filter mask management
 */
class Security {

    public static final function securityModuleInstall($sModule) {
        if ($sModule == 'security') {
            self::installSecurityFilterMask(true);
        }
    }

    /**
     * Install/Uninstall security filter mask for this module
     *
     * @param bool $bInstall
     * @param string $sMask
     */
    public static final function installSecurityFilterMask(
        $bInstall, $sMask = '/admin/bxleader_adminer_admin.php*'
    ) {
        if (!Loader::includeModule('security')) {
            return;
        }

        $sMask = BX_ROOT . $sMask;

        $arMask = array();
        $rsSecurityFilterExclMask = \CSecurityFilterMask::GetList();
        while ($arItem = $rsSecurityFilterExclMask->Fetch()) {
            $arMask[$arItem['FILTER_MASK']] = array('MASK' => $arItem['FILTER_MASK'],'SITE_ID' => $arItem['SITE_ID']);
        }

        if ($bInstall) {
            if (isset($arMask[$sMask]))
                return;
            else
                $arMask[] = array('MASK' => $sMask,'SITE_ID' => '');
        }
        else {
            if (isset($arMask[$sMask]))
                unset($arMask[$sMask]);
            else
                return;
        }

        \CSecurityFilterMask::Update($arMask);
    }
}
