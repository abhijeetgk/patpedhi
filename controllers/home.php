<?php
class HomeController extends BaseController {

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

    public function index() {
        $header=$this->view->render_return('admin/common/header');
        $leftbar=$this->view->render_return('admin/common/leftbar');
        $topbar_profile_dropdown=$this->view->render_return('admin/common/topbar_profile_dropdown');
        $email_dropdown=$this->view->render_return('admin/common/email_dropdown');
        $admin_home_widgets=$this->view->render_return('admin/widgets/top_row_widgets');
        $footer=$this->view->render_return('admin/common/footer');
        $this->view->set_data('header',$header);
        $this->view->set_data('leftbar',$leftbar);
        $this->view->set_data('topbar_profile_dropdown',$topbar_profile_dropdown);
        $this->view->set_data('email_dropdown',$email_dropdown);
        $this->view->set_data('admin_home_widgets',$admin_home_widgets);
        $this->view->set_data('footer',$footer);
        $this->view->render("admin/index");
    }
    
    public function dbconnect() {
        $this->database = $this->load->library('DB', $GLOBALS ['mysql_config'] ['user_read']);
        var_dump($this->database);
        $this->database1 = $this->load->library('DB', $GLOBALS ['mysql_config'] ['user_read']);
        var_dump($this->database1);
    }

}

/**
 * End File ./controllers/home.php
 */