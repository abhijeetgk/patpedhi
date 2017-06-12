<?php

/**
 * @author abhijeetk
 * ===================================================
 * Base controller class
 * ===================================================
 * @version 1.0
 * @package Moneycontrol
 */
abstract class BaseController {

    protected $urlValues;
    protected $action;
    protected $model;
    protected $view;

    /**
     * Default constructor
     * @param String $action
     * @param array $urlValues
     */
    public function __construct($action, $urlValues) {
        $this->action = $action;
        $this->url_segments = $urlValues;
        $this->view = new View(get_class($this), $action);
        $this->view->set_data("url_params", $this->url_segments);
    }

    /**
     * @return mixed
     */
    public function executeAction() {
        // error_reporting(E_ALL);
        return call_user_func_array(array(
            $this,
            $this->action
                ), $this->url_segments ['remaining']);
        // return $this->{$this->action}();
    }

    /**
     * @param unknown $viewmodel
     * @param unknown $fullview
     */
    protected function ReturnView($viewmodel, $fullview) {
        $viewloc = 'views/' . get_class($this) . '/' . $this->action . '.php';
        if ($fullview) {
            require ('views/maintemplate.php');
        } else {
            require ($viewloc);
        }
    }

}

/**
 * End File basecontroller.php
 * 
**/