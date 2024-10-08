<?php
include_once('../model/controller.php');
if(isset($_POST['cls'])){
    $cls = $_POST['cls'];
    $status = 'closed';
    $chk = update_case($status,$cls);
        if($chk==TRUE){
            echo 'Case Closed';
        }else{
            echo 'Error, try again';
        }
    }
if(isset($_POST['del'])){
    $del = $_POST['del'];
    $chk = deleteInc($del);
        if($chk==TRUE){
            echo 'Result Deleted';
        }else{
            echo 'Error, try again';
        }
    }
if(isset($_POST['dela'])){
    $del = $_POST['dela'];
    $chk = deleteAlt($del);
        if($chk==TRUE){
            echo 'Alert Deleted';
        }else{
            echo 'Error, try again';
        }
    }
?>