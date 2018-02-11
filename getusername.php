<?php
session_start();
if (isset($_SESSION['user'])) {
    echo 'logged in as ' . $_SESSION['user']; //just use $_SESSION['user'] where you want to know their name.
} else {
    echo 'you are not logged in';
}

?>
