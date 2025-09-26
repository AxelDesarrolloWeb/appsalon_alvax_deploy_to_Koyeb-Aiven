<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function esUltimo(string $actual, string $proximo): bool {

    if($actual !== $proximo) {
        return true;
    }
    return false;
}

// Función que revisa que el usuario este autenticado
function isAuth() : void {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (empty($_SESSION['login'])) {
        header('Location: /');
        exit;
    }
}

function isAdmin() : void {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    // Debe existir y ser exactamente "1"
    if (empty($_SESSION['admin']) || $_SESSION['admin'] !== "1") {
        if (!empty($_SESSION['login'])) {
            header('Location: /cita');
        } else {
            header('Location: /');
        }
        exit;
    }
}