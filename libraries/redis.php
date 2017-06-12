<?php

/**
 * Redis library to connect to redis clusture
 * @link https://github.com/nrk/predis Source code
 * WIKI => https://github.com/nrk/predis/wiki
 * how to use
 * $redis_library = $this->_registry->get('redis_library');
 * $redis_library->set('amit1', 'ghadi1');
 * echo "=>".$redis_library->get('amit1');
 * $redis_library->disconnect();
 * @todo create another data storing methods
 */
class redis_library {

    private $_redis_client;

    /**
     * Constructor to create object and connect to redis clusture.
     */
    public function __construct() {
        require $_SERVER['DOCUMENT_ROOT'] . "/vendor/predis/autoload.php";
        Predis\Autoloader::register();
        $options = array('cluster' => 'redis');
        $this->_redis_client = new Predis\Client($GLOBALS['redis_clusture_ips'], $options);
    }
/**
 * 
 * @param type $key
 * @param type $value
 * @param type $duration
 * @return type
 */
    public function set($key, $value, $duration = 0) {
        if (!$key) {
            return;
        }
        if (!$value) {
            return;
        }
        if ($duration > 0) {
            $this->_redis_client->setex($key, $duration, json_encode($value));
        } else {
            $this->_redis_client->set($key, json_encode($value));
        }
    }

    public function get($key) {
        if (!$key) {
            return;
        }
        $retval = $this->_redis_client->get($key);
        return json_decode($retval);
        
    }

    public function disconnect() {
        $this->_redis_client->quit();
    }

}
//