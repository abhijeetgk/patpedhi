<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RD_model
 *
 * @author abhijeetk
 */
class Rd_model extends BaseModel {
    public function add_rd_master($input){
        $this->_database = $this->load->library('DB', $GLOBALS['mysql_config']['conn_write']);
        extract($input);
        $sql="INSERT INTO rd set "
                . "customer_id=:customer_id,"
                . "start_date=:start_date,"
                . "initial_amount=:initial_amount,"
                . "description=:description,"
                . "date_added=now(),date_modified=now(),total_amount=initial_amount";
        $stmt=DB_library::$conn->prepare($sql);
        $stmt->bindParam(":customer_id", $customer_id, PDO::PARAM_INT);
        $stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
        $stmt->bindParam(":initial_amount", $initial_amount, PDO::PARAM_INT);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $result=$this->_database->execute_query($stmt);
        $this->_database->disconnect();
        return $result;        
    }
}
