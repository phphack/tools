<?php
/**
 * php.ini配置
 * auto_prepend_file = d:/wamp/www/phpdebug.php
 */
function debug()
{
    $argNum = func_num_args();
    $argList = func_get_args();
    for ($i = 0; $i < $argNum; $i++) {
        $data = $argList[$i];
        if (is_scalar($data) || is_null($data)) {
            error_log(var_export($data, true));
        } else {
            error_log(print_r($data, true));
        }
    }

}