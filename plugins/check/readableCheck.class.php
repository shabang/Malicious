<?php
/**
 * A "plugin" to check if file is readable
 *
 * @copyright Ackwa.fr - 2014
 */
class readableCheck extends maliciousCheck {
    function description() {
        return 'Non readable files';
    }
    function checkDirectories() {
        return true;
    }
    function check($sPath, $aContent = null) {
        $this->iCount++;
        if (!is_readable($sPath)) $this->lFiles[$sPath] = 1;
        return (isset($this->lFiles[$sPath]) ? true : false);  // STOP if not readable
    }
}