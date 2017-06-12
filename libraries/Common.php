<?php

/**
 * Common functions library
 * 
 * @package Moneycontrol
 * @category UserManagement
 * @author Abhijeetk
 * @version 1.0
 */
class Common_library {

    /**
     * Function to clean input strint
     * @param String $str
     * @return String:
     */
    function clean_str($str) {
        return is_array($str) ? array_map('_clean', $str) : str_replace("\\", "\\\\", htmlspecialchars((get_magic_quotes_gpc() ? stripslashes($str) : $str), ENT_QUOTES));
    }

    /**
     * @param String $str
     * @param string $type
     * @return string
     */
    function check_input($str, $type = 'alphanumeric') {
        // if(function_exists('mysql_real_escape_string')){$str=mysql_real_escape_string($str);} not working on production server
        // elseif(function_exists('mysql_escape_string')){$str=mysql_escape_string($str);}
        // ### Remove some special chars ##########
        $specialCharacters = array("#" => "", "$" => "", "%" => "", "@" => "", "." => "",
            "�" => "", "+" => "", "=" => "", "�" => "", "\\" => "", "/" => ""
        );
        while (list ( $character, $replacement ) = each($specialCharacters)) {
            $str = str_replace($character, '-' . $replacement . '-', $str);
        }

        // #### Remove % sign from begning & last ######
        if (isset($str [0]) && $str [0] == '%') {
            $str = substr($str, 1, strlen($str));
        }
        if (isset($str [strlen($str) - 1]) && $str [strlen($str) - 1] == '%') {
            $str = substr($str, 0, strlen($str) - 1);
        }

        // #### Remove all remaining other unknown characters ##########
        if ($type == 'numeric') {
            $str = preg_replace('/[^0-9\-]/', '', $str); // numeric only
        } else if ($type == 'mf') {
            $str = preg_replace('/[^a-zA-Z0-9&~\-]/', ' ', $str); // alpha numeric only
        } else {
            $str = preg_replace('/[^a-zA-Z0-9&\-,_]/', ' ', $str); // alpha numeric only
        }
        $str = preg_replace('/^[\-]+/', '', $str);
        $str = preg_replace('/[\-]+$/', '', $str);
        $str = preg_replace('/[\-]{2,}/', '', $str);
        return $str = strip_tags(trim($str));
    }

    /**
     * Function to get all headers
     * @return ArrayObject <string, unknown>
     */
    function getallheaders() {
        $headers = '';
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers [str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }

    function generate_random_userid($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Function to get IP address of user
     * @return String
     */
    function get_ip() {
// 		if (! function_exists ( 'getallheaders' )) {
        $headers = $this->getallheaders();
// 		}

        if (is_array($headers)) {
            foreach ($headers as $key => $value) {
                if (strtolower($key) == "true-client-ip") {
                    $ip_id = $headers [$key];
                } elseif (strtolower($key) == "ns-remote-addr") {
                    $ip_id = $headers [$key];
                } else {
                    $ip_id = $headers [$key];
                }
            }
        }
        return $ip_id;
    }

    function write_csv($input_arr) {
        error_reporting(E_ALL);
        ini_set('memory_limit', '216M');
        $filename = $input_arr['filename'];
        $data = $input_arr['data']['data'];
        // echo "<br>====".$filename;
        //echo "<pre>";
        //print_r($data);
        // echo "</pre>";
        if ($data != "" && $filename != "") {

            foreach ($data as $key => $line) {
                error_reporting(E_ALL);
                  /* echo "<pre>";
                       print_r($line);
                   echo "</pre>";*/
                // echo $filename;
                try {
                    $file = fopen($filename, "a+"); 
                    chmod($filename,0777 );                   
                    fputcsv($file, $line);
                    fclose($file);
                    
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        }
    }

    /*START: print data function*/    
    function pr($array) {
          echo '<pre>'; 
            print_r($array); 
          echo '</pre>';
    }    
    /*END: print data function*/

}

/**
 * End File Common.php
 */