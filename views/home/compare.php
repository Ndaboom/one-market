<body class="header_sticky">
	<div class="boxed">

		<div class="overlay"></div>

		<?php 
		if(!isset($_SESSION['news_popup'])){
			include('views/partials/popup.php'); 
		}
		?>

		<?php include('views/partials/header.php'); ?>

		<section class="flat-breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumbs">
							<li class="trail-item">
								<a href="home/home" title="">Accueil</a>
								<span><img src="images/icons/arrow-right.png" alt=""></span>
							</li>
							<li class="trail-item">
								<a href="home/shop" title="">Shop</a>
								<span><img src="images/icons/arrow-right.png" alt=""></span>
							</li>
							<li class="trail-end">
								<a href="#" title=""><?= $current_product['product_name'] ?></a>
							</li>
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->

		<section class="flat-compare">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="wrap-compare">
							<div class="title">
								<h3>Comparer</h3>
							</div>
							<div class="compare-content">
								<table class="table-compare">
									<thead>
										<tr>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th>Produits similaires</th>
											<?php if(count($similar_products) != 0): ?>
											<?php foreach($similar_products as $row): ?>
											<td class="product">
												<div class="image">
													<img src="<?= $row['product_image'] ?>" alt="">
												</div>
												<div class="name">
													<?= $row['product_name'] ?> <br /><?= $row['product_model'] ?>
												</div>
											</td><!-- /.product -->
											<?php endforeach; ?>
											<?php else: ?>
												<td class="product">
													<div class="name">
														Aucun projet similaire
													</div>
												</td>
											<?php endif; ?>
										</tr>
										<tr>
											<th>Prix</th>
											<?php if(count($similar_products) != 0): ?>
											<?php foreach($similar_products as $row): ?>
											<td class="price">
												<?= $row['product_price'] ?>
											</td>
											<?php endforeach; ?>
											<?php endif; ?>
										</tr>
										<!-- <tr>
											<th>Add to Cart</th>
											<td class="add-cart">
												<a href="#" title=""><img src="images/icons/add-cart.png" alt="">Add to Cart</a>
												
											</td>
											<td class="add-cart">
												<a href="#" title=""><img src="images/icons/add-cart.png" alt="">Add to Cart</a>
												
											</td>
											<td class="add-cart">
												<a href="#" title=""><img src="images/icons/add-cart.png" alt="">Add to Cart</a>
											</td>
										</tr> -->
										<tr>
											<th>Description</th>
											<?php if(count($similar_products) != 0): ?>
											<?php foreach($similar_products as $row): ?>
											<td class="description">
												<p>
													<?= $row['product_description'] ?>
												</p>
											</td>
											<?php endforeach; ?>
											<?php endif; ?>
											
										</tr>
										<tr>
											<th>Color</th>
											<td class="color">
												<p>
													Black
												</p>
											</td><!-- /.color -->
											<td class="color">
												<p>
													Red
												</p>
											</td><!-- /.color -->
											<td class="color">
												<p>
													Blue
												</p>
											</td><!-- /.color -->
										</tr>
										<tr>
											<th>Stock</th>
											<td class="stock">
												<p>
													In stock
												</p>
											</td><!-- /.stock -->
											<td class="stock">
												<p>
													In stock
												</p>
											</td><!-- /.stock -->
											<td class="stock">
												<p>
													In stock
												</p>
											</td><!-- /.stock -->
										</tr>
										<tr>
											<th>Delete</th>
											<td class="delete">
												<a href="#" title="">
													<img src="images/icons/delete.png" alt="">
												</a>
											</td><!-- /.delete -->
											<td class="delete">
												<a href="#" title="">
													<img src="images/icons/delete.png" alt="">
												</a>
											</td><!-- /.delete -->
											<td class="delete">
												<a href="#" title="">
													<img src="images/icons/delete.png" alt="">
												</a>
											</td><!-- /.delete -->
										</tr>
									</tbody>
								</table><!-- /.table-compare -->
							</div><!-- /.compare-content -->
						</div><!-- /.wrap-compare -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-compare -->

		<?php include('views/partials/main_footer.php'); ?>

</div><!-- /.boxed -->
<?php include('views/partials/footer.php'); ?>

</body>