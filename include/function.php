<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

function url($route = '')
{
    return "http://localhost/my_blog2/".$route;
}
function redirect($url = "")
{
    if(!empty($url))
    {
        return header("location:". $url);
    }
    return false;
}