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
		<section class="flat-product-detail">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="flexslider">
							<ul class="slides">
							    <li data-thumb="<?= $current_product['product_image'] ?>">
							      <a href='#' id="zoom" class='zoom'><img src="<?= $current_product['product_image'] ?>" alt='' width='400' height='300' /></a>
							      <span>NEW</span>
							    </li>
							    <li data-thumb="<?= $current_product['product_image'] ?>">
							      <a href='#' id="zoom1" class='zoom'><img src="<?= $current_product['product_image'] ?>" alt='' width='400' height='300' /></a>
							    </li>
							    <li data-thumb="<?= $current_product['product_image'] ?>">
							      <a href='#' id="zoom2" class='zoom'><img src="<?= $current_product['product_image'] ?>" alt='' width='400' height='300' /></a>
							      <span>NEW</span>
							    </li>
							</ul><!-- /.slides -->
						</div><!-- /.flexslider -->
					</div><!-- /.col-md-6 -->
					<div class="col-md-6">
						<div class="product-detail">
							<div class="header-detail">
								<h4 class="name"><?= $current_product['product_name'] ?></h4>
								<div class="category">
									<?= $product_category['designation'] ?>
								</div>
								<div class="reviewed">
									<div class="review">
										<div class="queue">
											<i class="fa fa-star" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
										</div>
										<div class="text">
											<span>3 avis</span>
											<span class="add-review">Ajouter votre avis</span>
										</div>
									</div><!-- /.review -->
									<div class="status-product">
                                        Disponibilité <span><?php $current_product['product_quantity'] > 0 ? 'En stock' : 'Stock épuisé'?></span>
									</div>
								</div><!-- /.reviewed -->
							</div><!-- /.header-detail -->
							<div class="content-detail">
								<div class="price">
									<div class="regular">
                                        $1,589.00
									</div>
									<div class="sale">
                                        <?= $current_product['product_price'] ?>
									</div>
								</div>
								<div class="info-text">
                                <?= $current_product['product_description'] ?>
								</div>
								<div class="product-id">
									SKU: <span class="id">FW511948218</span>
								</div>
							</div><!-- /.content-detail -->
							<div class="footer-detail">
								<div class="quanlity-box">
									<!-- <div class="colors">
										<select name="color">
											<option value="">Select Color</option>
											<option value="">Black</option>
											<option value="">Red</option>
											<option value="">White</option>
										</select>
									</div> -->
									<!-- <div class="quanlity">
										<span class="btn-down"></span>
										<input type="number" name="number" id="quantity" value="" min="1" max="100" placeholder="Quanlity">
										<span class="btn-up"></span>
									</div> -->
								</div><!-- /.quanlity-box -->
								<div class="box-cart style2">
									<!-- <div class="btn-add-cart">
										<a href="#" title=""><img src="assets/landing/images/icons/add-cart.png" alt="">Ajouter au panier </a>
									</div> -->
									<div class="compare-wishlist">
										<a href="home/compare?p_i=<?= $current_product['id'] ?>" class="compare" title=""><img src="assets/landing/images/icons/compare.png" alt="">Comparer</a>
										<!-- <a href="compare.html" class="wishlist" title=""><img src="assets/landing/images/icons/wishlist.png" alt="">Liste des souhaits</a> -->
									</div>
								</div><!-- /.box-cart -->
								<div class="social-single">
									<span>PARTAGER</span>
									<ul class="social-list style2">
										<li>
											<a href="#" title="">
												<i class="fa fa-facebook" aria-hidden="true"></i>
											</a>
										</li>
										<li>
											<a href="#" title="">
												<i class="fa fa-twitter" aria-hidden="true"></i>
											</a>
										</li>
										<li>
											<a href="#" title="">
												<i class="fa fa-instagram" aria-hidden="true"></i>
											</a>
										</li>
										<li>
											<a href="#" title="">
												<i class="fa fa-pinterest" aria-hidden="true"></i>
											</a>
										</li>
										<li>
											<a href="#" title="">
												<i class="fa fa-dribbble" aria-hidden="true"></i>
											</a>
										</li>
										<li>
											<a href="#" title="">
												<i class="fa fa-google" aria-hidden="true"></i>
											</a>
										</li>
									</ul><!-- /.social-list -->
								</div><!-- /.social-single -->
							</div><!-- /.footer-detail -->
						</div><!-- /.product-detail -->
					</div><!-- /.col-md-6 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-product-detail -->
		<section class="flat-compare">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="wrap-compare">
							<div class="title">
								<h3><?= $current_product['product_name'] ?> Comparé à d'autres articles</h3>
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
													<a href="home/product?p_i=<?= $row['id'] ?>"><img src="<?= $row['product_image'] ?>" alt=""></a>
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
											<th>Fourni par</th>
											<?php if(count($similar_products) != 0): ?>
											<?php foreach($similar_products as $row): ?>
											<?php 
											$operator = fetch_operator_details($row['shop_id']);
											?>
											<td class="delete">
												<?= $operator['operator_name'] ?>
											</td>
											<?php endforeach; ?>
											<?php endif; ?>
										</tr>
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