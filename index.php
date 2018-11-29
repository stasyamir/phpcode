<?php

require_once 'application/lib/Dev.php';

use application\core\Singleton;
use application\core\AbstractFactory\AbstractFactory;
use application\core\AbstractFactory\Config;
use application\core\SerializeObject;

spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class.'.php');
    if(file_exists($path)) {
        require $path;
    }
});

echo "<br>Serialize<br>";

$shop1 = new SerializeObject('Walmart', 'Open');
$shop2 = $shop1->resultSerialize();
print_r($shop2."<br \>");
$shop3 = unserialize($shop2);
print_r($shop3->getTitle()."<br \>");

print_r("<br \>Abstract Factory<br \>");
$person = AbstractFactory::getFactory()->getObject();
Config::$factory = 2;
$home = AbstractFactory::getFactory()->getObject();

print_r ($person->getTitle()."<br \>");
print_r ($home->getTitle()."<br \>");

print_r("<br \>Singleton<br \>");

$singleton = Singleton::getInstance();
var_dump($singleton);

try {
    $singleton2 = new Singleton();
    var_dump($singleton);
} catch (Exception $e) {
    echo $e->getMessage();
}

