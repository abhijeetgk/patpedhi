<?php

/**
 * Logger library to write logs
 * Usage
 * $logger = $this->_registry->get('logger_library');
 * $logger->log('Error', "Error message");
 * $logger->log('Warning', "warning message");
 */
class logger_library {

    private $_file_path;

    public function __construct() {
        $this->_file_path = $GLOBALS['log_file_path'];
    }

    public function log($level, $msg) {
        $filepath = $this->_file_path . 'log-' . date('Y-m-d') . '.php';
        if (!$fp = @fopen($filepath, 'ab')) {
            return FALSE;
        }
        flock($fp, LOCK_EX);
        $date = date("Y-m-d H:i:s");
        $message .= $this->_format_line($level, $date, $msg);
        for ($written = 0, $length = strlen($message); $written < $length; $written += $result) {
            if (($result = fwrite($fp, substr($message, $written))) === FALSE) {
                break;
            }
        }

        flock($fp, LOCK_UN);
        fclose($fp);
        return is_int($result);
    }

    protected function _format_line($level, $date, $message) {
        return $level . ' - ' . $date . ' --> ' . $message . "\n";
    }

}

/**
 * End of file ./libraries/logger.php
 */