<?php

use \BxLeader\Adminer\Designs;

/**
 * Allow switching designs
 *
 * @link https://www.adminer.org/plugins/#use
 * @author Jakub Vrana, https://www.vrana.cz/
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
 */
class AdminerDesigns {

    /**
     * @param array URL in key, name in value
     */
    function __construct() {
        $this->designs = Designs::getDesignsList();
    }

    function headers() {
        if (isset($_POST['design']) && isset($this->designs[$_POST['design']])) {
            Designs::setUserDesign($_POST['design']);
            redirect($_SERVER['REQUEST_URI']);
        }
    }

    function css() {
        return array(Designs::getUserDesign());
    }

    function head()
    {
        if (Designs::getUserDesign(true) != 'bootstrap') {
            return;
        }
        ?>
        <script <?php echo nonce()?> src="<?=BX_ROOT?>/css/bxleader.adminer/designs/bootstrap/scripts.js"
                                     type='text/javascript'></script>
        <?php
    }

    function navigation($missing) {
        echo "<div style='position: fixed; bottom: .5em; right: .5em;'>
            Change design:
            <form action='' method='post'>"
            . html_select(
                'design',
                $this->designs,
                Designs::getUserDesign(),
                'this.form.submit();')
            . "</form>
        </div>";
    }
}