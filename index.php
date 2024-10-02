<?php
session_start();

include_once __DIR__ .  '/config/config.php';
$con = new config();

if($con->auth()){
    switch(@$_GET['mod']){
        case 'dokter':
            include_once __DIR__ . '/admin/controller/dokter.php';
        break;
        default:
            include_once __DIR__ . '/admin/controller/home.php';
    }
} else{
    include_once __DIR__ .  '/admin/controller/controller.php';
}
?>