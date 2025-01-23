<?php 
session_start();
$item_name='';
if(isset($_GET['query'])){
    echo $_GET['query'];
    $item_name = $_GET['query'];
}

?>