<?php

$url = $_GET['url'] ?? '';

switch ($url) {
    case '':
        require __DIR__ . '/View/home.php';
        break;
        
    case 'post':

        require __DIR__ . '/View/publish.php';
        break;

    default:
        http_response_code(404);
        echo 'Page non trouvée';
        break;
}