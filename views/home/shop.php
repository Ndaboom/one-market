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
								<a href="#" title="">Accueil</a>
								<span><img src="images/icons/arrow-right.png" alt=""></span>
							</li>
							<li class="trail-item">
								<a href="#" title="">Rechercher</a>
								<span><img src="images/icons/arrow-right.png" alt=""></span>
							</li>
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->
		<main id="shop">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-lg-3">
						<div class="sidebar ">
							<div class="widget widget-categories">
								<div class="widget-title">
									<h3>Categories<span></span></h3>
								</div>
								<ul class="cat-list style1 widget-content">
                                <?php foreach($categories as $category): ?>
                                    <?php $products = fetch_products_by_category($category['id']); ?>
									<li>
										<span><?= $category['designation'] ?><i>(<?= count($products) ?>)</i></span>
										<ul class="cat-child">
                                        <?php foreach($products as $product): ?>
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
							<!-- <div class="widget widget-products">
								<div class="widget-title">
									<h3>Best Seller<span></span></h3>
								</div>
								<ul class="product-list widget-content">
									<li>
										<div class="img-product">
											<a href="#" title="">
												<img src="images/blog/14.jpg" alt="">
											</a>
										</div>
										<div class="info-product">
											<div class="name">
												<a href="#" title="">Razer RZ02-01071 <br/>500-R3M1</a>
											</div>
											<div class="queue">
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
											</div>
											<div class="price">
												<span class="sale">$50.00</span>
												<span class="regular">$2,999.00</span>
											</div>
										</div>
									</li>	
									<li>
										<div class="img-product">
											<a href="#" title="">
												<img src="images/blog/13.jpg" alt="">
											</a>
										</div>
										<div class="info-product">
											<div class="name">
												<a href="#" title="">Notebook Black Spire <br/>V Nitro VN7-591G</a>
											</div>
											<div class="queue">
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
											</div>
											<div class="price">
												<span class="sale">$24.00</span>
												<span class="regular">$2,999.00</span>
											</div>
										</div>
									</li>
									<li>
										
										<div class="img-product">
											<a href="#" title="">
												<img src="images/blog/12.jpg" alt="">
											</a>
										</div>
										<div class="info-product">
											<div class="name">
												<a href="#" title="">Apple iPad Mini <br/>G2356</a>
											</div>
											<div class="queue">
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
											</div>
											<div class="price">
												<span class="sale">$90.00</span>
												<span class="regular">$2,999.00</span>
											</div>
										</div>
									</li>	
								</ul>
							</div> -->
							<div class="widget widget-banner">
								<div class="banner-box">
									<div class="inner-box">
										<a href="#" title="">
											<img src="images/banner_boxes/06.png" alt="">
										</a>
									</div>
								</div>
							</div><!-- /.widget widget-banner -->
						</div><!-- /.sidebar -->
					</div><!-- /.col-md-4 col-lg-3 -->
					<div class="col-md-8 col-lg-9">
						<div class="main-shop">
							<div class="slider owl-carousel-16 style1">
								<div class="slider-item style9">
									<div class="item-text">
										<div class="header-item">
											<p>You can build the banner for other category</p>
											<h2 class="name">Shop Banner</h2>
										</div>
									</div>
									<div class="item-image">
										<img src="images/banner_boxes/07.png" alt="">
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
										<img src="images/banner_boxes/05.png" alt="">
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
										<img src="images/banner_boxes/07.png" alt="">
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
										<img src="images/banner_boxes/05.png" alt="">
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
										<img src="images/banner_boxes/07.png" alt="">
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
										<img src="images/banner_boxes/07.png" alt="">
									</div>
									<div class="clearfix"></div>
								</div><!-- /.slider-item style9 -->
							</div><!-- /.slider -->
							<div class="wrap-imagebox">
								<div class="flat-row-title style1">
									<h3>Operateurs/ Magasins</h3>
									<span>
										Showing 1–15 of 20 results
									</span>
									<div class="clearfix"></div>
								</div>
								<div class="sort-product">
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
									</div><!-- /.sort -->
									<div class="clearfix"></div>
								</div><!-- /.sort-product -->
								<div class="tab-product">
									<div class="sort-box">
                                        <?php foreach($operators as $operator): ?>
                                            <?php 
                                                    $country = find("countries", $operator['id']);
                                                    $state = find("states", $operator['operator_state']);
                                                    $city = find("cities", $operator['operator_city']);
                                                    $products = verify_existing_data("products_tb", "shop_id", $operator['id']);
                                            ?>
										<div class="product-box style3">
											<div class="imagebox style1 v3">
												<div class="box-image">
													<a href="home/search_by_category?o_i=<?= $operator['id'] ?>" title="">
														<img src="<?= $operator['operator_logo'] ?>" alt="">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="home/search_by_category?o_i=<?= $operator['id'] ?>" title=""><?= $country['name'] ?> / <?= $state['name'] ?> - <?= $city['name'] ?></a>
													</div>
													<div class="product-name">
														<a href="home/search_by_category?o_i=<?= $operator['id'] ?>" title=""><?= $operator['operator_name'] ?>"<br /><?= $operator['operator_category'] ?></a>
													</div>
													<div class="status">
														Articles : <?= count($products) ?>
													</div>
													<div class="info">
														<p>
                                                        <?= $operator['operator_description'] ?>
														</p>
													</div>
												</div><!-- /.box-content -->
												<div class="box-price">
													<div class="btn-add-cart">
														<a href="home/search_by_category?o_i=<?= $operator['id'] ?>" title="">
															<img src="assets/landing/images/icons/add-cart.png" alt="">Visiter
														</a>
													</div>
												</div><!-- /.box-price -->
											</div><!-- /.imagebox -->
										</div><!-- /.product-box -->
                                        <?php endforeach; ?>
										<div style="height: 9px;"></div>
									</div><!-- /.sort-box -->
								</div><!-- /.tab-product -->
							</div><!-- /.wrap-imagebox -->
							<div class="blog-pagination">
								<span>
									Showing 1–15 of 20 results
								</span>
								<ul class="flat-pagination style1">
									<li class="prev">
										<a href="#" title="">
											<img src="images/icons/left-1.png" alt="">Prev Page
										</a>
									</li>
									<li class="active">
										<a href="#" class="waves-effect" title="">01</a>
									</li>
									<li>
										<a href="#" class="waves-effect" title="">02</a>
									</li>
									<li class="">
										<a href="#" class="waves-effect" title="">03</a>
									</li>
									<li>
										<a href="#" class="waves-effect" title="">04</a>
									</li>
									<li class="next">
										<a href="#" title="">
											Next Page<img src="images/icons/right-1.png" alt="">
										</a>
									</li>
								</ul><!-- /.flat-pagination style1 -->
								<div class="clearfix"></div>
							</div><!-- /.blog-pagination -->
						</div><!-- /.main-shop -->
					</div><!-- /.col-md-8 col-lg-9 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</main><!-- /#shop -->


        <?php include('views/partials/main_footer.php'); ?>

	</div><!-- /.boxed -->

    <?php include('views/partials/footer.php'); ?>
		
</body>