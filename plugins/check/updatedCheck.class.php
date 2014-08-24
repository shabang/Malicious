<?php
/**
 * A "plugin" to check if file has been updated since last check
 */
class updatedCheck extends maliciousCheck {
    function check($sPath, $aContent = null) {
        $this->iCount++;
        if (filemtime($sPath) > filemtime(__FILE__)) $this->lFiles[$sPath] = true;
        return false;
    }
    function __destruct() {
        touch(__FILE__);
    }
}