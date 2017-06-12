<?php
/**
 * View Model Class
 * @package Moneycontrol
 * @category MVCclass
 * @author abhijeetk
 * @version 1.0
 *
 */
class ViewModel {
	/**
	 * @param String $name
	 * @param String $val
	 */
	public function set($name, $val) {
		$this->$name = $val;
	}
	/**
	 * @param String $name
	 * @return String
	 */
	public function get($name) {
		if (isset ( $this->{$name} )) {
			return $this->{$name};
		} else {
			return null;
		}
	}
}

?>