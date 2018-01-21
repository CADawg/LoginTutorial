<?php
function verifyPassHash($hash,$password) {
    $md5 = md5($password);
    $base64 = base64_encode($md5);
    if (password_verify($base64,$hash)) {
        return true;
    } else {
        return false;
    }
}

function hashPass($password) {
    /*Send To DB*/
    /*Gets Cost For A 250ms Delay!*/
    $config = include 'config.php';
    if ($config->useStaticCost) {
    $options = [
        'cost' => $config->staticCost,
    ];} else {
        $benchmarker = include 'benchmark.php';
        $options = [
            'cost' => $benchmarker->cost,
    ];}
    $md5 = md5($password);
    $base64 = base64_encode($md5);
    $hashedPass = password_hash($base64,PASSWORD_BCRYPT,$options);
    return $hashedPass;
} 
