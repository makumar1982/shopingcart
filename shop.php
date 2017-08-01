<?php
session_start();
include 'dbconnect.php';
if(isset($_POST['add'])){
    if(isset($_SESSION['cart'])){
        $item_array_id = array_column($_SESSION['cart'],"product_id");
        print_r($item_array_id); exit;
        if(!in_array($item_array_id, $_GET['id'])){
            $count = count($_SESSION['cart']);
            $item_array = [
                'product_id' =>$_GET['id'],
                'item_name' =>$_POST['hidden_name'],
                'product_price' =>$_POST['hidden_price'],
                'item_quantity' => $_POST['quantity']
            ];
            $_SESSION['cart'][$count] = $item_array;
            echo '<script>window.location="index.php"></script>';
        }
        else{
            echo '<script>alert("Product already added to cart");</script>';
            echo '<script>window.location="index.php"></script>';
        }
    }
    else{
        $item_array = [
                'product_id' =>$_GET['id'],
                'item_name' =>$_POST['hidden_name'],
                'product_price' =>$_POST['hidden_price'],
                'item_quantity' => $_POST['quantity']
            ];
        $_SESSION['cart'][0] = $item_array;
    }
}
if(isset($_GET['action'])){
    if($_GET['action'] == 'delete'){
        foreach($_SESSION['cart'] as $key => $value){
            if($value['product_id'] == $_GET['id']){
                unset($_SESSION['cart'][$key]);
                echo '<script>alert("Product have been removed from cart");</script>';
                echo '<script>window.location="index.php"></script>';
            }
        }
    }
}
?>
