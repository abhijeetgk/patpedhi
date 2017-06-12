<?php
/**
 * A simple registry class to hold objects and use it when needed.
 * @version 1.0
 * @package Moneycontrol
 * @author abhijeetk
 */
class Registry {
    protected $_objects = array();

    function set($name, &$object) {
        $this->_objects[$name] =& $object;
    }

    function get($name) {
        return $this->_objects[$name];
    }
}

/**
 * End of file ./classes/registry.php
 */