<?php
function checkPostRequest($next) {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Método não suportado.']);
        return;
    }
    $next();
}