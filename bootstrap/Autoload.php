<?php

namespace Bootstrap;

class Autoload {

    public function __construct($app){
        $this->_setup($app);
    }

    private function _setup($app){
        $location = $this->_init();

        ob_start();
        foreach ($location as $module) {
            include_once $module->Path."routes.php";
        }
        return ob_get_clean();
    }

    private function _init() {
        $modules = $this->_scan(APP_PATH);
        
        foreach ($modules as $module=>$contents) {
            $modules[$module] = (object) array("Name"=>"","Path"=>"");
            $modules[$module]->Name = $module;
            $modules[$module]->Path = $contents.DIRECTORY_SEPARATOR;
        }
        return $modules;
    }

    private function _scan($dir) {
        $ignore = array('.','..');
        $contents = array();
        foreach (scandir($dir) as $node) {
            if(in_array($node,$ignore)) continue;
            if($node){
                if (is_dir($dir . DIRECTORY_SEPARATOR . $node)) {
                    $contents[$node] = $dir . DIRECTORY_SEPARATOR . $node;
                }
            }
        }
        return $contents;
    }

}
