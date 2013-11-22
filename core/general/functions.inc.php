<?php

/*
 * Function _post: Devuelve el resultado de un post
 * @param string $name
 * @param string $default
 * @return mixed
 */

function _post($name, $default = '') {
    if (!isset($_POST[$name])) {
        return $default;
    } else {
        return $_POST[$name];
    }
}

/*
 * Function _get: Devuelve el resultado de un get
 * @param string $name
 * @param string $default
 * @return mixed
 */

function _get($name, $default = '') {
    if (!isset($_GET[$name])) {
        return $default;
    } else {
        return $_GET[$name];
    }
}

/*
 * Function _request: Devuelve el resultado de un request
 * @param string $name
 * @param string $default
 * @return mixed
 */

function _request($name, $default = '') {
    if (!isset($_REQUEST[$name])) {
        return $default;
    } else {
        return $_REQUEST[$name];
    }
}

/*
 * Function _session: Devuelve el resultado de la sesion
 * @param string $name
 * @param string $default
 * @return mixed
 */

function _session($name, $default = '') {
    if (!isset($_SESSION[$name])) {
        return $default;
    } else {
        return $_SESSION[$name];
    }
}

/*
 * Function set_session: Guarda un valor en la sesion
 * @param string $name
 * @param string $valor
 */

function set_session($name, $valor) {
    $_SESSION[$name] = $valor;
}

/*
 * Function get_rand_id: Devuelve una cadena de caracteres randomica
 * @param string $name
 * @param string $default
 * @return mixed
 */

function get_rand_id($length) {
    if ($length > 0) {
        $rand_id = "";
        for ($i = 1; $i <= $length; $i++) {
            mt_srand((double) microtime() * 1000000);
            $num = mt_rand(1, 36);
            $rand_id .= assign_rand_value($num);
        }
    }
    return $rand_id;
}

function assign_rand_value($num) {
    switch ($num) {
        case "1":
            $rand_value = "a";
            break;
        case "2":
            $rand_value = "b";
            break;
        case "3":
            $rand_value = "c";
            break;
        case "4":
            $rand_value = "d";
            break;
        case "5":
            $rand_value = "e";
            break;
        case "6":
            $rand_value = "f";
            break;
        case "7":
            $rand_value = "g";
            break;
        case "8":
            $rand_value = "h";
            break;
        case "9":
            $rand_value = "i";
            break;
        case "10":
            $rand_value = "j";
            break;
        case "11":
            $rand_value = "k";
            break;
        case "12":
            $rand_value = "l";
            break;
        case "13":
            $rand_value = "m";
            break;
        case "14":
            $rand_value = "n";
            break;
        case "15":
            $rand_value = "o";
            break;
        case "16":
            $rand_value = "p";
            break;
        case "17":
            $rand_value = "q";
            break;
        case "18":
            $rand_value = "r";
            break;
        case "19":
            $rand_value = "s";
            break;
        case "20":
            $rand_value = "t";
            break;
        case "21":
            $rand_value = "u";
            break;
        case "22":
            $rand_value = "v";
            break;
        case "23":
            $rand_value = "w";
            break;
        case "24":
            $rand_value = "x";
            break;
        case "25":
            $rand_value = "y";
            break;
        case "26":
            $rand_value = "z";
            break;
        case "27":
            $rand_value = "0";
            break;
        case "28":
            $rand_value = "1";
            break;
        case "29":
            $rand_value = "2";
            break;
        case "30":
            $rand_value = "3";
            break;
        case "31":
            $rand_value = "4";
            break;
        case "32":
            $rand_value = "5";
            break;
        case "33":
            $rand_value = "6";
            break;
        case "34":
            $rand_value = "7";
            break;
        case "35":
            $rand_value = "8";
            break;
        case "36":
            $rand_value = "9";
            break;
    }
    return $rand_value;
}

function text_preview($text, $length = '55') {
    $length = (int) $length;
    $length_total = strlen($text);

    if ($length_total > $length) {
        $pos = strpos($text,' ', $length - 1);
        if ($pos !== false) {
            $length = $pos;
        }
        return substr($text, 0, $length) . "...";
    } else {
        return $text;
    }
}

function imagen_o_default($objeto, $imagen = "imagen", $path = "files/productos/", $default = "images/public/nodisponible.jpg") {
    $retorno = $default;
    if (isset($objeto[$imagen])) {
        if ($objeto[$imagen] != "") {
            if (file_exists($path . $objeto[$imagen])) {
                $retorno = $path . $objeto[$imagen];
            }
        }
    }
    return $retorno;
}

function curPageURL(){
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on"){
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80"){
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    }else{
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

function curPageName(){
    return substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
}

function selfURL(){
    $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
    $protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/") . $s;
    $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":" . $_SERVER["SERVER_PORT"]);
    return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
}

function strleft($s1, $s2){
    return substr($s1, 0, strpos($s1, $s2));
}

function contains($str, $content, $ignorecase = true){
    if ($ignorecase){
        $str = strtolower($str);
        $content = strtolower($content);
    }

    return strpos($content, $str) ? true : false;
}

function UrlGenerica(){
    $url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    return $url;
}

function getLangURL($lang) {

    $url = selfURL();
    $tmp = "";
    if (contains("locale", $url, true)) {
        $provisorio = UrlGenerica();

        if (contains("&locale=en", $provisorio, true)) {
            $tmp = str_replace("&locale=en", "", $provisorio);
        }

        if (contains("&locale=es", $provisorio, true)) {
            $tmp = str_replace("&locale=es", "", $provisorio);
        }
        if (contains("?", $tmp, true)) {
            return $tmp . $lang;
        } else {
            return $tmp . "?" . $lang;
        }
    } else

    if (contains("?", $url, true)) {
        return selfURL() . $lang;
    } else {

        return selfURL() . "?" . $lang;
    }
}

?>