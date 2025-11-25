<?php
// functions.php


function is_logged() {
    return isset($_SESSION['user_id']);
}

function is_admin() {
    return isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin';
}

function flash($name = '', $message = '') {
    if ($name && $message) {
        $_SESSION['flash'][$name] = $message;
    } elseif ($name) {
        if (isset($_SESSION['flash'][$name])) {
            $msg = $_SESSION['flash'][$name];
            unset($_SESSION['flash'][$name]);
            return $msg;
        }
    }
    return '';
}

function esc($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>