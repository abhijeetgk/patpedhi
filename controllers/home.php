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
        $this->user_model=$this->load->model('user');
    }
    public function index(){
        if(is_array($_POST) && sizeof($_POST)!=""){
            $return_array=$this->user_model->validate_admin_user($_POST);
            
            if($return_array['status']=="success"){
                $_SESSION['adminlogin']=true;
                $_SESSION['adminname']=$return_array['data']['user_name'];
                header('Location:'.BASE_URL."adminhome");
            }
            if($return_array['status']=='error'){
                $msg=$return_array['msg'];
                $this->view->set_data('msg',$msg);
            }
        }
        $this->view->render('login');
    }

}
