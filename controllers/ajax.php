<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ajax
 *
 * @author abhijeetk
 */
class ajaxController extends BaseController {

    public function __construct($action, $urlValues, $obj_load, $registry) {
        parent::__construct($action, $urlValues);
        $this->_urlValues = $urlValues;
        $this->_getparam = $_GET;
        $this->load = $obj_load;
        $this->_registry = $registry;
        $this->load->language('admin');
        $this->user_model = $this->load->model('user');
        $this->view->set_format("json");
//        var_dump($this->user_model);
    }
    
    public function customer(){
        $params=$_GET;
        $customer_data=$this->user_model->get_customer_data(array("params"=>$params));
        //$return_data['data']=$customer_data['data'];
        echo json_encode($customer_data);
        
        
        }

}
