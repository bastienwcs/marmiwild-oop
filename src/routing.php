<?php

require_once __DIR__.'/controllers/RecipeController.php';
require_once __DIR__.'/models/RecipeModel.php';

$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$controller = new RecipeController();
if ('/' === $urlPath) {
    $controller->browse();
} elseif ('/show' === $urlPath && isset($_GET['id'])) {
    $controller->show($_GET['id']);
} elseif ('/add' === $urlPath) {
    $controller->add();
} elseif ('/delete' === $urlPath) {
    $controller->remove($_GET['id']);
} else {
    header('HTTP/1.1 404 Not Found');
}
