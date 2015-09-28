<?php include ("allproducts_array.php"); ?>
<div class="container"><div class="row">

<?php foreach ($bd as $row) { ?>
	<div class="col-md-4">
		<p class="h4"><?php $row['text']?></p>
		<hr>
		<ul class="list-unstyled">
	<?php foreach ($row['href'] as $value) { ?>
		<li><a href="<?php $value['href']?>"><?php $value['name']?></a></li>
	<?php } ?>
		</ul>
	</div>
<?php } ?>

</div></div>


<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>