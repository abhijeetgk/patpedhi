<?php

/**
 * View class
 * @package Moneycontrol
 * @category MVCclass
 * @author abhijeetk
 * @version 1.0
 *
 */
class View {

    protected $viewFile;
    private $data = array();

    /**
     * Default constructor
     *
     * @param Obj $controllerClass        	
     * @param
     *        	Void
     */
    public function __construct($controllerClass, $action) {
        $controllerName = str_replace("Controller", "", $controllerClass);
        $this->viewFile = "views/" . $controllerName . "/" . $action . ".php";
    }

    /**
     *
     * @param Obj $viewModel        	
     * @param
     *        	void
     */
    public function output($viewModel, $template = "maintemplate") {
        $templateFile = "views/" . $template . ".php";
        if (file_exists($this->viewFile)) {
            if ($template) {
                // include the full template
                if (file_exists($templateFile)) {
                    require ($templateFile);
                } else {
                    require ("views/error/badtemplate.php");
                }
            } else {
                require ($this->viewFile);
            }
        } else {
            require ("views/error/badview.php");
        }
    }

    /**
     * Function to render html content
     *
     * @param Obj $viewfile        	
     * @param
     *        	void
     */
    public function render($viewfile) {
        if (file_exists("views/" . $viewfile . ".php")) {
            $data = $this->data;
            if (isset($this->format) && $this->format != "") {
                $format = $this->format;
            }else {
                $format="html";
            }
            if ($format == "json") {
                header('content-type: application/json');
                ob_start('ob_gzhandler');
            } else if ($format == "xml") {
                header('Content-type: application/xml');
                echo '<?xml version="1.0" encoding="UTF-8" ?>';
            }
            require "views/" . $viewfile . ".php";
        }
    }

    /**
     * Function to return rendered HTML as string
     *
     * @param Obj $viewfile        	
     * @param string $maintemplate        	
     * @return string
     */
    public function render_return($viewfile, $maintemplate = '') {
        if (file_exists("views/" . $viewfile . ".php")) {
            ob_start();
            $data = $this->data;
            require "views/" . $viewfile . ".php";
            $html = ob_get_contents();
            ob_end_clean();
            return $html;
        }
    }

    /**
     * Function to render static HTML content, useful for showing cron generated contents
     *
     * @param String $viewfile        	
     */
    public function render_html($viewfile) {
        if (file_exists($viewfile)) {
            $content = file_get_contents($viewfile);
            echo $content;
        }
    }

    /**
     * Function to set value to variable to use in template file
     *
     * @param String $key        	
     * @param String $value        	
     */
    public function set_data($key, $value) {
        $this->data [$key] = $value;
    }
    
    public function set_format($value){
        $this->format=$value;
    }
    /**
     * Function get data assigned to variables used in template
     * 
     * @return array:
     */
    private function get_data() {
        return $this->data;
    }

}

/**
 * End of file classes/view.php
 */