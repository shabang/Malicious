<?php
/**
 * A "plugin" to check for big files and files larger "than post_max_size"
 */
class bigCheck extends maliciousCheck {
    function check($sPath, $aContent = null) {
        $this->iCount++;
        if (filesize($sPath) > 1000000) $this->lFiles[$sPath] = 1;
        if (filesize($sPath) > bytes(ini_get('post_max_size'))) $this->lFiles[$sPath] = 10;
        return false;
    }
}