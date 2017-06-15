<?php

/**
 * Description of home
 *
 * @author abhijeetk
 */
class HomeController extends BaseController {

    //put your code here
    public function __construct($action, $urlValues, $obj_load, $registry) {
        parent::__construct($action, $urlValues);
        $this->_urlValues = $urlValues;
        $this->_getparam = $_GET;
        $this->load = $obj_load;
        $this->_registry = $registry;
        $this->load->language('admin');
    }
    public function index(){
        $this->view->render('login');
    }

}
