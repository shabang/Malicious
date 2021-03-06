<?php
/**
 * A "plugin" to track PHP files with suspect "eval()"
 *
 * @copyright Ackwa.fr - 2014
 * @see       https://github.com/mikestowe/Malicious-Code-Scanner
 */
class evalCheck extends maliciousCheck {
    function description() {
        return 'PHP files with suspect "eval()';
    }
    function filter($sPath) {
        return (('php' == $this->extension($sPath)) ? true : false);
    }
    function needFileContent() {
        return true;
    }
    function __construct() {
        $this->lRegex = array(
            'x29'                                 =>  1,
            'x3b'                                 =>  2,
            'str_rot13\s*\('                      =>  3,
            'register_shutdown_function\s*\('     =>  4,
            'eval\s*\(\s*$_'                      => 11,
            'eval\s*\(\s*base64'                  => 12,
            'create_function\s*\('                => 13,
            'eval\s*\(gzinflate\s*\(\s*base64'    => 20,
            'preg_replace\s*\(\s*(\'|").*e(\'|")' => 21

        );
    }
    function check($sPath, $sContent = null) {
        $this->iCount++;
        $this->iSize+= strlen($sContent);
        if ($sContent) {
            foreach($this->lRegex as $sRegex => $iGravity) {
                if (preg_match('/'.$sRegex.'/i', $sContent)) {
                    $this->lFiles[$sPath] = (isset($this->lFiles[$sPath]) ? $this->lFiles[$sPath] : 0) + $iGravity;
                }
            }
        }
        return false;
    }
}