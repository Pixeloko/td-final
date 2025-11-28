<?php

$uri = isset($_GET['uri']) ? '/' . trim($_GET['uri'], '/') : '/';

if ($uri === '/liste') {
    // require './Controller/';

} else {
    echo 'Page non trouvée.';
}

?>