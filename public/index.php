<?php
// Inclut le fichier autoload.php pour charger les classes automatiquement.
require __DIR__ . '/../vendor/autoload.php';

// Démarre la session.
session_start();

// Définit les routes disponibles. Chaque route a un nom de page, une action, et un contrôleur associé.
const AVAIABLE_ROUTES = [
    'home' => [
        'action' => 'render',            // L'action à exécuter dans le contrôleur.
        'controller' => 'HomeController', // Le nom du contrôleur à utiliser.
    ],
    'login' => [
        'action' => 'renderUser',
        'controller' => 'UserController',
    ],
    'logout'=>[
        'action' => 'renderUser',
        'controller' => 'UserController'
    ],
    'register'=>[
        'action' => 'renderUser',
        'controller' => 'UserController'
    ],
    'mission'=>[
        'action' => 'render',
        'controller' => 'MissionController'
    ],
    'classification'=>[
        'action' => 'render',
        'controller' => 'ClassificationController'
    ],
];

// Initialise les variables $page, $action et $controller.
$page = 'home';  // La page par défaut est 'home'.
$action;         // La variable pour l'action.
$controller;     // La variable pour le contrôleur.

// Vérifie si le paramètre 'page' est présent dans la requête GET et n'est pas vide.
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $page = $_GET['page']; // Si oui, met à jour la variable $page avec la valeur de 'page' dans la requête.
} else {
    $page = 'home'; // Si non, la page reste 'home'.
}

// Vérifie si la page demandée existe dans les routes disponibles.
if (array_key_exists($page, AVAIABLE_ROUTES)) {
    $controller = AVAIABLE_ROUTES[$page]['controller']; // Récupère le nom du contrôleur pour cette page.
    $action = AVAIABLE_ROUTES[$page]['action'];         // Récupère l'action à exécuter pour cette page.
} else {
    // Si la page demandée n'existe pas, défini la page sur '404' et le contrôleur sur 'ErrorController'.
    $page = '404';
    $controller = 'ErrorController';
    $action = 'render'; // Définit également l'action à exécuter comme 'render'.
}

// Définit l'espace de noms du contrôleur.
$namespace = 'App\Controllers';
$namespaceController = $namespace . '\\' . $controller;

// Crée une instance du contrôleur approprié.
$pageController = new $namespaceController();

// Définit la vue à utiliser dans le contrôleur.
$pageController->setView($page);

// Exécute l'action appropriée dans le contrôleur.
$pageController->$action();

?>
