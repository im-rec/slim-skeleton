<?php
namespace Bootstrap\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Interop\Container\ContainerInterface;
use PDO;

class PDO_wms implements ServiceProviderInterface {

    public function register(Container $pimple){
        $pimple['dbwms'] = function (ContainerInterface $app) {
            $settings = $app->get('settings')['dbberrybenka_wms'];
            $pdo = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['dbname'], $settings['user'], $settings['pass']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        };
    }
}