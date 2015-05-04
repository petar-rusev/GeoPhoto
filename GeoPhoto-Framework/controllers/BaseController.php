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
    protected $isPost = false;
    function __construct($controllerName,$action){
        $this->controllerName = $controllerName;
        $this->action = $action;
        $this->onInit();
    }

    public function onInit(){

    }

    public function index(){

    }

    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
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

    public function redirectToUrl($url){
        header("Location: ".$url);
        die;
    }
    public function redirect($controllerName,$actionName=null,$params = null){
        $url = "/".urldecode($controllerName);
        if($actionName!=null){
            $url .= '/'.urlencode($actionName);
        }
        if($params != null){
            $encodedparams = array_map($params,'urlencode');
            $url .= implode('/',$encodedparams);
        }
        $this->redirectToUrl($url);
    }
}