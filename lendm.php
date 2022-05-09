<?php include('server.php');

if (isset($_GET['edit'])) {
	$lendid = $_GET['edit'];
    $edit_state = true;
        $rec = mysqli_query($db, "SELECT * FROM lend WHERE lendid=$lendid" );
        $record = mysqli_fetch_array($rec);
        $lendid = $record['lendid'];
        $memberid = $record['memberid'];
        $bookid = $record['bookid'];
        $borrowfrom = $record['borrowfrom'];
        $borrowuntil =$record['borrowuntil'];
}
if (isset($_GET['select'])) {
	$memberid = $_GET['select'];
        $rec = mysqli_query($db, "SELECT * FROM member WHERE memberid=$memberid" );
        $record = mysqli_fetch_array($rec);
        $memberid = $record['memberid'];
        $membername = $record['membername'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Library</title>
        <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.css">
</head>
       <style>
body {
    font-size: 19px;
    background: #2E294E; 
}
table{
    width: 60%;
    margin: 10px auto;
    border-collapse: collapse;
    text-align: center;
}
tr {
    color: #F5FBEF;
    border: 2px solid #C5D86D
}
tr:hover{
    background:#2E294E;
}
th, td{
    border: none;
    height: 30px;
    padding: 10px;
}

form {
    width: 45%;
    margin: 20px auto;
    text-align: left;
    padding: 20px; 
    border: 2px solid #C5D86D; 
    border-radius: 50px;
    
    
    
}

.input-group {
    margin: 10px 0px 10px 0px;
}
.input-group label {
    display: block;
    text-align: left;
    margin: 3px;
    color:#ffffff;
    margin-left:25px;
    margin-bottom: 5px;
    margin-top: -5px;
}
.input-group input {
    height: 30px;
    width: 93%;
    padding: 5px 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 2px solid gray;
    background: #ECFEE8;
    color:#331E36;
    margin-left: 20px;
}
.btn {
    margin-top: 5px;
    padding: 5px;
    font-size: 15px;
    color: #ffffff;
    background: limegreen;
    border: none;
    border-radius: 5px;
    margin-left: 240px;
    margin-bottom: -20px;
    padding-left: 20px;
    padding-right: 20px;
}
.edit_btn {
    text-decoration: none;
    padding: 2px 5px;
    background: #1B998B;
    color: white;
    border-radius: 3px;
}
.edit_btn:hover {
    text-decoration: none;
    color:#ffffff;
    
}

.del_btn {
    text-decoration: none;
    padding: 2px 5px;
    color: white;
    border-radius: 3px;
    background: #E71D36;
}
.del_btn:hover {
    text-decoration: none;
    color:#ffffff;
    
}
.msg {
    margin: 30px auto; 
    padding: 10px; 
    border-radius: 5px; 
    color: #3c763d; 
    background: #dff0d8; 
    border: 1px solid #3c763d;
    width: 50%;
    text-align: center;
}
.nav{
    color:#ECFEE8;
    margin-left: 20px;
    font-family: helvetica;
    font-weight: bold;
    font-size: 25px;
    
}
.nav:hover {
    text-decoration: none;
    color:#C5D86D;
    font-weight: bold;
    font-size: 25px;
    font-family: helvetica;
}
.thead {
    background: #ECFEE8;
    color:#331E36;
    
}
           </style>
            
<body style="height:1500px">
<div class="container-fluid">
  <br>
<br>
</div>
<nav class="navbar navbar-expand-sm bg-danger navbar-dark fixed-top">

  <ul class="navbar-nav">
  <li class="nav-item">
      <a class="nav" href="#">Home</a>
    </li>
  <li class="nav-item">
      <a class="nav" href="index.php">User</a>
    </li>
    <li class="nav-item">
      <a class="nav" href="bookm.php">Books</a>
    </li>
	<li class="nav-item">
      <a class="nav" href="lendm.php">Lend</a>
    </li>
    
  </ul>
</nav>
<div class="container-fluid"><br>
    <body>
        <table>
            <thead>
                <tr class= "thead">
                    <th>Lend ID</th>
                    <th>Member ID</th>
                    <th>Book ID</th>
                    <th>Borrow From</th>
                    <th>Borrow Until</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>


            <?php 

            if(isset($_POST['save'])){
                $memberid =$_POST['memberid'];
                $bookid =$_POST['bookid'];
                $borrowfrom =$_POST['borrowfrom'];
                $borrowuntil =$_POST['borrowuntil'];
        
        $query = "Insert into lend (memberid,bookid,borrowfrom,borrowuntil) 
        values('$memberid','$bookid','$borrowfrom','$borrowuntil')";
        mysqli_query($db,$query);
        
        
        header('location:lendm.php');
        
        }
        ?>
<?php
        if(isset($_POST['update'])){
            $lendid = ($_POST['lendid']);
            $memberid =$_POST['memberid'];
            $bookid =$_POST['bookid'];
            $borrowfrom = ($_POST['borrowfrom']);
            $borrowuntil = ($_POST['borrowuntil']);
            
                
        mysqli_query($db, "UPDATE lend SET memberid='$memberid', bookid='$bookid', borrowfrom='$borrowfrom', borrowuntil='$borrowuntil' 
        where lendid=$lendid" );
        $_SESSION['msg'] = "borrowuntil updated";
        header('location: lendm.php');
    }
    if (isset($_GET['del'])) {
        $lendid = $_GET['del'];
        mysqli_query($db, "DELETE FROM lend WHERE lendid=$lendid");
        $_SESSION['message'] = "borrowuntil deleted!"; 
        header('location: lendm.php');
    }
           
        
        $results= mysqli_query($db,"Select * from lend");
            ?>
<?php
    while ($row = mysqli_fetch_array($results)){ ?>
    <tr>
        <td><?php echo $row['lendid'];?></td>
        <td><?php echo $row['memberid'];?></td>
        <td><?php echo $row['bookid'];?></td>
        <td><?php echo $row['borrowfrom'];?></td>   
        <td><?php echo $row['borrowuntil'];?></td>   
        <td>
            <a href="lendm.php?edit=<?php echo $row['lendid']; ?>" class="edit_btn">Edit</a>
        </td>
        <td>
            <a href="lendm.php?del=<?php echo $row['lendid'];?>" class="del_btn">Delete</a>
        </td>
    </tr>
<?php }
?>
    </tbody>
    </table>
    <form method="post" action="lendm.php">
        <input type="hidden" name="lendid" value=<?php echo $lendid; ?>>
        <div class="input-group">
        <div class="input-group">
            <label> Member ID</label>
            <input type="text" name="memberid" value=<?php echo $memberid; ?>>
        </div>
        <div class="input-group">
            <label> Book ID</label>
            <input type="text" name="bookid" value=<?php echo $bookid; ?>>
        </div>
            <label>Borrow From</label>
            <input type="date" name="borrowfrom" value=<?php echo $borrowfrom; ?>>
        </div>
        <div class="input-group">
            <label> Borrow Until</label>
            <input type="date" name="borrowuntil" value=<?php echo $borrowuntil; ?>>
        </div>
        
        <div class="input-group">
            <?php if ($edit_state == false): ?>
            <button class="btn" type="submit" name="save" >Save</button>
            <?php else: ?>
            <button class="btn" type="submit" name="update" >update</button>
            <?php endif?>
        </div>
    </form>
    <!-- 0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000 -->
    <div class="container2-fluid"><br>
    <body>
        <table>
            <thead>
                <tr class= "thead">
                    <th>Member ID</th>
                    <th>Member Name</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
<?php
        $results= mysqli_query($db,"Select * from member");
            ?>
<?php
    while ($row = mysqli_fetch_array($results)){ ?>
    <tr>
        <td><?php echo $row['memberid'];?></td>
        <td><?php echo $row['membername'];?></td>    
        <td>
            <a href="lendm.php?select=<?php echo $row['memberid']; ?>" class="edit_btn">Select</a>
        </td>
    </tr>
<?php }
?>
    </tbody>
    </table>
    </body>
    </html>