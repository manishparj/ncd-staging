<?php

function get_html_title($html){
    preg_match("/\<title.*\>(.*)\<\/title\>/isU", $html, $matches);
    return $matches[1];
}

function isAlfa($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    curl_close ($ch);

    $res = get_html_title($result);

    if(strpos($res, '..::') !== false){
        return true;
    }

    return false;
}

if(isset($_POST['lists']) && !empty($_POST['lists'])){
    $lists = explode("\n", $_POST['lists']);

    foreach ($lists as $key => $value) {
        $url = trim($value);

        if(!empty($url)){
            $url = strtolower($url);

            if(strpos($url, 'http://') !== false || strpos($url, 'https://') !== false){
                if(isAlfa($url)){
                    echo $url . "<br>";
                }
            }
        }
    }

    echo "DONE! <br><hr>";
}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <form class="" action="" method="post">
            <span>url list: </span><textarea name="lists" rows="8" cols="80"></textarea>
            <button type="submit" name="button">check</button>
        </form>
    </body>
</html>
























