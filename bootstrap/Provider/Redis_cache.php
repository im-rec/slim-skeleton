<?php
namespace Bootstrap\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Interop\Container\ContainerInterface;
use Redis;

class Redis_cache implements ServiceProviderInterface {

    public function register(Container $pimple){
        $pimple['redis'] = function (ContainerInterface $app) {
            $settings = $app->get('settings')['redis'];
		    $redis = new Redis();
		    $redis->connect($settings['host'], $settings['port']);
		    $redis->auth($settings['password']);
		    return $redis;
        };
    }
}