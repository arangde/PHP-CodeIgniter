<?php defined('BASEPATH') or exit('No direct script access allowed');




class AppLogger {

    private $level;
    private $filename;
    public $CI;

    function __construct() {
        $this->CI = & get_instance();

        $level = $this->CI->config->item('LogLevel');

        $path = $this->CI->config->item('AppLogPath').'/log-'.date("Ymd") . ".log";

        if ($level !='')  {
            $this->level = $level;
        }
        else {
            $this->level = 'info';
        }
        if($path=='') {
            $this->filename =  APPPATH.'logs/development.log';
        }
        else {
            $this->filename = $path;
        }
    }

    public function debug($message) {
        if($this->level == 'debug') {
            $this->write_log($message, $this->level);
        }
    }

    public function info($message) {
        if($this->level == 'info' || $this->level == 'debug' ) {
            $this->write_log($message, $this->level);
        }
    }

    public function warn($message) {
        if($this->level == 'warn' ||$this->level == 'info' || $this->level == 'debug' ) {
            $this->write_log($message, $this->level);
        }
    }

    public function error($message) {
        if($this->level == 'error' || $this->level == 'warn' || $this->level == 'info' || $this->level == 'debug' ) {
            $this->write_log($message, $this->level);
        }
    }

    public function request() {
        $headers = getallheaders();
        $this->write_log("REQUEST:", $this->level);
        $this->write_log($headers, $this->level);
        $get_params = $_GET;

        if($get_params) {
            $this->write_log("GET parameters:", $this->level);
            $this->write_log($get_params, $this->level);
        }
        $post_params = $_POST;
        if($post_params) {
            $this->write_log("POST parameters:", $this->level);
            $this->write_log($post_params, $this->level);
        }
    }

    public function session() {
        $session_params = $_SESSION;
        if($session_params) {
            $this->write_log("SESSION parameters:",$this->level);
            $this->write_log($session_params,'');
        }
    }

    private function write_log($message, $level) {
        //$message can either be a string or an array
        $fd = fopen($this->filename, 'a');
        if(is_array($message)) {

            $this->write_array($message, $fd);
        }
        else {
            $msg = date(DATE_RFC822).' '.$level.' ---> '.$message;
            $this->write_string($msg, $fd);
        }
        fclose($fd);
    }

    private function write_string($message, $fd)  {
        fwrite($fd, $message."\n");
    }

    private function write_array($message, $fd) {
        foreach($message as $key => $value) {
            if(is_array($value)) {
                fwrite($fd, $key."{ ");
                $this->write_array($value, $fd);
                fwrite($fd, " }\n");
            }
            else {
                $string =  "\t {".date(DATE_RFC822).' '.$this->level.' ---> '.$key.': '.$value."}\n ";
                fwrite($fd, $string);
            }
        }
    }
}

?>
