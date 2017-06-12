<?php
/**
 * @author abhijeetk
 * ===================================================
 * Base model class
 * ===================================================
 * @version 1.0
 * @package Moneycontrol
 */
class BaseModel {
	protected $viewModel;
	/**
	 * Default constructor
	 */
	public function __construct() {
		$this->viewModel = new ViewModel ();
		$this->load = new Load ();
		$this->commonViewData ();
	}
	protected function commonViewData() {
	}
}

?>
