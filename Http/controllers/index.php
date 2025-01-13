<?php

//$heading = "Home";

//require base_path("views/index.view.php");

//require view("index.view.php");




$_SESSION['name'] = 'Yevhen';  //Saving the value in session


view("index.view.php", ['heading' => 'Home']);