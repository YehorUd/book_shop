<?php
include ("config.php");
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
	<h1 class="page-header text-center">Cart Details</h1>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<?php 
			if(isset($_SESSION['message'])){
				?>
				<div class="alert alert-info text-center">
					<?php echo $_SESSION['message']; ?>
				</div>
				<?php
				unset($_SESSION['message']);
			}

			?>
			<form method="POST" action="save_cart.php">
			<table class="table table-bordered table-striped">
				<thead>
					<th></th>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Subtotal</th>
				</thead>
				<tbody>
					<?php
						//initialize total
						$total = 0;
						if(!empty($_SESSION['cart'])){
						//connection
						//create array of initail qty which is 1
 						$index = 0;
 						if(!isset($_SESSION['qty_array'])){
 							$_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
 						}
            $sql = "SELECT * FROM `books` WHERE `book_isbn` IN (".implode(',',$_SESSION['cart']).")";
            $query = $db->query($sql);
      while($row = $query->fetch_assoc()){
        ?>
        <tr>
          <form>
          <td><?php echo $row['book_title']; ?></td>
          <td><?php echo number_format($row['book_price'], 2); ?></td>
          <input type="hidden" name="indexes[]" value="<?php echo $index; ?>">
          <td><input type="text" class="form-control" value="<?php echo $_SESSION['qty_array'][$index]; ?>" name="qty_<?php echo $index; ?>"></td>
          <td><?php echo number_format($_SESSION['qty_array'][$index]*$row['book_price'], 2); ?></td>
          </form>
          <?php $total += $_SESSION['qty_array'][$index]*$row['book_price']; 
          $_SESSION['grand_total'] = $total;
          $_SESSION['index'] = $_SESSION['qty_array'][$index];
          ?>
        </tr>
        <?php
        $index ++;
							}
              $_SESSION['quantity'] = $query->fetch_assoc();
						}
						else{
							?>
							<tr>
								<td colspan="4" class="text-center">No Item in Cart</td>
							</tr>
							<?php
						}
					?>
					<tr>
						<td colspan="4" align="right"><b>Total</b></td>
						<td><b><?php echo number_format($total, 2); ?></b></td>
					</tr>
				</tbody>
			</table>
			<a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
			<button type="submit" class="btn btn-success" name="save">Save Changes</button>
			<a href="clear_cart.php" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Clear Cart</a>
			<a href="purchase.php" class="btn btn-success" name="placeOrder"><span class="glyphicon glyphicon-check"></span> Purchase</a>
			</form>
		</div>
	</div>
</div>
	</body>
</html>