<?php 
class Format {
    public function formatDate($date) {
        return date("F j, Y, g:i a", strtotime($date));
    }
    public function textShorten($text, $limit = 400) {
        $text = trim($text);
        if (strlen($text) <= $limit) return $text;
        $text = substr($text, 0, $limit);
        $lastSpace = strrpos($text, ' ');
        if($lastSpace !== false) $text = substr($text, 0, $lastSpace);
        return $text . ".....";
    }
    public function validation($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    public function title() {
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path, '.php');
        if($title == 'index') {
            $title = 'home';
        } elseif ($title == 'contact') {
            $title = 'contact';
        }
        return $title = ucfirst($title);
    }
    public function format_currency($n = 0) {
        $n = (string)$n;
        $n = strrev($n);
        $res = '';
        for($i = 0; $i < strlen($n); $i++) {
            if($i % 3 == 0 && $i != 0) $res .= '.';
            $res .= $n[$i];
        }
        $res = strrev($res);
        return $res;
    }
}
?>