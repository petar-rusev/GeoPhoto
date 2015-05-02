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

    function __construct($controllerName,$action){
        $this->controllerName = $controllerName;
        $this->action = $action;
    }
    public function index(){

    }

    public function renderView($viewName = null){
        if($viewName == null){
            $viewName = $this->action;
        }

        $viewFileName = 'views/'.$this->controllerName
            .'/'.$viewName.'.php';

        include_once($viewFileName);
    }
}