<?php
//Database Config:

return (object) array(
    'host' => 'localhost',
    'username' => 'YourUser',
    'pass' => 'YourPassword',
    'database' => 'loginsystem',
    'useStaticCost' => true, //Set to true when you have worked out your time on your server.
    'staticCost' => 12, //Work out by going to /scripts/benchmark.php?getStaticCost
    'domain' => 'localhost'
);
?>
