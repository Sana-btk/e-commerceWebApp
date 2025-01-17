<?php

session_start();
include('tp5config.php');
session_unset();
session_destroy();
header('Location:tp5authentification.php');

?>