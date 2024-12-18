<?php

class Logger {
    static function addLog($description, $data){
        $file = fopen(dirname(dirname(__DIR__))."/debug.log", "a");
        if(is_array($data) || is_object($data)) {
            $data = print_r($data, true);
        }
        $entry = $description."\n\n".$data."\n\n\n";
        fwrite($file, $entry);
        fclose($file);
    }
}
