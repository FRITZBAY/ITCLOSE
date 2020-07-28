<?php
session_start();

if(isset($_SESSION['ID_USER'])){
    unset($_SESSION['ID_USER']);
    header('Location: index.php');
}
else if(isset($_COOKIE['ID_USER'])){
    unset($_COOKIE['ID_USER']);
    header('Location: index.php');
} else{
    header('Location: index.php');
}
