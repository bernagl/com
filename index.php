<?php
session_start();
if(!isset($_SESSION["uid"])){ header("Location: login.html"); }
else { header('Location: index.html'); }
// $uid = $_SESSION['uid'];
// echo $uid;