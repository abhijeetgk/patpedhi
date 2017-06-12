<?php
/**
 * Error controller to handle Bad controller requests
 * @author abhijeetk
 *
 */
class ErrorController extends BaseController {
	public function __construct($action, $urlValues) {
		parent::__construct ( $action, $urlValues );
	}
	/**
	 * Method to display 404 page 
	 */
	public function badurl() {
		$this->view->render ( "Error/404" );
	}
}