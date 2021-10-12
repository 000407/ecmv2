<?php require_once 'header.php'?>
<?php require_once 'auth_guard.php'?>

<?php
	$id = $_GET['id'];
	$product = get_product($id);
?>

<?php if($product == null): ?>

<div class="alert alert-danger" role="alert">
  <h3>No product was found for ID: <?= $id ?>!</h3>
</div>

<?php else: ?>

	<h1>Product: <?= $product['item_title'] ?></h1>
	<p><?= $product['item_subtitle'] ?></p>

<?php endif; ?>

<?php require_once 'footer.php'?>