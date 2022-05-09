<?php include('server.php');

if (isset($_GET['edit'])) {
	$memberid = $_GET['edit'];
    $edit_state = true;
        $rec = mysqli_query($db, "SELECT * FROM member WHERE memberid=$memberid" );
        $record = mysqli_fetch_array($rec);
        $memberid = $record['memberid'];
        $membername = $record['membername'];
        $address =$record['address'];
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
    width: 50%;
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
                    <th>Member ID</th>
                    <th>Member Name</th>
                    <th>Address</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>


            <?php 

            if(isset($_POST['save'])){
                $membername =$_POST['membername'];
                $address =$_POST['address'];
        
        $query = "Insert into member(membername,address) values('$membername','$address')";
        mysqli_query($db,$query);
        
        
        header('location:index.php');
        
        }
        ?>
<?php
        if(isset($_POST['update'])){
            $memberid = ($_POST['memberid']);
            $membername = ($_POST['membername']);
            $address = ($_POST['address']);
            
                
        mysqli_query($db, "UPDATE member SET membername='$membername', address='$address' where memberid=$memberid" );
        $_SESSION['msg'] = "Address updated";
        header('location: index.php');
    }
    if (isset($_GET['del'])) {
        $memberid = $_GET['del'];
        mysqli_query($db, "DELETE FROM member WHERE memberid=$memberid");
        $_SESSION['message'] = "Address deleted!"; 
        header('location: index.php');
    }
           
        
        $results= mysqli_query($db,"Select * from member");
            ?>
<?php
    while ($row = mysqli_fetch_array($results)){ ?>
    <tr>
        <td><?php echo $row['memberid'];?></td>
        <td><?php echo $row['membername'];?></td>   
        <td><?php echo $row['address'];?></td>   
        <td>
            <a href="index.php?edit=<?php echo $row['memberid']; ?>" class="edit_btn">Edit</a>
        </td>
        <td>
            <a href="index.php?del=<?php echo $row['memberid'];?>" class="del_btn">Delete</a>
        </td>
    </tr>
<?php }
?>
    </tbody>
    </table>
    <form method="post" action="index.php">
        <input type="hidden" name="memberid" value=<?php echo $memberid; ?>>
        <div class="input-group">
            <label>Member Name</label>
            <input type="text" name="membername" value=<?php echo $membername; ?>>
        </div>
        <div class="input-group">
            <label>Address</label>
            <input type="text" name="address" value=<?php echo $address; ?>>
        </div>
        <div class="input-group">
            <?php if ($edit_state == false): ?>
            <button class="btn" type="submit" name="save" >Save</button>
            <?php else: ?>
            <button class="btn" type="submit" name="update" >update</button>
            <?php endif?>
        </div>
    </form>
   
    </body>
    </html>