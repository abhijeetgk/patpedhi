<?php
/**
 * Loader class to load model, library or config files
 * @package Moneycontrol
 * @category MVCclass
 * @author abhijeetk
 * @version 1.0
 *
 */
class Load {
	/**
	 * Function to load models
	 * @param String $name
	 * @return Obj
	 */
	function model($name) {
		$model = "models/" . $name . ".php";
		if (file_exists ( $model )) {
			require_once ($model);
			$obj = $name . "_model";
			return new $obj ();
		}
	}
	/**
	 * @param String $name
	 * @param array $params
	 * @return Obj
	 */
	function library($name, $params = array()) {
		$library = "libraries/" . $name . ".php";
		if (file_exists ( $library )) {
			require_once ($library);
			$obj = $name . "_library";
			
			return new $obj ( $params );
		}
	}
	/**
	 * @param String $name
	 * 
	 */
	function config($name) {
		$config = "config/" . $name . ".php";
		if (file_exists ( $config )) {
			require_once ($config);
		}
	}
        
        function language($name){
            global $registry_obj;
            $lang=$registry_obj->get('lang');
            if(!$lang){
                $lang=DEFAULT_LANG;
            }
            $langauge_file='language/'.$lang.'/'.$name.'.php';
            if(file_exists($langauge_file)){
                require_once($langauge_file);
            }
            
        }
}
