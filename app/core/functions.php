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

// Database Row query
function query_row(string $query, array $data = []){

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
        return $result[0];

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

function old_checked($key, $default = ''){

    if(!empty($_POST[$key]))
        return " checked ";

    return "";
}

function old_select($key, $value, $default = ''){

    if(!empty($_POST[$key]) && $_POST[$key] == $value)
        return " selected ";

    if($default == $value)
        return " selected ";

        return "";

}

function get_image($file){

    $file = $file ?? '';
    if(file_exists($file)){

        return ROOT . '/' . $file;

    }

    return ROOT . '/assets/images/no_image.jpg';

}

function authenticate($row){

    $_SESSION['USER'] = $row;

}

function logged_in(){

    if(!empty($_SESSION['USER']))
        return true;

    return false;

}

function get_pagination_vars(){

    
// set pagination vars
$page_number = $_GET['page'] ?? 1;
$page_number = empty($page_number) ? 1 : (int)$page_number;
$page_number = $page_number < 1 ? 1 : $page_number;

$current_link = $_GET['url'] ?? 'home';
$current_link = ROOT . "/" . $current_link;
$query_string = "";

foreach($_GET as $key => $value){

    if($key != 'url')
    $query_string .= "&" . $key . "=" . $value;

}

if(!strstr($query_string, "page=")){

    $query_string .= "&page=" . $page_number;

}

$query_string = trim($query_string, "&");
$current_link .= "?" . $query_string;

$current_link = preg_replace("/page=.*/", "page=" . $page_number, $current_link);
$next_link = preg_replace("/page=.*/", "page=" . ($page_number + 1), $current_link);
$first_link = preg_replace("/page=.*/", "page=1", $current_link);
$prev_page_number = $page_number < 2 ? 1 : $page_number - 1;
$prev_link = preg_replace("/page=.*/", "page=" . $prev_page_number, $current_link);

$result = [
    'current_link' => $current_link,
    'next_link' => $next_link,
    'prev_link' => $prev_link,
    'first_link' => $first_link,
    'page_number' => $page_number
];

return $result;

}

function str_to_url($url) {
    $url = str_replace("'", "", $url);
    $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
    $url = trim($url, "-");
    $url = iconv("utf-8", "ASCII//IGNORE", $url);
    $url = strtolower($url);
    $url = preg_replace('~[^-a-z0-9_]+~', '', $url);

    return $url;
}


function esc($str){

    return htmlspecialchars($str ?? '');

}

function resize_image($filename, $max_size = 1000){

    if(file_exists($filename)){

        $type = mime_content_type($filename);
        switch ($type){
            case 'image/jpeg':
                $image = imagecreatefromjpeg($filename);
                break;
            case 'image/png':
                $image = imagecreatefrompng($filename);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($filename);
                break;
            case 'image/webp':
                $image = imagecreatefromwebp($filename);
                break;
            default:
                return;
                break;
        }

        $src_width = imagesx($image);
        $src_height = imagesy($image);

        if($src_width > $src_height){
            
            if($src_width < $max_size){

                $max_size = $src_width;

            }

            $dst_width = $max_size;
            $dst_height = ($src_height / $src_width) * $max_size;

        }else{
            
            if($src_height < $max_size){
    
                $max_size = $src_height;
    
            }
    
            $dst_height = $max_size;
            $dst_width = ($src_width / $src_height) * $max_size;
        }

        $dst_height = round($dst_height);
        $dst_width = round($dst_width);

        $dst_image = imagecreatetruecolor($dst_width, $dst_height);
        imagecopyresampled($dst_image, $image, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

        imagejpeg($dst_image, $filename, 90);

        
    }

}