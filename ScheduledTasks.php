<?php

if (!isset($_SESSION['AuthTokenAdmin'])) {
    header('location: login.php');
}

?>