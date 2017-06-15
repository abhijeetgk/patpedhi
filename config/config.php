<?php

$autoload['config'] = array();
/**
 * =================================================
 * Global config file
 * ================================================= 
 */
$mysql_config = array(
    "user_read" => array(
        "db_host" => "172.18.32.112",
        "db_name" => "moneycontrol",
        "db_user" => "portdev_read",
        "db_pass" => "sdf#2d#4@"
    ),
    "user_write" => array(
        "db_host" => "172.18.32.112",
        "db_name" => "moneycontrol",
        "db_user" => "portdev_write",
        "db_pass" => "sdf#2d#4@"
    )
);


$mysql_restricted_keywords = array(
    'execute', 'select', 'insert', 'update', 'delete', 'create', 'alter', 'drop', 'rename', 'truncate', 'backup', 'restore',
    'replace', 'from', 'join', 'show', 'table', 'information_schema', 'union', 'union all', 'sleep', 'distinct', 'table_schema', 'waitfor',
    'delay', 'pg_sleep'
);


$log_file_path=$_SERVER['DOCUMENT_ROOT']."/logs/";

