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

    public function _set_data() {
        $header = $this->view->render_return('admin/common/header');
        $leftbar = $this->view->render_return('admin/common/leftbar');
        $topbar_profile_dropdown = $this->view->render_return('admin/common/topbar_profile_dropdown');
        $email_dropdown = $this->view->render_return('admin/common/email_dropdown');
        $footer = $this->view->render_return('admin/common/footer');
        $this->view->set_data('header', $header);
        $this->view->set_data('leftbar', $leftbar);
        $this->view->set_data('topbar_profile_dropdown', $topbar_profile_dropdown);
        $this->view->set_data('email_dropdown', $email_dropdown);
        $this->view->set_data('footer', $footer);
    }

    public function addmaster() {
        $this->_set_data();
        if(isset($_POST['customer_id']) && $_POST['customer_id']!=""){
//            $this-
        }
        $this->view->set_data('rd_form', $this->view->render_return('admin/rd/form'));
        $this->view->render("admin/rd/index");
    }

    public function addrecord() {
        $this->_set_data();
        $this->view->set_data('rd_form', $this->view->render_return('admin/rd/form_individual'));
        $this->view->render("admin/rd/index");
    }

    public function report($rd_id = '') {
        $this->_set_data();
        $this->view->set_data('rd_detailed_link', BASE_URL . "rd/report/");
        if ($rd_id) {
            // customer detailed view
            $this->view->set_data('rd_id', $rd_id);
            $this->view->set_data('rd_report', $this->view->render_return('admin/rd/rd_detail'));
        } else {
            // consolidated view
            $this->view->set_data('rd_report', $this->view->render_return('admin/rd/grid'));
        }
        $this->view->render('admin/rd/report');
    }

}
