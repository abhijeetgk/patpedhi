<?php
/**
 * Custom library to connect mysql db and perform common operations
 * 
 * @package Moneycontrol
 * @category UserManagement
 * @author Abhijeetk
 * @version 1.0
 */
class DB_library {
	public static $conn;
	private $resultSet;
	public $affected_rows;
	private $queryData;
	private $_db_host;
	private $_db_name;
	private $_db_user;
	private $_db_pass;
	/**
	 * Default constructor
	 */
	public function __construct($connection_arr) {
		$this->_connect($connection_arr);
	}
	
	/**
	 * Connection function
	 */
	private function _connect($connection_arr) {
		$this->_db_host = (isset ( $connection_arr ['db_host'] ) && $connection_arr ['db_host'] != "") ? $connection_arr ['db_host'] : "";
		$this->_db_name = (isset ( $connection_arr ['db_name'] ) && $connection_arr ['db_name'] != "") ? $connection_arr ['db_name'] : "";
		$this->_db_user = (isset ( $connection_arr ['db_user'] ) && $connection_arr ['db_user'] != "") ? $connection_arr ['db_user'] : "";
		$this->_db_pass = (isset ( $connection_arr ['db_pass'] ) && $connection_arr ['db_pass'] != "") ? $connection_arr ['db_pass'] : "";
		// var_dump ( self::$conn );
		try {
			self::$conn = new PDO ( "mysql:host=" . $this->_db_host . ";dbname=" . $this->_db_name, $this->_db_user, $this->_db_pass );
			self::$conn->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		} catch ( PDOException $e ) {
			echo "ERROR :" . $e->getMessage ();
			
		}
		$status = self::$conn->getAttribute ( PDO::ATTR_CONNECTION_STATUS );
// 		echo $status;
	}
	/**
	 * Disconnect function
	 */
	public function disconnect() {
		self::$conn = null;
	}
	/**
	 * Function to execute prepared statement and get data
	 */
	public function get_data($stmt) {
		try {
			$this->resultSet = $stmt->execute ();
		} catch ( PDOException $e ) {
			echo "Error:" . $e->getMessage ();
			echo "<br>\n" . $e->getTrace ();
			echo "<br>\n" . $e->getTraceAsString ();
		}
		
		$count = $stmt->rowCount ();
		
		if ($count > 0) {
			$row = $stmt->fetchAll ( PDO::FETCH_ASSOC );
			foreach ( $row as $rows ) {
				$this->queryData ['data'] [] = $rows;
			}
			$this->queryData ['count'] = $count;
			$stmt->closeCursor ();
			$stmt = null; // this is to close the connection
			return $this->queryData;
		}
	}
	/**
	 * Function to execute query
	 */
	public function execute_query($stmt) {
		try {
			$resultSet = $stmt->execute ();
			$return_array ['last_insert_id'] = self::$conn->lastInsertId ();
			$return_array ['row_count'] = $stmt->rowCount ();
		} catch ( PDOException $e ) {
			echo "Error:" . $e->getMessage ();
			echo "<br>\n" . $e->getTrace ();
			echo "<br>\n" . $e->getTraceAsString ();
			exit ();
		}
		$stmt = null; // this to clear the statement
		return $return_array;
	}
}

/**
 * End of file ./libraries/Db.php
 */