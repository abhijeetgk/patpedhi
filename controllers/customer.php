<?php

/**
 * Customer controller
 */
class CustomerController extends BaseController {

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
        $this->user_model = $this->load->model('user');
//        var_dump($this->user_model);
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

    public function index() {
        header('Location:' . BASE_URL . "customer/manage");
    }

    public function add() {
        $this->_set_data();
        if (isset($_POST['fname']) && $_POST['fname'] != "") {
            $this->user_model->register_customer($_POST);
        }
        $this->view->set_data('customer_form', $this->view->render_return('admin/customer/customer_form'));

        $this->view->render("admin/customer/index");
    }

    public function manage() {
        $this->_set_data();
        $this->view->set_data('identifier', 'customer');
        $this->view->set_data('table_header', 'CUSTOMER');
        $this->view->set_data('header_fields', array(TABLE_HEADER_ID, TABLE_HEADER_NAME, TABLE_HEADER_ADDRESS1, TABLE_HEADER_ADDRESS2, TABLE_HEADER_CITY, EDIT_BUTTON));
        $this->view->set_data('edit_url', '/ajax/editcustomer');
        $this->view->set_data('list_url', '/ajax/customer');
        $this->view->set_data('customer_grid', $this->view->render_return('admin/customer/grid'));
      
        
        if (isset($_SESSION['success']) && $_SESSION['success'] != "") {
            $this->view->set_data('success_message',$_SESSION['success']);
            $_SESSION['success']="";
        }
        $this->view->render("admin/customer/manage");
    }

    public function edit($customer_id = '') {
//        session_start();
        if (!$customer_id && $_POST['customer_id'] == "") {
            header('Location:' . BASE_URL . "customer/manage");
        }
        if (isset($_POST['customer_id'])) {
            $update_result = $this->user_model->update_customer_by_id($_POST);
            if ($update_result['row_count'] == 1) {
                $_SESSION['success'] = "Record updated";
                $this->registry->set('success',$_SESSION['success']);
            }
            putenv("USER=fred");
            header("Location:" . BASE_URL . "customer/manage");
        }

        $customer_data = $this->user_model->get_customer_details_by_id($customer_id);
        $this->view->set_data('customer_data', $customer_data['data'][0]);
        $this->view->set_data('customer_form', $this->view->render_return('admin/customer/customer_form'));
        $this->view->render('admin/customer/edit');
    }

}

/**
 * End File ./controllers/home.php
 */