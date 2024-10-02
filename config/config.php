<?php
class config {
    function koneksi() {
        $conn = new mysqli('localhost', 'wahyuhs', '70729604', 'pweb1');
        
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }
        
        return $conn;
    }

    function auth() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        error_log("Session contents: " . print_r($_SESSION, true));
        
        return isset($_SESSION['login']['id']);
    }

    function site_url(){
        return "http://localhost/php_test1";
    }
}
?>
