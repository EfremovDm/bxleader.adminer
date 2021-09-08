<?php

use \BxLeader\Adminer\Designs;

class AdminerBitrixVersion {

	private $sAdminPage;

	public function __construct($sAdminPage) {
		$this->sAdminPage = $sAdminPage;
	}

    public function name() {

        $sDesign = Designs::getUserDesign(true);

        switch ($sDesign) {
            case 'esterka':
                $sStyle = 'margin-top:50px;';
                break;
            case 'ng9':
            case 'pappu687':
            case 'pilot':
                $sStyle = 'margin-top:20px;';
                break;
            default:
                $sStyle = '';
        }

        switch ($sDesign) {
            case 'haeckel':
            case 'kahi':
                $sMainStyles = '
                    .buttonForm {padding:0!important;display:inline;overflow:visible!important;}
                    #bitrixButton {cursor:pointer}
                    #updateButton {background-color:green!important;color:white!important;cursor:pointer}
                ';
                break;
            default:
                $sMainStyles = '
                    #menu h1 {
                        height:auto!important;
                    }
                    .buttonForm {
                        width:94%!important;
                        height: 25px!important;
                        overflow: visible!important;
                    }
                    #updateForm {
                        margin-top:10px!important;
                    }
                    #bitrixButton {
                        width:100%!important;
                        height: 25px!important;
                        font-size: 13px!important;
                        line-height: 18px!important;
                        cursor:pointer
                    }
                    #updateButton {
                        width:100%!important;
                        height: 25px!important;
                        font-size: 13px!important;
                        line-height: 18px!important;
                        background-color:green!important;
                        background-image:none!important;
                        color:white!important;
                        cursor:pointer
                    }
                ';
        }

		return
            '<style>' .$sMainStyles .'</style>
             <form action="' . $this->sAdminPage . '" method="get" class="buttonForm" style="' . $sStyle . '">
                <input type="submit" value="'
                . (in_array($sDesign, array('haeckel', 'kahi')) ? 'Bitrix' : 'Bitrix panel'). '" id="bitrixButton">
             </form>'
            . (version_compare(version(), $_COOKIE['adminer_version']) < 0 ? '
                <form action="" method="post" class="buttonForm" id="updateForm">
                    <input type="hidden" name="updateAdminer" value="Y">
                    <input type="submit" value="'
                    . (in_array($sDesign, array('haeckel', 'kahi')) ? 'Update' : 'Update adminer') . '" id="updateButton">
                </form>'
                : '')
            . '<small>Adminer v.</small>';
	}

    function head()
    {
        if (version_compare(version(), $_COOKIE['adminer_version']) < 0) {
        ?>
        <script <?php echo nonce()?>type='text/javascript'>
            window.onload = function () {
                document.getElementById('updateForm').onsubmit = function() {
                    document.getElementById("updateButton").disabled = true;
                }
            }
        </script>
        <?php
        }
    }

    function headers() {
        if (!isset($_POST['updateAdminer']) || $_POST['updateAdminer'] != 'Y') {
            return;
        }
        $sUpdateUrl = 'https://www.adminer.org/latest.php';
        $sDestination = __DIR__ . '/../adminer-mysql.php';
        $newAdminer = file_get_contents($sUpdateUrl);
        if (!empty($newAdminer)) {
            file_put_contents($sDestination, $newAdminer, FILE_BINARY);
        }
        redirect($_SERVER['REQUEST_URI']);
    }
}
