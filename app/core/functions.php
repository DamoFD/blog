<?php

// Database query
function query(string $query, array $data = []){

    // Database Credentials
    $string = "mysql:hostname=" . DBHOST. ";dbname=". DBNAME;

    // Create Connection
    $con = new PDO($string, DBUSER, DBPASS);

    // Prepare Statement
    $stm = $con->prepare($query);

    // Execute Query
    $stm->execute($data);

    // Fetch Result as Associative Array
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    if(is_array($result) && !empty($result)){

        // Return The Result
        return $result;

    }

    return false;

}

function redirect($page){

    header('Location: ' . ROOT . '/' . $page);

}

function old_value($key, $default = ''){
    
    if(!empty($_POST[$key]))
        return $_POST[$key];

        return $default;

}

function authenticate($row){

    $_SESSION['USER'] = $row;

}

function logged_in(){

    if(!empty($_SESSION['USER']))
        return true;

    return false;

}

function str_to_url($url){

    $url = str_replace("'", "", $url);
    $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
    $url = trim($url, "-");
    $url = iconv("utf-8", "us-ascii//TRASLIT", $url);
    $url = strtolower($url);
    $url = preg_replace('~[^-a-z0-9_]+~', '', $url);

    return $url;

}

function esc($str){

    return htmlspecialchars($str ?? '');

}