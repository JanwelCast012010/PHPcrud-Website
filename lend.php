<?php
include('server.php');
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
</head>
       <style>
           body {
    font-size: 19px;
}
table{
    width: 60%;
    margin: 10px auto;
    border-collapse: collapse;
    text-align: left;
}
tr {
    border-bottom: 4px solid #cbcbcb;
}
th, td{
    border: none;
    height: 30px;
    padding: 2px;
}
tr:hover {
    background: #F5F5F5;
}

form {
    width: 45%;
    margin: 50px auto;
    text-align: left;
    padding: 20px; 
    border: 1px solid green; 
    border-radius: 5px;
}

.input-group {
    margin: 10px 0px 10px 0px;
}
.input-group label {
    display: block;
    text-align: left;
    margin: 3px;
}
.input-group input {
    height: 30px;
    width: 93%;
    padding: 5px 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid gray;
}
.btn {
    padding: 10px;
    font-size: 15px;
    color: white;
    background: limegreen;
    border: none;
    border-radius: 5px;
}
.edit_btn {
    text-decoration: none;
    padding: 2px 5px;
    background: skyblue;
    color: white;
    border-radius: 3px;
}

.del_btn {
    text-decoration: none;
    padding: 2px 5px;
    color: white;
    border-radius: 3px;
    background: crimson;
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
           </style>
            
<body style="height:1500px">
<div class="container-fluid">
  <br>
<br>
</div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">

  <ul class="navbar-nav">
  <li class="nav-item">
      <a class="nav-link" href="index.php">Member</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="book.php">Books</a>
    </li>
	<li class="nav-item">
      <a class="nav-link" href="lend.php">Lend</a>
    </li>
  </ul>
</nav>
<div class="container-fluid"><br>
    <body>
        <table>
            <thead>
                <tr>
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
        
        $query = "Insert into lend(memberid,bookid,borrowfrom,borrowuntil)
        values('$memberid','$bookid','$borrowfrom','$borrowuntil')";
        mysqli_query($db,$query);
        
        
        header('location:lend.php');
        
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
            <a href="#" class="edit_btn">Edit</a>
        </td>
        <td>
            <a href="#" class="del_btn">Delete</a>
        </td>
    </tr>
<?php }
?>
    </tbody>
    </table>
    <form method="post" action="">
    <div class="input-group">
            <label>Member ID</label>
            <input type="text" name="memberid" value="">
        </div>
        <div class="input-group">
            <label>Book ID</label>
            <input type="text" name="bookid" value="">
        </div>
        <div class="input-group">
            <label>Borrow From</label>
            <input type="date" name="borrowfrom" value="">
        </div>
        <div class="input-group">
            <label>Borrow Until</label>
            <input type="date" name="borrowuntil" value="">
        </div>
        <div>
            <button class="btn" type="submit" name="save" >Save</button>
        </div>
    </form>
    </body>
    </html>

