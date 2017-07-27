<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_model
 *
 * @author abhijeetk
 */
class User_model extends BaseModel {

    //put your code here
    public function register_customer($input) {
        $fname = $input['fname'];
        $mname = $input['mname'];
        $lname = $input['lname'];
        $address1 = $input['address1'];
        $address2 = $input['address2'];
        $city = $input['city'];
        $state = $input['state'];
        $country = $input['country'];
        $pincode = $input['pincode'];
        $description = $input['description'];
        if ($fname != "") {
            $this->_database = $this->load->library('DB', $GLOBALS['mysql_config']['conn_write']);
            $register_sql = "INSERT INTO CUSTOMER_MASTER SET fname=:fname,mname=:mname,lname=:lname,"
                    . "address1=:address1,address2=:address2,city=:city,state=:state,country=:country,pincode=:pincode,"
                    . "description=:description,date_added=now(),date_modified=now(),status='y'";
            $stmt = DB_library::$conn->prepare($register_sql);
            $stmt->bindParam(":fname", $fname, PDO::PARAM_STR);
            $stmt->bindParam(":mname", $mname, PDO::PARAM_STR);
            $stmt->bindParam(":lname", $lname, PDO::PARAM_STR);
            $stmt->bindParam(":address1", $address1, PDO::PARAM_STR);
            $stmt->bindParam(":address2", $address2, PDO::PARAM_STR);
            $stmt->bindParam(":city", $city, PDO::PARAM_STR);
            $stmt->bindParam(':state', $state, PDO::PARAM_STR);
            $stmt->bindParam(":country", $country, PDO::PARAM_STR);
            $stmt->bindParam(":pincode", $pincode, PDO::PARAM_INT);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $result = $this->_database->execute_query($stmt);
            $this->_database->disconnect();
            return $result;
        }
    }

    public function get_customer_data($input) {
        $input = $input['params'];

        $start = (isset($input['start']) && $input['start'] > 0) ? $input['start'] : 0;
        $limit = (isset($input['length']) && $input['length'] > 0) ? $input['length'] : DEFAULT_CUSTOMER_LIMIT;
        $order_by = 'fname';
        $order_dir = "asc";
        // search
        $search_query = "";
        if (isset($input['search']['value']) && $input['search']['value'] != "") {
            $search_text = $input['search']['value'];
            $search_query = " AND fname like '%" . $search_text . "%'";
        }
        // order
        if (isset($input['order'][0]['column']) && $input['order'][0]['column'] != "") {
            $order = $input['order'][0]['column'];
            $order_dir=$input['order'][0]['dir'];
            switch ($order) {
                case 0:
                    $order_by = "fname";
                    break;
                case 1:
                    $order_by = "address1";
                    break;
                case 2:
                    $order_by = "address2";
                    break;
                case 3:
                    $order_by = "city";
                    break;
            }
        }
        
        $this->_database = $this->load->library('DB', $GLOBALS['mysql_config']['conn_read']);
        $sql = "SELECT id,fname,address1,address2,city FROM customer_master WHERE status='y' " . $search_query . " "
                . "order by ".$order_by." ".$order_dir." limit ".$start.",".$limit;
        $sql_count = "SELECT count(1) as count from customer_master";
//        echo $start . "=>" . $limit;
        $stmt = DB_library::$conn->prepare($sql);
//        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
//        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $data = $this->_database->get_data($stmt);
        $this->_database->disconnect();
        $this->_database = $this->load->library('DB', $GLOBALS['mysql_config']['conn_read']);
        $stmt1 = DB_library::$conn->prepare($sql_count);
        $data1 = $this->_database->get_data($stmt1);
        $return_array['recordsTotal'] = $data1['data'][0]['count'];
//        $return_array['draw'] = 1;
        $return_array['recordsFiltered'] = $data1['data'][0]['count'];
        foreach ($data['data'] as $key => $value) {
            $return_array['data'][] = array($value['id'],$value['fname'], $value['address1'], $value['address2'], $value['city']);
        }
        return $return_array;
    }

    public function validate_admin_user($data) {
        if ($data['adminusername'] != "" && $data['adminpassword'] != "") {
            $this->_database = $this->load->library('DB', $GLOBALS['mysql_config']['conn_read']);
            $sql = "SELECT * FROM user_master WHERE user_name=:user_name and status='y' limit 1";
            $stmt = DB_library::$conn->prepare($sql);
            $stmt->bindParam(":user_name", $data['adminusername']);
            $tabledata = $this->_database->get_data($stmt);
            if ($tabledata['data'][0]['user_name'] == $data['adminusername'] && $tabledata['data'][0]['user_password'] == $data['adminpassword']) {
                return array('status' => 'success', 'data' => $tabledata['data'][0]);
            } else {
                return array('status' => 'error', "msg" => "Login Failed");
            }
        }
    }

}
