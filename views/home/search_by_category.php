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
								<span><img src="assets/landing/images/icons/arrow-right.png" alt=""></span>
							</li>
							<li class="trail-item">
								<a href="home/shop" title="">Shop</a>
								<span><img src="assets/landing/images/icons/arrow-right.png" alt=""></span>
							</li>
							<li class="trail-end">
								<a href="#" title="">Smartphones</a>
							</li>
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->

		<main id="shop">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-4">
						<div class="sidebar ">
							<div class="widget widget-categories">
								<div class="widget-title">
									<h3>Categories<span></span></h3>
								</div>
								<ul class="cat-list style1 widget-content">
								<?php foreach($categories as $category): ?>
                                    <?php $products_by_categories = fetch_products_by_category($category['id']); ?>
									<li>
										<span><?= $category['designation'] ?><i>(<?= count($products_by_categories) ?>)</i></span>
										<ul class="cat-child">
                                        <?php foreach($products_by_categories as $product): ?>
                                            <li>
                                                <a href="home/product?p_i=<?= $product['id'] ?>" title=""><?= $product['product_name'] ?></a>
                                            </li>
                                        <?php endforeach; ?>
										</ul>
									</li>
                                <?php endforeach; ?>
								</ul><!-- /.cat-list -->
							</div><!-- /.widget-categories -->
							<div class="widget widget-brands">
								<div class="widget-title">
									<h3>Marques<span></span></h3>
								</div>
								<div class="widget-content">
									<form action="#" method="get" accept-charset="utf-8">
										<input type="text" name="brands" placeholder="Brands Search">
									</form>
									<ul class="box-checkbox scroll">
									<?php if(count($makes) != 0): ?>
                                            <?php foreach($makes as $make): ?>
                                                <?php $by_maker = fetch_products_by_maker($make['id']); ?>
										<li class="check-box">
											<input type="checkbox" class="make_checked" id="checkbox<?= $make['id'] ?>" name="checkbox<?= $make['id'] ?>" data-make_id="<?= $make['id'] ?>">
											<label for="checkbox1"><?= $make['designation'] ?> <span>(<?= count($by_maker) ?>)</span></label>
										</li>
                                            <?php endforeach; ?>
                                    <?php endif; ?>
									</ul>
								</div>
							</div><!-- /.widget widget-brands -->
							<div class="widget widget-color">
								<div class="widget-title">
									<h3>Couleurs<span></span></h3>
									<div style="height: 2px"></div>
								</div>
								<div class="widget-content">
									<form action="#" method="get" accept-charset="utf-8">
										<input type="text" name="color" placeholder="Color Search">
									</form>
									<div style="height: 5px"></div>
									<ul class="box-checkbox scroll">
									<?php if(count($colors) != 0): ?>
                                        <?php foreach($colors as $color): ?>
                                        <?php $this_color = fetch_products_by_color($color['id']); ?>
										<li class="check-box">
											<input type="checkbox" class="color_checked" id="check<?= $color['id'] ?>" name="check<?= $color['id'] ?>">
											<label for="check<?= $color['id'] ?>"><?= $color['designation'] ?> <span>(<?= count($this_color) ?>)</span></label>
										</li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
									</ul>
								</div>
							</div><!-- /.widget widget-color -->
							<div class="widget widget-products">
								<div class="widget-title">
									<h3>Plus vues<span></span></h3>
								</div>
								<ul class="product-list widget-content">
									<?php foreach($most_viewed as $row): ?>
										<?php $product_category = fetch_category_by_id($row['product_category']); ?>
									<li>
										<div class="img-product">
											<a href="home/product?p_i=<?= $row['id'] ?>" title="">
												<img src="<?= $row['product_image'] ?>" style="max-width:100px;" alt="">
											</a>
										</div>
										<div class="info-product">
											<div class="name">
												<a href="home/product?p_i=<?= $row['id'] ?>" title=""><?= $row['product_name'] ?> <br/><?= $product_category['designation'] ?></a>
											</div>
											<div class="queue">
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
											</div>
											<div class="price">
												<span class="sale">$<?= $row['product_price'] ?></span>
												<span class="regular">$2,999.00</span>
											</div>
										</div>
									</li>	
									<?php endforeach; ?>	
								</ul>
							</div><!-- /.widget widget-products -->
							<div class="widget widget-banner">
								<div class="banner-box">
									<div class="inner-box">
										<a href="#" title="">
											<img src="assets/landing/images/banner_boxes/06.png" alt="">
										</a>
									</div>
								</div>
							</div><!-- /.widget widget-banner -->
						</div><!-- /.sidebar -->
					</div><!-- /.col-lg-3 col-md-4 -->
					<div class="col-lg-9 col-md-8">
						<div class="main-shop">
							<div class="slider owl-carousel-16">
								<div class="slider-item style9">
									<div class="item-text">
										<div class="header-item">
											<p>You can build the banner for other category</p>
											<h2 class="name">Shop Banner</h2>
										</div>
									</div>
									<div class="item-image">
										<img src="assets/landing/images/banner_boxes/07.png" alt="">
									</div>
									<div class="clearfix"></div>
								</div><!-- /.slider-item style9 -->
								<div class="slider-item style9">
									<div class="item-text">
										<div class="header-item">
											<p>You can build the banner for other category</p>
											<h2 class="name">Shop Banner</h2>
										</div>
									</div>
									<div class="item-image">
										<img src="assets/landing/images/banner_boxes/07.png" alt="">
									</div>
									<div class="clearfix"></div>
								</div><!-- /.slider-item style9 -->
								
							</div><!-- /.slider -->
							<div class="wrap-imagebox">
								<div class="flat-row-title">
									<?php if(isset($_GET['o_i'])): ?>
									<h3><?= $operator['operator_name'] ?></h3>
									<?php endif; ?>
									<span>
										Showing 1–15 of 20 results
									</span>
									<div class="clearfix"></div>
								</div>
								<div class="sort-product">
									<ul class="icons">
										<li>
											<img src="assets/landing/images/icons/list-1.png" alt="">
										</li>
										<li>
											<img src="assets/landing/images/icons/list-2.png" alt="">
										</li>
									</ul>
									<div class="sort">
										<div class="popularity">
											<select name="popularity">
												<option value="">Sort by popularity</option>
												<option value="">Sort by popularity</option>
												<option value="">Sort by popularity</option>
												<option value="">Sort by popularity</option>
											</select>
										</div>
										<div class="showed">
											<select name="showed">
												<option value="">Show 15</option>
												<option value="">Show 15</option>
												<option value="">Show 15</option>
												<option value="">Show 15</option>
											</select>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="tab-product">
									<div class="row sort-box">
									<?php if(count($products) != 0): ?>
										<?php foreach($products as $product): ?>
										<div class="col-lg-4 col-sm-6">
											<div class="product-box">
												<div class="imagebox">
													<div class="box-image owl-carousel-1">
														<a href="home/product?p_i=<?= $product['id'] ?>" title="<?= $product['product_name'] ?>">
															<img src="<?= $product['product_image'] ?>" alt="">
														</a>
														<a href="home/product?p_i=<?= $product['id'] ?>" title="">
															<img src="<?= $product['product_image'] ?>" alt="">
														</a>
														<a href="home/product?p_i=<?= $product['id'] ?>" title="">
															<img src="<?= $product['product_image'] ?>" alt="">
														</a>
													</div><!-- /.box-image -->
													<div class="box-content">
														<div class="cat-name">
															<a href="#" title=""><?= $product['product_name'] ?></a>
														</div>
														<div class="product-name">
															<a href="#" title=""><?= $product['product_name'] ?></a>
														</div>
														<div class="price">
															<span class="sale"><?= $product['product_price'] ?></span>
															<span class="regular">$2,999.00</span>
														</div>
													</div><!-- /.box-content -->
													<div class="box-bottom">
														<!-- <div class="btn-add-cart">
															<a href="#" title="">
																<img src="assets/landing/assets/landing/images/icons/add-cart.png" alt="">Add to Cart
															</a>
														</div> -->
														<div class="compare-wishlist">
															<a href="#" class="compare" title="">
																<img src="assets/landing/images/icons/compare.png" alt="">Compare
															</a>
															<a href="#" class="wishlist" title="">
																<img src="assets/landing/images/icons/wishlist.png" alt="">Wishlist
															</a>
														</div>
													</div><!-- /.box-bottom -->
												</div><!-- /.imagebox -->
											</div>
										</div><!-- /.col-lg-4 col-sm-6 -->
										<?php endforeach; ?>
										<?php else: ?>
										<p>Aucun produit n'a cette categorie...</p>
										<?php endif; ?>
									
									</div>
									<div class="sort-box">
										<div class="product-box style3">
											<div class="imagebox style1 v3">
												<div class="box-image">
													<a href="#" title="">
														<img src="assets/landing/images/product/other/s02.jpg" alt="">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">Cameras</a>
													</div>
													<div class="product-name">
														<a href="#" title="">Apple iPad Air 2 32GB 9.7"<br />Tablet</a>
													</div>
													<div class="status">
														Availablity: In stock
													</div>
													<div class="info">
														<p>
															The iPhone 5c replaces the iPhone 5 in the Apple stable, inheriting its internals, like the A6 processor, 4" screen...
														</p>
													</div>
												</div><!-- /.box-content -->
												<div class="box-price">
													<div class="price">
														<span class="regular">$2,999.00</span>
														<span class="sale">$1,999.00</span>
													</div>
													<!-- <div class="btn-add-cart">
														<a href="#" title="">
															<img src="assets/landing/images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div> -->
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="assets/landing/images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="assets/landing/images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-price -->
											</div><!-- /.imagebox -->
										</div><!-- /.product-box -->
										<div class="product-box style3">
											<div class="imagebox style1 v3">
												<div class="box-image">
													<a href="#" title="">
														<img src="assets/landing/images/product/other/01-v3.jpg" alt="">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">Cameras</a>
													</div>
													<div class="product-name">
														<a href="#" title="">New X5C-1 2.4Ghz Gyro <br />RC Quadcopter Drone</a>
													</div>
													<div class="status">
														Availablity: In stock
													</div>
													<div class="info">
														<p>
															The iPhone 5c replaces the iPhone 5 in the Apple stable, inheriting its internals, like the A6 processor, 4" screen...
														</p>
													</div>
												</div><!-- /.box-content -->
												<div class="box-price">
													<div class="price">
														<span class="regular">$2,999.00</span>
														<span class="sale">$1,999.00</span>
													</div>
													<!-- <div class="btn-add-cart">
														<a href="#" title="">
															<img src="assets/landing/images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div> -->
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="assets/landing/images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="assets/landing/images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-price -->
											</div><!-- /.imagebox -->
										</div><!-- /.product-box -->
										<div class="product-box style3">
											<div class="imagebox style1 v3">
												<div class="box-image">
													<a href="#" title="">
														<img src="assets/landing/images/product/other/02-v3.jpg" alt="">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">Cameras</a>
													</div>
													<div class="product-name">
														<a href="#" title="">Apple İmac Z0SC4824<br />Retina</a>
													</div>
													<div class="status">
														Availablity: In stock
													</div>
													<div class="info">
														<p>
															The iPhone 5c replaces the iPhone 5 in the Apple stable, inheriting its internals, like the A6 processor, 4" screen...
														</p>
													</div>
												</div><!-- /.box-content -->
												<div class="box-price">
													<div class="price">
														<span class="regular">$2,999.00</span>
														<span class="sale">$1,999.00</span>
													</div>
													<!-- <div class="btn-add-cart">
														<a href="#" title="">
															<img src="assets/landing/images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div> -->
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="assets/landing/images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="assets/landing/images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-price -->
											</div><!-- /.imagebox -->
										</div><!-- /.product-box -->
										<div class="product-box style3">
											<div class="imagebox style1 v3">
												<div class="box-image">
													<a href="#" title="">
														<img src="assets/landing/images/product/other/03-v3.jpg" alt="">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">Cameras</a>
													</div>
													<div class="product-name">
														<a href="#" title="">New X5C-1 2.4Ghz Gyro <br />RC Quadcopter Drone</a>
													</div>
													<div class="status">
														Availablity: In stock
													</div>
													<div class="info">
														<p>
															The iPhone 5c replaces the iPhone 5 in the Apple stable, inheriting its internals, like the A6 processor, 4" screen...
														</p>
													</div>
												</div><!-- /.box-content -->
												<div class="box-price">
													<div class="price">
														<span class="regular">$2,999.00</span>
														<span class="sale">$1,999.00</span>
													</div>
													<!-- <div class="btn-add-cart">
														<a href="#" title="">
															<img src="assets/landing/images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div> -->
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="assets/landing/images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="assets/landing/images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-price -->
											</div><!-- /.imagebox -->
										</div><!-- /.product-box -->
										<div class="product-box style3">
											<div class="imagebox style1 v3">
												<div class="box-image">
													<a href="#" title="">
														<img src="assets/landing/images/product/other/04-v3.jpg" alt="">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">Cameras</a>
													</div>
													<div class="product-name">
														<a href="#" title="">Apple iPad Air 2 32GB 9.7"<br />Tablet</a>
													</div>
													<div class="status">
														Availablity: In stock
													</div>
													<div class="info">
														<p>
															The iPhone 5c replaces the iPhone 5 in the Apple stable, inheriting its internals, like the A6 processor, 4" screen...
														</p>
													</div>
												</div><!-- /.box-content -->
												<div class="box-price">
													<div class="price">
														<span class="regular">$2,999.00</span>
														<span class="sale">$1,999.00</span>
													</div>
													<!-- <div class="btn-add-cart">
														<a href="#" title="">
															<img src="assets/landing/images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div> -->
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="assets/landing/images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="assets/landing/images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-price -->
											</div><!-- /.imagebox -->
										</div><!-- /.product-box -->
										<div style="height: 9px;"></div>
									</div>
								</div>
							</div><!-- /.wrap-imagebox -->
							<div class="blog-pagination">
								<span>
									Showing 1–15 of 20 results
								</span>
								<ul class="flat-pagination style1">
									<li class="prev">
										<a href="#" title="">
											<img src="assets/landing/images/icons/left-1.png" alt="">Prev Page
										</a>
									</li>
									<li class="active">
										<a href="#" class="waves-effect" title="">01</a>
									</li>
									<li>
										<a href="#" class="waves-effect" title="">02</a>
									</li>
									<li>
										<a href="#" class="waves-effect" title="">03</a>
									</li>
									<li>
										<a href="#" class="waves-effect" title="">04</a>
									</li>
									<li class="next">
										<a href="#" title="">
											Next Page<img src="assets/landing/images/icons/right-1.png" alt="">
										</a>
									</li>
								</ul>
								<div class="clearfix"></div>
							</div><!-- /.blog-pagination -->
						</div><!-- /.main-shop -->
					</div><!-- /.col-lg-9 col-md-8 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</main><!-- /#shop -->

		<section class="flat-imagebox style4">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="flat-row-title">
							<h3>Recent Products</h3>
						</div>
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
				<div class="row">
					<div class="col-md-12">
						<div class="owl-carousel-3 style3">
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/09.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Apple iPad Mini<br />G2356</a>
									</div>
									<div class="price">
										<span class="sale">$50.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/10.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Apple iPad Mini<br />G2356</a>
									</div>
									<div class="price">
										<span class="sale">$600.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/11.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Beats Pill+ Portable<br />Speaker - (PRODUCT)RED</a>
									</div>
									<div class="price">
										<span class="sale">$1,023.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/12.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Apple iPad Mini<br />G2356</a>
									</div>
									<div class="price">
										<span class="sale">$1,489.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/13.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Beats EP On-Ear<br />Headphones - Blue</a>
									</div>
									<div class="price">
										<span class="sale">$1,749.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/09.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Apple iPad Mini<br />G2356</a>
									</div>
									<div class="price">
										<span class="sale">$50.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/10.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Apple iPad Mini<br />G2356</a>
									</div>
									<div class="price">
										<span class="sale">$600.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/11.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Beats Pill+ Portable<br />Speaker - (PRODUCT)RED</a>
									</div>
									<div class="price">
										<span class="sale">$1,023.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/12.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Apple iPad Mini<br />G2356</a>
									</div>
									<div class="price">
										<span class="sale">$1,489.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/13.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Beats EP On-Ear<br />Headphones - Blue</a>
									</div>
									<div class="price">
										<span class="sale">$1,749.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/09.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Apple iPad Mini<br />G2356</a>
									</div>
									<div class="price">
										<span class="sale">$50.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/10.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Apple iPad Mini<br />G2356</a>
									</div>
									<div class="price">
										<span class="sale">$600.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/11.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Beats Pill+ Portable<br />Speaker - (PRODUCT)RED</a>
									</div>
									<div class="price">
										<span class="sale">$1,023.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/12.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Apple iPad Mini<br />G2356</a>
									</div>
									<div class="price">
										<span class="sale">$1,489.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/13.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Beats EP On-Ear<br />Headphones - Blue</a>
									</div>
									<div class="price">
										<span class="sale">$1,749.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/09.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Apple iPad Mini<br />G2356</a>
									</div>
									<div class="price">
										<span class="sale">$50.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/10.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Apple iPad Mini<br />G2356</a>
									</div>
									<div class="price">
										<span class="sale">$600.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/11.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Beats Pill+ Portable<br />Speaker - (PRODUCT)RED</a>
									</div>
									<div class="price">
										<span class="sale">$1,023.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/12.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Apple iPad Mini<br />G2356</a>
									</div>
									<div class="price">
										<span class="sale">$1,489.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/13.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Beats EP On-Ear<br />Headphones - Blue</a>
									</div>
									<div class="price">
										<span class="sale">$1,749.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/09.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Apple iPad Mini<br />G2356</a>
									</div>
									<div class="price">
										<span class="sale">$50.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/10.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Apple iPad Mini<br />G2356</a>
									</div>
									<div class="price">
										<span class="sale">$600.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/11.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Beats Pill+ Portable<br />Speaker - (PRODUCT)RED</a>
									</div>
									<div class="price">
										<span class="sale">$1,023.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/12.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Apple iPad Mini<br />G2356</a>
									</div>
									<div class="price">
										<span class="sale">$1,489.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/13.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Beats EP On-Ear<br />Headphones - Blue</a>
									</div>
									<div class="price">
										<span class="sale">$1,749.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/09.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Apple iPad Mini<br />G2356</a>
									</div>
									<div class="price">
										<span class="sale">$50.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/10.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Apple iPad Mini<br />G2356</a>
									</div>
									<div class="price">
										<span class="sale">$600.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/11.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Beats Pill+ Portable<br />Speaker - (PRODUCT)RED</a>
									</div>
									<div class="price">
										<span class="sale">$1,023.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/12.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Apple iPad Mini<br />G2356</a>
									</div>
									<div class="price">
										<span class="sale">$1,489.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<div class="imagebox style4">
								<div class="box-image">
									<a href="#" title="">
										<img src="assets/landing/images/product/other/13.jpg" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Laptops</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Beats EP On-Ear<br />Headphones - Blue</a>
									</div>
									<div class="price">
										<span class="sale">$1,749.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
						</div><!-- /.owl-carousel-3 -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-imagebox style4 -->

		<?php include('views/partials/main_footer.php'); ?>

	</div><!-- /.boxed -->
    <?php include('views/partials/footer.php'); ?>
</body>