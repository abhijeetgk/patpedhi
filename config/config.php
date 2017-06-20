<?php

$autoload['config'] = array();
/**
 * =================================================
 * Global config file
 * ================================================= 
 */
$mysql_config = array(
    "conn_read" => array(
        "db_host" => "localhost",
        "db_name" => "patpedhi",
        "db_user" => "root",
        "db_pass" => "root.123"
    ),
    "conn_write" => array(
        "db_host" => "localhost",
        "db_name" => "patpedhi",
        "db_user" => "root",
        "db_pass" => "root.123"
    )
);


$mysql_restricted_keywords = array(
    'execute', 'select', 'insert', 'update', 'delete', 'create', 'alter', 'drop', 'rename', 'truncate', 'backup', 'restore',
    'replace', 'from', 'join', 'show', 'table', 'information_schema', 'union', 'union all', 'sleep', 'distinct', 'table_schema', 'waitfor',
    'delay', 'pg_sleep'
);


$log_file_path=$_SERVER['DOCUMENT_ROOT']."/logs/";

