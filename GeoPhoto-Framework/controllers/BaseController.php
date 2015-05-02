<?php
/**
 * Created by PhpStorm.
 * User: Pesho
 * Date: 5/1/2015
 * Time: 5:12 PM
 */

abstract class BaseController {

    protected  $controllerName;
    protected $action;
    protected $layoutName = DEFAULT_LAYOUT;
    protected $isViewRendered = false;

    function __construct($controllerName,$action){
        $this->controllerName = $controllerName;
        $this->action = $action;
        $this->onInit();
    }

    public function onInit(){

    }
    public function index(){

    }

    public function renderView($viewName = null,$includeLayout = true){
        if(!$this->isViewRendered) {
            if ($viewName == null) {
                $viewName = $this->action;
            }

            $viewFileName = 'views/' . $this->controllerName
                . '/' . $viewName . '.php';

            if($includeLayout){
                $headerFile = "views/layouts/".$this->layoutName.'/header.php';
                include_once($headerFile);
            }
            include_once($viewFileName);
            if($includeLayout){
                $footerFile = "views/layouts/".$this->layoutName.'/footer.php';
                include_once($footerFile);
            }

            $this->isViewRendered=true;
        }
    }
}