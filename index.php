<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once('vendor/autoload.php');

//Instantiate the F3 Base class
$f3 = Base::instance();

$f3->set('colors', array('pink', 'green', 'blue'));

//run $f3
$f3->route('GET / ', function(){
    $view = new Template();
    echo $view->render('views/pet-home.html');
});

$f3->route('GET|POST /order ', function($f3){

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $colors = array("blue", "orange", "red");
        var_dump($_POST);
        if(empty($_POST['pet']) || !in_array($_POST['color'], $colors)){
            echo "<p>Please supply a pet type</p>";
        } else{
            $_SESSION['pet'] = $_POST['pet'];
            $_SESSION['color'] = $_POST['color'];
            $f3->reroute('order2');
            session_destroy();
        }
    }
    $view = new Template();
    echo $view->render('views/pet-order.html');
});

$f3-> route('GET /summary', function (){
    $view = new Template();
    echo $view->render('views/summary.html');
});

$f3->route('GET|POST /order2 ', function($f3){
    $view = new Template();
    echo $view->render('views/form2.html');
});



$f3-> run();