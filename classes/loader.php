<?php

/**
 * Loader class
 * @package Moneycontrol
 * @category MVC
 * @author abhijeetk
 * @version 1.0
 *
 */
class Loader {

    private $controllerName;
    private $controllerClass;
    private $action;
    private $urlValues;

    /**
     * Function to sanitize user input
     * @param String $str        	
     * @return String
     */
    private function _sanitize_input($str) {
        global $mysql_restricted_keywords;
        if (!$str)
            return;
//        $pattern = '/\b(' . implode("|", $mysql_restricted_keywords) . ')\b/i';
//        $str = preg_replace($pattern, '', $str); // remove mysql characters
//        $str = preg_replace('~[\\\#$%+�"\'&><=*]~', '', $str); // remove special characters
//        $str = preg_replace("/-{2,}/", "-", $str); // transforms multiple --- in - use to comment in sql scripts
        return $str;
    }

    /**
     * Function to process get and post params
     */
    private function _process_input() {
        if (isset($_GET) && $_GET != "") {
            foreach ($_GET as $key => $value) {
                $_GET [$key] = $this->_sanitize_input($value);
            }
        }
        if (isset($_POST) && $_POST != "") {
            foreach ($_POST as $key => $value) {
                $_POST [$key] = $this->_sanitize_input($value);
            }
        }
    }

    /**
     * Default constructor 
     */
    public function __construct() {
        $this->_process_input();
        $urlvalues = $_GET;

        if (isset($urlvalues ['q']) && $urlvalues ['q'] != '') {
            $url_array = explode("/", $urlvalues ['q']);
            if (isset($url_array [0])) {
                $this->urlValues ['controller'] = $url_array [0];
            }
            if (isset($url_array [1])) {
                $this->urlValues ['action'] = $url_array [1];
            }
            if (sizeof($url_array) > 2) {
                $this->urlValues ['remaining'] = array_slice($url_array, 2);
            } else {
                $this->urlValues ['remaining'] = array("");
            }
        } else {
            $this->urlValues ['remaining'] = array("");
        }
        // $this->urlValues = $_GET;

        if (!isset($this->urlValues ['controller']) || $this->urlValues ['controller'] == '') {
            $this->controllerName = "home";
            $this->urlValues ['controller'] = "home";
            $this->controllerClass = "HomeController";
            $this->urlValues ['action'] = "index";
            $this->action = "index";
        } else {
             $this->controllerName = strtolower($this->urlValues ['controller']);
             $this->controllerClass = ucfirst(strtolower($this->urlValues ['controller'])) . "Controller";
        }

        if (!isset($this->urlValues ['action']) || $this->urlValues ['action'] == "") {
            $this->action = "index";
        } else {
            $this->action = $this->urlValues ['action'];
        }
    }

    /**
     * factory method which establishes the requested controller as an object
     */
    public function createController() {
        // check our requested controller's class file exists and require it if so
        if (file_exists("controllers/" . $this->controllerName . ".php")) {
            require ("controllers/" . $this->controllerName . ".php");
        } else {
            require ("controllers/error.php");
            return new ErrorController("badurl", $this->urlValues);
        }

        // does the class exist?
        if (class_exists($this->controllerClass)) {
            $parents = class_parents($this->controllerClass);

            // does the class inherit from the BaseController class?
            if (in_array("BaseController", $parents)) {
                // does the requested class contain the requested action as a method?
                if (method_exists($this->controllerClass, $this->action)) {
                    $this->obj_load = new Load();
                    $lang = filter_input(INPUT_GET, 'lang', FILTER_SANITIZE_STRING);
                    
                    if (!$lang)
                        $lang = filter_input(INPUT_POST, 'lang', FILTER_SANITIZE_STRING);
                    if($lang!=""){
                        setcookie("lang",$lang,time()+3600,'/');
                    }
                    if(isset($_COOKIE['lang'])&& $_COOKIE['lang']!='' && $lang=="")$lang=$_COOKIE['lang'];
                    if (!$lang)
                        $lang = DEFAULT_LANG;
                    $this->registry = $GLOBALS['registry_obj'];
                    $this->registry->set('lang', $lang);
                    return new $this->controllerClass($this->action, $this->urlValues, $this->obj_load, $this->registry);
                } else {
                    // bad action/method error
                    require ("controllers/error.php");
                    return new ErrorController("badurl", $this->urlValues);
                }
            } else {
                // bad controller error
                require ("controllers/error.php");
                return new ErrorController("badurl", $this->urlValues);
            }
        } else {
            // bad controller error
            require ("controllers/error.php");
            return new ErrorController("badurl", $this->urlValues);
        }
    }

}

/**
 * End file loader.php
 *  
**/