<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\LeadController;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

switch ($uri) {
    case '/':
    case '/index':
        readfile(__DIR__ . '/index.html');
        break;

    case '/submit_lead':
        if ($method === 'POST') {
            $controller = new LeadController();
            $controller->handleFormSubmit($_POST);
        } else {
            http_response_code(405);
            echo 'Method Not Allowed';
        }
        break;

    case '/leads':
        $controller = new LeadController();
        $controller->showLeads();
        break;

    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}