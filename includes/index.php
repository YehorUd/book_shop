<?php
include ('config.php');
session_start();
if(!isset($_SESSION['cart'])){
  $_SESSION['cart'] = array();
}
unset($_SESSION['qty_array']);
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
table, th, td {
  border: 1px solid;
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
.cartcss{
  vertical-align: 12px;
}

#cart_count{
  text-align: center;
  padding: 0 0.9rem 0.1rem 0.9rem;
  border-radius: 3rem;
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
<div>
<img src="images/cart.png" width ="40" height="40" ></img>
<a class="cartcss" href="view_cart.php">My Cart
  <?php
  if(isset($_SESSION['cart'])){
    $count = count($_SESSION['cart']);
    echo "<span class=\"text-warning bg-light\" id=\"cart_count\">$count</span>";
  }else{
    echo "<span class=\"text-warning bg-light\" id=\"cart_count\">0</span>";
  }
  ?>
</a>
</ul>
    </nav>
</div>
  </div>
<div id ="center">  
  <img src="images/logo.jpg" width ="400" height="400">
</div>
<div style ="margin: 50px;">
<h1>List of Books</h1>
<form action="" method="GET">
<div align="center" class = "input-group mb-3">
    <input type="text" name="search" class="form-control" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>" placeholder="Search..">
    <button type="submit"><i class="fa fa-search"></i></button>
</form>
  </div>
<br>

<table class="table">
  <thead>
    <tr>
      <th>ISBN</th>
      <th>Title</th>
      <th>Author</th>
      <th>Categories</th>
      <th>Prise</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      //info message
      if(isset($_SESSION['message'])){
        ?>
        <div class="row">
          <div class="col-sm-6 col-sm-offset-6">
            <div class="alert alert-info text-center">
              <?php echo $_SESSION['message']; ?>
            </div>
          </div>
        </div>
        <?php
        unset($_SESSION['message']);
      }
    if(isset($_GET['search'])){
    $filtervalues = $_GET['search'];
    $query = "SELECT * FROM books WHERE CONCAT(book_isbn, book_title, book_author, book_categories) LIKE '%$filtervalues%' ";
    $query_run = mysqli_query($db, $query);
    
    if(mysqli_num_rows($query_run) > 0)
    {
      foreach($query_run as $items){
        ?>
        <tr>
        <form action="index.php" method="post">
        <td><?= $items['book_isbn']; ?></td>
        <td><?= $items['book_title']; ?></td>
        <td><?= $items['book_author']; ?></td>
        <td><?= $items['book_categories']; ?></td>
        <td><?= $items['book_price']; ?></td>
        <td>
        <div class="row product_footer">
							<span class="pull-right"><a href="add_cart.php?book_isbn=<?php echo $items['book_isbn']; ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span>Buy</a></span>
						</div>
        </td>
        </form>
        </tr>
        <?php
      }
    }
    else
    {
?>
<tr>
  <td colspan="4">No Record Found</td>
</tr>
<?php
    }
    }
    ?>
  </tbody>
</table>
</div>
</div>
	</body>
</html>