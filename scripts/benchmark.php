<?php
function getOptimalBcryptCostParameter($min_ms = 250) {
    for ($i = 4; $i < 31; $i++) {
        $options = [ 'cost' => $i, 'salt' => 'usesomesillystringforsalt' ];
        $time_start = microtime(true);
        password_hash("rasmuslerdorf", PASSWORD_BCRYPT, $options);
        $time_end = microtime(true);
        if (($time_end - $time_start) * 1000 > $min_ms) {
            return $i;
        }
    }
}

if (isset($_GET['getStaticCost'])) {
    print("in 250ms(min) you can decrypt a password of cost: ".getOptimalBcryptCostParameter());
}

return (object) array(
    'cost' => getOptimalBcryptCostParameter()
);
?>
