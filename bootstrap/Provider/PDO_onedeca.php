<?php
namespace Bootstrap\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Interop\Container\ContainerInterface;
use PDO;

class PDO_onedeca implements ServiceProviderInterface {

    public function register(Container $pimple){
        $pimple['dbonedeca'] = function (ContainerInterface $app) {
            $settings = $app->get('settings')['onedeca'];
            $pdo = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['dbname'], $settings['user'], $settings['pass']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        };
    }
}