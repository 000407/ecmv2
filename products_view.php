<?php require_once 'header.php'?>

<h1>All Products</h1>

<?php
	$rows = get_products();
?>
<table border='1' style='border-collapse: collapse; width: 100%;'>
	<tr>
		<th><h4>Item Info</h4></th>
	</tr>

	<?php foreach ($rows as $i => $record): ?>
	<tr>
		<td>
			<h5><a href='<?= site_url() ?>/products_view_one.php?id=<?= $record['id'] ?>'><?= $record['item_title'] ?></a></h5>
			<p><?= $record['item_subtitle'] ?></p>
		</td>
	</tr>
	<?php endforeach; ?>

</table>

<?php require_once 'footer.php'?>