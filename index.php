<?php

session_start(); error_reporting(E_ALL);

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\DatabaseManager;

// TWIG template engine
use Twig\Environment;

use Shared\dbaser;
use Medians\Application as apps;
use Medians\Infrastructure\Users\UserRepository;
use Medians\Infrastructure\Customers\CustomerRepository;
use Medians\Infrastructure\Providers\ProviderRepository;


require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/lib/Facebook/autoload.php';

spl_autoload_register(function ($name) {

    // $name = $name;
//  is_file(getcwd().'/app/'.$name.'.php') ? include (getcwd().'/app/'.$name.'.php') : '';
        $name2 = str_replace('\\', '/', __DIR__.'/app/'.$name.'.php');
    is_file($name2) ? include ($name2) : '';

});


$request = Request::createFromGlobals();

$app = new Silex\Application();

$app->currency = 'EGP';
    


CONST db_name = 'medians_ddd';
CONST db_username = 'root';
CONST db_password = 'root';

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => db_name,
    'username' => db_username,
    'password' => db_password,
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();

$app->CONF = (new apps\Configuration())->create('localhost', db_username, db_password, db_name)->getCONFArray();

$mysqli = new mysqli($app->CONF['host'], $app->CONF['user'], $app->CONF['pass'], $app->CONF['name']);

if (!empty($mysqli->connect_errno) ) 
{
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
    exit();
}

$mysqli->set_charset("utf8");
$app->debug = true;

$twig = new \Twig\Environment(new \Twig\Loader\FilesystemLoader('./app'), 
    [
        //'cache' => '/app/cache',
        'debug' => true,
    ]
);


$twig->addFilter(new \Twig\TwigFilter('html_entity_decode', 'html_entity_decode'));

$app->auth = (new apps\Auth\AuthService( new UserRepository() ))->checkSession();

$app->providerSession = (isset($app->auth->providers) && json_decode($app->auth->providers)[0]) ? json_decode($app->auth->providers)[0] : null;

// Set Settings options
$app->Settings = (new apps\Settings\SettingsController)->getAll();


include('app/config/routing.php');
include('app/helper/methods.php');
include('app/controller.php');



