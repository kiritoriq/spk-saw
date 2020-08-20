<?php
	
	session_start();
  	if($_SESSION['status']!="logged in"){
    	header("location:login/index.php");
  	} else {
  		header('location:dashboard');
  	}
  		// header('location:dashboard/index.php');
