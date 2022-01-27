<h3><a class="btn btn-primary" href="index.php">naar index gaan</a></h3>
<?php
error_reporting(0);
//Setting session start
session_start();

$total=0;

$conn = new PDO("mysql:host=localhost;dbname=webwinkel", 'root', '');		
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//get action string
$action = isset($_GET['action'])?$_GET['action']:"";

//Add to cart
if($action=='addcart' && $_SERVER['REQUEST_METHOD']=='POST') {
	
	//Finding the product by code
	$query = "SELECT * FROM artikel WHERE artikelCode=:artikelCode";
	$stmt = $conn->prepare($query);
	$stmt->bindParam('artikelCode', $_POST['artikelCode']);
	$stmt->execute();
	$product = $stmt->fetch();
	
	$currentQty = $_SESSION['artikel'][$_POST['artikelCode']]['qty']+1; //Incrementing the product qty in cart
	$_SESSION['artikel'][$_POST['artikelCode']] =array('qty'=>$currentQty,'artikelnaam'=>$product['artikelnaam'],'image'=>$product['image'],'prijs'=>$product['prijs']);
	$product='';
	header("Location:shopping-cart.php");
}

//Empty All
if($action=='emptyall') {
	$_SESSION['artikel'] =array();
	header("Location:shopping-cart.php");	
}

//Empty one by one
if($action=='empty') {
	$artikelCode = $_GET['artikelCode'];
	$artikel = $_SESSION['artikel'];
	unset($artikel[$artikelCode]);
	$_SESSION['artikel']= $artikel;
	header("Location:shopping-cart.php");	
}
 
 //Get all artikel
$query = "SELECT * FROM artikel";
$stmt = $conn->prepare($query);
$stmt->execute();
$artikel = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PHP registration form</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="width:600px;">
  <?php if(!empty($_SESSION['artikel'])):?>
  <nav class="navbar navbar-inverse" style="background:#AFA881;">
    <div class="container-fluid pull-left" style="width:300px;">
      <div class="navbar-header"> <a class="navbar-brand" href="#" style="color:#FFFFFF;">Shopping Cart</a> </div>
    </div>
    <div class="pull-right" style="margin-top:7px;margin-right:7px;"><a href="shopping-cart.php?action=emptyall" class="btn btn-info">Empty cart</a></div>
  </nav>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Image</th>
        <th>Naam</th>
        <th>Prijs</th>
        <th>Qty</th>
        <th>Actions</th>
      </tr>
    </thead>
    <?php foreach($_SESSION['artikel'] as $key=>$product):?>
    <tr>
      <td><img src="<?php echo $product['image']?>" width="50"></td>
      <td><?php echo $product['artikelnaam']?></td>
      <td>$<?php echo $product['prijs']?></td>
      <td><?php echo $product['qty']?></td>
      <td><a href="shopping-cart.php?action=empty&artikelCode=<?php echo $key?>" class="btn btn-info">Delete</a></td>
    </tr>
    <?php $total = $total+$product['qty']*$product['prijs'];?>
    <?php endforeach;?>
    <tr><td colspan="5" align="right"><h4>Total:$<?php echo $total?></h4></td></tr>
  </table>
  <?php endif;?>
  <nav class="navbar navbar-inverse" style="background:#AFA881;">
    <div class="container-fluid">
      <div class="navbar-header"> <a class="navbar-brand" href="#" style="color:#FFFFFF;">artikel</a> </div>
    </div>
  </nav>
  <div class="row">
    <div class="container" style="width:600px;">
      <?php foreach($artikel as $product):?>
      <div class="col-md-4">
        <div class="thumbnail"> <img src="<?php echo $product['image']?>">
          <div class="caption">
            <p style="text-align:center;"><?php echo $product['artikelnaam']?></p>
            <p style="text-align:center;color:#04B745;"><b>$<?php echo $product['prijs']?></b></p>
            <form method="post" action="shopping-cart.php?action=addcart">
              <p style="text-align:center;color:#04B745;">
                <button type="submit" class="btn btn-danger">Add To Cart</button>
                <input type="hidden" name="artikelCode" value="<?php echo $product['artikelCode']?>">
              </p>
            </form>
          </div>
        </div>
      </div>
      <?php endforeach;?>
    </div>
  </div>
</div>
</body>
</html>