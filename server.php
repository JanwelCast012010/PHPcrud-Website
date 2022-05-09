<?php

session_start();
    // BOOK
    $bookid = 0;
    $booktitle = "";
    // USER
   $membername = "";
   $address= "";
    $memberid = 0;
    $update= false;
    $edit_state= false;
    // LEND
    $lendid = 0;
    $borrowfrom="";
    $borrowuntil="";
$db = mysqli_connect('localhost','root','password','final_crud');

?>