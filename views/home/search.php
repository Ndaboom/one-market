<body class="header_sticky">
	<div class="boxed">

		<div class="overlay"></div>

        <?php include('views/partials/popup.php'); ?>

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

		<main id="shop" class="style2">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="main-shop">
							<div class="wrap-imagebox">
								<div class="flat-row-title style4">
									<h3>Mobile & Tablet</h3>
									<span>
										Showing 1–15 of 20 results
									</span>
									<div class="clearfix"></div>
								</div><!-- /.flat-row-title style4 -->
								<div class="sort-product style1">
									<ul class="icons">
										<li>
											<img src="images/icons/list-1.png" alt="">
										</li>
										<li>
											<img src="images/icons/list-2.png" alt="">
										</li>
										<li class="filter waves-effect">
											Filtrer
										</li>
									</ul><!-- /.icons -->
									<div class="box-filter">	
										<div class="widget widget-categories">
											<div class="widget-title">
												<h3>Categories<span></span></h3>
											</div>
											<ul class="cat-list style1 widget-content">
                                                <?php if(count($categories) != 0): ?>
                                                    <?php foreach($categories as $category): ?>
                                                        <?php $products = fetch_products_by_category($category['id']); ?>
                                                    <li>
                                                        <span><?= $category['designation'] ?><i><?= count($products) ?></i></span>
                                                        <?php if(count($products) != 0): ?>
                                                        <ul class="cat-child">
                                                            <?php foreach($products as $product): ?>
                                                            <li>
                                                                <a href="home/product?p_i=<?= $product['id'] ?>" title=""><?= $product['product_name'] ?></a>
                                                            </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                        <?php endif; ?>
                                                    </li>
                                                     <?php endforeach; ?>
                                                <?php endif; ?>
											</ul><!-- /.cat-list -->
										</div><!-- /.widget-categories -->
										<div class="widget widget-brands">
											<div class="widget-title">
												<h3>Marques<span></span></h3>
											</div>
											<div class="widget-content">
												<form action="#" method="get" accept-charset="utf-8">
													<input type="text" name="marque" placeholder="Rechercher une marque">
												</form>
												<ul class="box-checkbox scroll">
													<li class="check-box">
														<input type="checkbox" id="checkbox1" name="checkbox1">
														<label for="checkbox1">Apple <span>(4)</span></label>
													</li>
													<li class="check-box">
														<input type="checkbox" id="checkbox2" name="checkbox2">
														<label for="checkbox2">Samsung <span>(2)</span></label>
													</li>
													<li class="check-box">
														<input type="checkbox" id="checkbox3" name="checkbox3">
														<label for="checkbox3">HTC <span>(2)</span></label>
													</li>
													<li class="check-box">
														<input type="checkbox" id="checkbox4" name="checkbox4">
														<label for="checkbox4">LG <span>(2)</span></label>
													</li>
													<li class="check-box">
														<input type="checkbox" id="checkbox5" name="checkbox5">
														<label for="checkbox5">Dell <span>(1)</span></label>
													</li>
													<li class="check-box">
														<input type="checkbox" id="checkbox6" name="checkbox6">
														<label for="checkbox6">Sony <span>(3)</span></label>
													</li>
													<li class="check-box">
														<input type="checkbox" id="checkbox7" name="checkbox7">
														<label for="checkbox7">Bphone <span>(4)</span></label>
													</li>
													<li class="check-box">
														<input type="checkbox" id="checkbox8" name="chebckox8">
														<label for="checkbox8">Oppo <span>(4)</span></label>
													</li>
												</ul>
											</div>
										</div><!-- /.widget widget-brands -->
										<div class="widget widget-color">
											<div class="widget-title">
												<h3>Couleur<span></span></h3>
												<div style="height: 2px"></div>
											</div>
											<div class="widget-content">
												<form action="#" method="get" accept-charset="utf-8">
													<input type="text" name="color" placeholder="Color Search">
												</form>
												<div style="height: 5px"></div>
												<ul class="box-checkbox scroll">
													<li class="check-box">
														<input type="checkbox" id="check1" name="check1">
														<label for="check1">Black <span>(4)</span></label>
													</li>
													<li class="check-box">
														<input type="checkbox" id="check2" name="check2">
														<label for="check2">Yellow <span>(2)</span></label>
													</li>
													<li class="check-box">
														<input type="checkbox" id="check3" name="check3">
														<label for="check3">White <span>(2)</span></label>
													</li>
													<li class="check-box">
														<input type="checkbox" id="check4" name="check4">
														<label for="check4">Blue <span>(2)</span></label>
													</li>
													<li class="check-box">
														<input type="checkbox" id="check5" name="check5">
														<label for="check5">Red <span>(1)</span></label>
													</li>
													<li class="check-box">
														<input type="checkbox" id="check6" name="check6">
														<label for="check6">Pink <span>(3)</span></label>
													</li>
													<li class="check-box">
														<input type="checkbox" id="check7" name="check7">
														<label for="check7">Green <span>(4)</span></label>
													</li>
													<li class="check-box">
														<input type="checkbox" id="check8" name="check8">
														<label for="check8">Gold <span>(4)</span></label>
													</li>
												</ul>
											</div>
										</div><!-- /.widget widget-color -->
									</div><!-- /.box-filter -->
									<div class="sort">
										<div class="popularity">
											<select name="popularity" id="tri1">
												<option>Selectionner tri</option>
												<option data-tri="highest_price" data-max="<?= isset($_GET['max']) ? $_GET['max'] : '12'?>">Plus cher au moins cher</option>
												<option data-tri="low_price" data-max="<?= isset($_GET['max']) ? $_GET['max'] : '12'?>">Moins cher au plus cher</option>
												<option data-tri="most_viewed" data-max="<?= isset($_GET['max']) ? $_GET['max'] : '12'?>">Plus vues</option>
											</select>
										</div>
										<div class="showed">
											<select name="showed" id="products_record">
												<option>Selectionner</option>
												<option value="" data-limit="5">Afficher 5</option>
												<option value="" data-limit="10">Afficher 10</option>
												<option value="" data-limit="15">Afficher 15</option>
											</select>
										</div>
									</div><!-- /.sort -->
									<div class="clearfix"></div>
								</div><!-- /.sort-product style1 -->
								<div class="row" id="main_box">
                                    <?php foreach($main_products as $product): ?>
									<div class="col-lg-3 col-md-4 col-sm-6">
										<div class="product-box">
											<div class="imagebox">
												<span class="item-new">NEW</span>
												<div class="box-image owl-carousel-1">
													<div class="image">
														<a href="#" title="">
															<img src="<?= $product['product_image'] ?>" alt="">
														</a>
													</div>
													<div class="image">
														<a href="#" title="">
															<img src="<?= $product['product_image'] ?>" alt="">
														</a>
													</div>
													<div class="image">
														<a href="#" title="">
															<img src="<?= $product['product_image'] ?>" alt="">
														</a>
													</div>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">Categorie</a>
													</div>
													<div class="product-name">
														<a href="#" title=""><?= $product['product_name'] ?><br /><?= $product['product_model'] ?></a>
													</div>
													<div class="price">
														<span class="sale">$<?= $product['product_price'] ?></span>
														<span class="regular">$</span>
													</div>
												</div><!-- /.box-content -->
												<div class="box-bottom">
													<!-- <div class="btn-add-cart">
														<a href="#" title="">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div> -->
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-bottom -->
											</div><!-- /.imagebox -->
										</div><!-- /.product-box -->
									</div><!-- /.col-lg-3 col-md-4 col-sm-6 -->
                                    <?php endforeach; ?>
								</div><!-- /.row -->
							</div><!-- /.wrap-imagebox -->
							<div class="blog-pagination style1">
								<span>
									Showing 1–15 of 20 results
								</span>
								<ul class="flat-pagination style1">
									<li class="prev">
										<a href="#" title="">
											<img src="images/icons/left-1.png" alt="">Prev Page
										</a>
									</li>
									<li>
										<a href="#" class="waves-effect" title="">01</a>
									</li>
									<li>
										<a href="#" class="waves-effect" title="">02</a>
									</li>
									<li class="active">
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
								</ul><!-- /.flat-pagination -->
								<div class="clearfix"></div>
							</div><!-- /.blog-pagination -->
						</div><!-- /.main-shop -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</main><!-- /#shop -->

		<section class="flat-row flat-highlights style1">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="flat-row-title">
							<h3>Bestsellers</h3>
						</div><!-- /.flat-row-title -->
						<ul class="product-list style1 v2">
							<li>
								<div class="img-product">
									<a href="#" title="">
										<img src="images/product/highlights/10.jpg" alt="">
									</a>
								</div>
								<div class="info-product">
									<div class="name">
										<a href="#" title="">Razer RZ02-01071500-R3M1</a>
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
								<div class="clearfix"></div>
							</li>
							<li>
								<div class="img-product">
									<a href="#" title="">
										<img src="images/product/highlights/9.jpg" alt="">
									</a>
								</div>
								<div class="info-product">
									<div class="name">
										<a href="#" title="">Apple iPad Mini G2356</a>
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
								<div class="clearfix"></div>
							</li>
							<li>
								<div class="img-product">
									<a href="#" title="">
										<img src="images/product/highlights/8.jpg" alt="">
									</a>
								</div>
								<div class="info-product">
									<div class="name">
										<a href="#" title="">Beats Pill + Portable Speaker</a>
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
								<div class="clearfix"></div>
							</li>
						</ul><!-- /.product-list style1 -->
					</div><!-- /.col-md-4 -->
					<div class="col-md-4">
						<div class="flat-row-title">
							<h3>Featured</h3>
						</div><!-- /.flat-row-title -->
						<ul class="product-list style1">
							<li>
								<div class="img-product">
									<a href="#" title="">
										<img src="images/product/highlights/3.jpg" alt="">
									</a>
								</div>
								<div class="info-product">
									<div class="name">
										<a href="#" title="">Razer RZ02-01071500-R3M1</a>
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
								<div class="clearfix"></div>
							</li>
							<li>
								<div class="img-product">
									<a href="#" title="">
										<img src="images/product/highlights/2.jpg" alt="">
									</a>
								</div>
								<div class="info-product">
									<div class="name">
										<a href="#" title="">Apple iPad Mini G2356</a>
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
								<div class="clearfix"></div>
							</li>
							<li>
								<div class="img-product">
									<a href="#" title="">
										<img src="images/product/highlights/1.jpg" alt="">
									</a>
								</div>
								<div class="info-product">
									<div class="name">
										<a href="#" title="">Beats Pill + Portable Speaker</a>
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
								<div class="clearfix"></div>
							</li>
						</ul><!-- /.product-list style1 -->
					</div><!-- /.col-md-4 -->
					<div class="col-md-4">
						<div class="flat-row-title">
							<h3>Hot Sale</h3>
						</div><!-- /.flat-row-title -->
						<ul class="product-list style1">
							<li>
								<div class="img-product">
									<a href="#" title="">
										<img src="images/product/highlights/19.jpg" alt="">
									</a>
								</div>
								<div class="info-product">
									<div class="name">
										<a href="#" title="">Razer RZ02-01071500-R3M1</a>
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
								<div class="clearfix"></div>
							</li>
							<li>
								<div class="img-product">
									<a href="#" title="">
										<img src="images/product/highlights/11.jpg" alt="">
									</a>
								</div>
								<div class="info-product">
									<div class="name">
										<a href="#" title="">Apple iPad Mini G2356</a>
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
								<div class="clearfix"></div>
							</li>
							<li>
								<div class="img-product">
									<a href="#" title="">
										<img src="images/product/highlights/20.jpg" alt="">
									</a>
								</div>
								<div class="info-product">
									<div class="name">
										<a href="#" title="">Beats Pill + Portable Speaker</a>
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
								<div class="clearfix"></div>
							</li>
						</ul><!-- /.product-list style1 -->
					</div><!-- /.col-md-4 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-highlights -->
        <?php include('views/partials/main_footer.php'); ?>

	</div><!-- /.boxed -->

    <?php include('views/partials/footer.php'); ?>
		
</body>