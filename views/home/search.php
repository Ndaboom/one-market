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

		<main id="shop" class="style2">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="main-shop">
							<div class="wrap-imagebox">
								<div class="flat-row-title style4">
									<h3>Produits</h3>
									<span>
										Showing 1–15 of 20 results
									</span>
									<div class="clearfix"></div>
								</div><!-- /.flat-row-title style4 -->
								<div class="sort-product style1">
									<ul class="icons">
										<li>
											<img src="assets/landing/images/icons/list-1.png" alt="">
										</li>
										<li>
											<img src="assets/landing/images/icons/list-2.png" alt="">
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
												<?php if(count($makes) != 0): ?>
													<?php foreach($makes as $make): ?>
														<?php $by_maker = fetch_products_by_maker($make['id']); ?>
													<li class="check-box">
														<input type="checkbox" class="make_checked" id="checkbox<?= $make['id'] ?>" name="checkbox<?= $make['id'] ?>" data-make_id="<?= $make['id'] ?>">
														<label for="checkbox<?= $make['id'] ?>"><?= $make['designation'] ?> <span>(<?= count($by_maker) ?>)</span></label>
													</li>
													<?php endforeach; ?>
												<?php else: ?>
													<li class="check-box">
														<input type="checkbox" id="checkbox1" name="checkbox1">
														<label for="checkbox1">Aucune marque </span></label>
													</li>
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
														<input type="checkbox" data-color_id="<?= $color['id'] ?>" class="color_checked" id="check<?= $color['id'] ?>" name="check<?= $color['id'] ?>">
														<label for="check<?= $color['id'] ?>"><?= $color['designation'] ?><span>(<?= count($this_color) ?>)</span></label>
													</li>
													<?php endforeach; ?>
												<?php endif; ?>	
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
												<option value="" data-max="5">Afficher 5</option>
												<option value="" data-max="10">Afficher 10</option>
												<option value="" data-max="15">Afficher 15</option>
											</select>
										</div>
									</div><!-- /.sort -->
									<div class="clearfix"></div>
								</div><!-- /.sort-product style1 -->
								<div class="row" id="main_box">
                                    <?php foreach($main_products as $product): ?>
										<?php $product_category = fetch_category_by_id($product['product_category']); ?>
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
														<a href="#" title=""><?= $product_category['designation'] ?></a>
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
        <?php include('views/partials/main_footer.php'); ?>

	</div><!-- /.boxed -->

    <?php include('views/partials/footer.php'); ?>
		
</body>