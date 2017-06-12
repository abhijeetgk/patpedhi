<?php

/**
 * Encryption operation methods is available here
 * @version    Release: 1.0
 */
 date_default_timezone_set('Asia/Kolkata');
class Encryption_library {

    private $skey = "-_-U$3rM@n@93N^-";
    private $_separator = "@@##@@";

    public function generate_token($input_arr) {
        $user_email = (isset($input_arr['user_email']) && $input_arr['user_email'] != "") ? $input_arr['user_email'] : "";
        $type = (isset($input_arr['type']) && $input_arr['type'] != "") ? $input_arr['type'] : "normal";
        $key = $user_email . $this->_separator . $type . $this->_separator . $this->generate_random_string(8);
        // $key = $user_email . $this->_separator . $type . $this->_separator . uniqid('',true);         
        if($type=='secure'){
            $token = array();
            $token['encoded'] = sha1($this->enc($key,$type));   
            $token['normal'] = $this->enc($key,$type);  
        }else{
            $token = array();
            $token['encoded'] = $this->enc($key,$type);   
            $token['normal'] = $this->enc($key,$type);  
        }  
        return $token;       
    }

    public function generate_salt(){
        $salt = md5(uniqid(rand(), true));
        return $this->enc($salt);
    }

    public function get_expiry_difference($exp1, $exp2) {
        $datetime1 = new DateTime($exp1);
        $datetime2 = new DateTime($exp2);
        $date_diff = $datetime1->diff($datetime2);    
        $minutes = $date_diff->days * 24 * 60;
        $minutes += $date_diff->h * 60;
        $minutes += $date_diff->i;
//        echo $exp1 . "=>" . $exp2 . "<br>";
        return $minutes;
    }

    public function validate_token($input_arr) {  
        $user_email = (isset($input_arr['user_email']) && $input_arr['user_email'] != "") ? $input_arr['user_email'] : "";
        $token = (isset($input_arr['token']) && $input_arr['token'] != "") ? $input_arr['token'] : "";
        $type = (isset($input_arr['type']) && $input_arr['type'] != "") ? $input_arr['type'] : "";
        $medium = (isset($input_arr['medium']) && $input_arr['medium'] != "") ? $input_arr['medium'] : ""; 
        if($input_arr['token_details']['status']=='success'){ 
            $token_array = $input_arr['token_details']['data'][0];                           
            $return_array = array();            
            // $return_array['token_details'] = $token_array;
            if ($token_array['email'] == $user_email) {                 
                $expiry = date("YmdHis",strtotime($token_array['entdate']));
                // echo "---ndate--".date("YmdHis");
                $difference = $this->get_expiry_difference(date("YmdHis"), $expiry);
                if ($type == "secure" && $difference > SHORT_TOKEN_SCOPE) {
                     
                    $return_array['status'] = "failed";
                    $return_array['message'] = INVALID_TOKEN_MESSAGE;
                    return $return_array;
                } else if ($type == "normal" && $difference > LONG_TOKEN_SCOPE) { 
                    $return_array['status'] = "failed";
                    $return_array['message'] = INVALID_TOKEN_MESSAGE;
                    return $return_array;
                } else { 
                    $return_array['status'] = "success";
                    $return_array['message'] = TOKEN_SUCCESS_MESSAGE;
                    return $return_array;
                }
            } else { 
                $return_array['status'] = "failed";
                $return_array['message'] = TOKEN_INVALID_USER;
                return $return_array;
            }

        }else if($input_arr['token_details']['status']=='failed'){           
            $return_array['status'] = "failed";
            $return_array['message'] = INVALID_TOKEN_MESSAGE;
            return $return_array;
        }
    }

    /**
     * Method to generate random string
     * @param type $len
     * @return string
     */
    private function generate_random_string($len = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $len; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Method to encrypt string
     * @param type $value
     * @return boolean
     */
    public function enc($value) {
        if (!$value) {
            return false;
        }
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
        $encoded_key = trim($this->safe_b64encode($crypttext));
        return $encoded_key;

        /*return base64_encode(strrev($value));*/

    }

    /**
     * Method to decrypt string
     * @param type $value
     * @return boolean
     */
    public function dec($value) {
        if (!$value) {
            return false;
        }
        $crypttext = $this->safe_b64decode($value);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        $decoded = trim($decrypttext);
        return $decoded;
        
        // return strrev(base64_decode($value));
    }

    /**
     * Method to encode string
     * @param type $string
     * @return type
     */
    public function safe_b64encode($string) {
        $data = base64_encode($string);
        $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
        return $data;
    }

    public function safe_b64decode($string) {
        $data = str_replace(array('-', '_'), array('+', '/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    public function generate_password(){
        $pwd =  md5(uniqid(rand(), true));
        return $pwd;
        
    }

}

/**
 * End of file ./libraries/encryption.php
 */
