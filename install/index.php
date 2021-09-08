<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use \Bitrix\Main\Application,
    \Bitrix\Main\EventManager,
    \Bitrix\Main\Loader,
    \Bitrix\Main\Config\Option,
    \Bitrix\Main\IO\Directory,
    \Bitrix\Main\ModuleManager,
    \BxLeader\Adminer\Security;

IncludeModuleLangFile(__FILE__);

if (class_exists('bxleader_adminer')) return;

class bxleader_adminer extends CModule {
    
    const  BX_MIN_VERSION = '14.00.00';
    public $MODULE_ID     = 'bxleader.adminer';
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $MODULE_GROUP_RIGHTS = 'Y';
    public $PARTNER_NAME;
    public $PARTNER_URI;

    public function bxleader_adminer() {
        
		$arModuleVersion = array();
		include_once dirname(__FILE__) . '/version.php';

        $this->MODULE_ID           = 'bxleader.adminer';
		$this->MODULE_NAME         = GetMessage('BXLEADER_ADMINER_MODULE_NAME');
		$this->MODULE_DESCRIPTION  = GetMessage('BXLEADER_ADMINER_MODULE_DESC');
        $this->MODULE_VERSION      = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        $this->PARTNER_NAME        = 'BxLeader';
        $this->PARTNER_URI         = 'https://bitrix-programmer.ru/';
    }

    public function DoInstall() {
        try {
            $this->checkRequirements();
            $this->InstallAdminerLastVersion();
            $this->InstallFiles();
            $this->InstallDB();
            $this->InstallEvents();
            $this->InstallSecurityFilterMask(true);
        } catch (Exception $e) {
            global $APPLICATION;
            $APPLICATION->ThrowException($e->getMessage());
            return false;
        }
    }

    public function DoUninstall() {
        $this->UnInstallFiles();
        $this->UnInstallEvents();
        $this->InstallSecurityFilterMask(false);
        $this->UnInstallModuleOptions();
        $this->UnInstallDB();
    }

    /**
     * Check minimal requirements
     *
     * @throws Exception
     */
    public function checkRequirements() {
        $arError = array();
        if (!CheckVersion(SM_VERSION, self::BX_MIN_VERSION)) {
            $arError[] = GetMessage('BXLEADER_ADMINER_MODULE_ERROR_BX_VERSION',
                array('#VERSION#' => self::BX_MIN_VERSION)
            );
        }
        if (!empty($arError)) {
            array_unshift($arError, '');
            throw new \Exception(nl2br(join(PHP_EOL, $arError)));
        }
    }

    /**
     * Install adminer last version from official
     */
    public function InstallAdminerLastVersion() {
        $sUpdateUrl = 'https://www.adminer.org/latest.php';
        $sDestination = __DIR__ . '/../vendor/adminer-mysql.php';
        $newAdminer = file_get_contents($sUpdateUrl);
        if (!empty($newAdminer)) {
            file_put_contents($sDestination, $newAdminer, FILE_BINARY);
        }
    }

    public function InstallFiles() {
        \CopyDirFiles(
            __DIR__ . '/admin',
            Application::getDocumentRoot() . BX_ROOT . '/admin',
            true
        );
        \CopyDirFiles(
            __DIR__ . '/themes',
            Application::getDocumentRoot() . BX_ROOT .'/themes',
            true,
            true
        );
        \CopyDirFiles(
            __DIR__ . '/../vendor/designs',
            Application::getDocumentRoot() . BX_ROOT . '/css/' . $this->MODULE_ID . '/designs',
            true,
            true
        );
        return true;
    }

    public function UnInstallFiles() {
        \DeleteDirFiles(
            __DIR__ . '/admin',
            Application::getDocumentRoot() . BX_ROOT . '/admin'
        );
        \DeleteDirFiles(
            __DIR__ . '/themes/.default/',
            Application::getDocumentRoot() . BX_ROOT . '/themes/.default/'
        ); // css
        Directory::deleteDirectory(
            Application::getDocumentRoot() . BX_ROOT . '/themes/.default/icons/' . $this->MODULE_ID . '/'
        ); // icons
        Directory::deleteDirectory(
            Application::getDocumentRoot() . BX_ROOT . '/css/' . $this->MODULE_ID . '/'
        ); // designs
        return true;
    }

    public function InstallDB() {
        ModuleManager::registerModule($this->MODULE_ID);
		return true;
	}

    public function UnInstallDB($arParams = array()) {
        ModuleManager::unRegisterModule($this->MODULE_ID);
        return true;
    }

    public function InstallEvents() {
        EventManager::getInstance()->registerEventHandlerCompatible(
            'main',
            'OnAfterRegisterModule',
            $this->MODULE_ID,
            'BxLeader\\Adminer\\Security',
            'securityModuleInstall'
        );
		return true;
	}

    public function UnInstallEvents() {
        EventManager::getInstance()->unRegisterEventHandler(
            'main',
            'OnAfterRegisterModule',
            $this->MODULE_ID,
            'BxLeader\\Adminer\\Security',
            'securityModuleInstall'
        );
		return true;
	}

    /**
     * Install/Uninstall security filter mask for this module
     *
     * @param bool $bInstall
     * @param string $sMask
     */
    private final function InstallSecurityFilterMask($bInstall) {
        Loader::includeModule($this->MODULE_ID);
        Security::installSecurityFilterMask($bInstall);
    }

    /**
     * Uninstall module options
     */
    private final function UnInstallModuleOptions() {
        Option::delete($this->MODULE_ID);
    }
}
