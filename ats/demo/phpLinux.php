<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-7-15
 * Time: 下午5:59
 */

require_once '../ats_config.inc.php';
require_once '../function/atsDbConnect.php';

$detectFileName = ATS_PREPARE_PATH. ATS_PREPARE_FILE. ATS_FILE_suffix;

while(true){
    sleep(5);
    echo exec('stat -c %Y '. $detectFileName). '\n';

//    echo filemtime($detectFileName). '\n'; // cannot get dynamic data in loop
}