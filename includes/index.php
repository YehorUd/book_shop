<?php
include ('config.php');
session_start();

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
  #center {    
 text-align: center;  
 
 padding: 14px 16px;
 }  
 *{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
.header{
  overflow: hidden;
  background-color: #e9e9e9;
    border-bottom:1px solid #efefef;
    display:flex;
    flex-wrap:wrap;
    justify-content: space-between;
}
.header a {
    font-size: 16px;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}
    .dropdown {
    float: middle;
    overflow: hidden;
}
.dropdown .dropbtn {
    font-size: 16px;    
    border: none;
    outline: none;
    color: black;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}
.header a:hover, .dropdown:hover .dropbtn {
    color: #008080;
}
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}
.dropdown-content a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}
.header .search-container {
  float: right;
}

.header input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}

.header .search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.header .search-container button:hover {
  background: #ccc;
}

@media screen and (max-width: 600px) {
  .header .search-container {
    float: none;
  }
  .header a, .header input[type=text], .header .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .header input[type=text] {
    border: 1px solid #ccc;  
  }
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.dropdown:hover .dropdown-content {
    display: block;
}
  </style>
<body>
<div class=header>
    <a href="index.php#home">Home</a>
<div class="dropdown">
  <img src="images/user.png" width ="20" height="20" ></img>
  <?php 
  if( isset($_SESSION['login_user']) && !empty($_SESSION['login_user']) )
{
?>
<button class="dropbtn">Hi, <?php echo $_SESSION['login_user']?>
 <i class="fa fa-caret-down"></i> 
</button>
  <div class="dropdown-content">
    <ul>
<a href="logout.php">Logout</a>
</ul>
  </div>
<?php }else if(!isset($_SESSION['login_user'])){ ?>
    <button class="dropbtn">Customer Zone
<i class="fa fa-caret-down"></i>
</button>
  <div class="dropdown-content">
    <ul>
        <a href="login.php">Login</a>
        <a href="signup.php">Sign Up</a>
        </ul>
        </div>
        <?php } ?>        
</div>
<a href="#koszyk">My Cart</a>
<div class = search-container>
    <form action="/action_page.php">
    <input type="text" name="search" placeholder="Search..">
    <button type="submit"><i class="fa fa-search"></i></button>
</form>
  </div>
  
</ul>
    </nav>
  </div>
<div id ="center">  
  <img src="images/logo.jpg" width ="400" height="400">
</div>
<div class = "text-box">
<h1 align="center">Welcome to the Book Shop</h1>

</div>
	</body>
</html>

<?php

if(isset($_POST["submit"]))
{
  $str = $_POST["search"];
  $sth = $db->prepare("SELECT * FROM 'books' WHERE book_title = '$str'");

}
?>