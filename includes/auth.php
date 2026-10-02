<?php
session_start();


const ADMIN_USER = 'admin';
const ADMIN_PASS = 'Informatik@#basdat2';

function wajib_login() {
    if (empty($_SESSION['admin'])) {
        header('Location: login.php');
        exit;
    }
}
