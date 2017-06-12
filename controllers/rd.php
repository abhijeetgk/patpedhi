<?php
class RdController extends BaseController {

    private $_getparam;
    private $_urlValues;
    private $_registry;

    public function __construct($action, $urlValues, $obj_load, $registry) {
        parent::__construct($action, $urlValues);
        $this->_urlValues = $urlValues;
        $this->_getparam = $_GET;
        $this->load = $obj_load;
        $this->_registry = $registry;
         $this->load->language('admin');
    }

    public function _set_data(){
        $header=$this->view->render_return('admin/common/header');
        $leftbar=$this->view->render_return('admin/common/leftbar');
        $topbar_profile_dropdown=$this->view->render_return('admin/common/topbar_profile_dropdown');
        $email_dropdown=$this->view->render_return('admin/common/email_dropdown');
        $footer=$this->view->render_return('admin/common/footer');
        $this->view->set_data('header',$header);
        $this->view->set_data('leftbar',$leftbar);
        $this->view->set_data('topbar_profile_dropdown',$topbar_profile_dropdown);
        $this->view->set_data('email_dropdown',$email_dropdown);
        $this->view->set_data('footer',$footer);
    }

    public function add() {
       $this->_set_data();
        $this->view->set_data('rd_form',$this->view->render_return('admin/rd/form'));
       
        $this->view->render("admin/rd/index");
    }
}