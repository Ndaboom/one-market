<section id="header" class="header">
			<div class="header-top">
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<ul class="flat-support">
								<li>
									<a href="#" title="">Support</a>
								</li>
								<li>
									<a href="#" title="">Boutique plus proches</a>
								</li>
								<!-- <li>
									<a href="#" title="">Suivre votre commande</a>
								</li> -->
							</ul><!-- /.flat-support -->
						</div><!-- /.col-md-4 -->
						<div class="col-md-4">
							<ul class="flat-infomation">
								<li class="phone">
									Appelez nous: <a href="tel:+243973886132" title="Phone number">+243973886132</a>
								</li>
							</ul><!-- /.flat-infomation -->
						</div><!-- /.col-md-4 -->
						<div class="col-md-4">
							<ul class="flat-unstyled">
								<li class="account">
									<a href="auth/sign_in" title="">Mon Compte<i class="fa fa-angle-down" aria-hidden="true"></i></a>
									<ul class="unstyled">
										<li>
											<a href="auth/sign_in" title="Se connecter">Se Connecter</a>
										</li>
										<li>
											<a href="#" title="">Liste De Souhaits</a>
										</li>
										<li>
											<a href="#" title="">Mon Panier</a>
										</li>
										<li>
											<a href="#" title="">Mon Compte</a>
										</li>
										<li>
											<a href="#" title="">Checkout</a>
										</li>
									</ul><!-- /.unstyled -->
								</li>
								<li>
									<a href="#" title="">USD<i class="fa fa-angle-down" aria-hidden="true"></i></a>
									<ul class="unstyled">
										<li>
											<a href="#" title="">Euro</a>
										</li>
										<li>
											<a href="#" title="">Dolar</a>
										</li>
									</ul><!-- /.unstyled -->
								</li>
								<li>
									<a href="#" title="">English<i class="fa fa-angle-down" aria-hidden="true"></i></a>
									<ul class="unstyled">
										<li>
											<a href="#" title="">Turkish</a>
										</li>
										<li>
											<a href="#" title="">English</a>
										</li>
										<li>
											<a href="#" title="">اللغة العربية</a>
										</li>
										<li>
											<a href="#" title="">Español</a>
										</li>
										<li>
											<a href="#" title="">Italiano</a>
										</li>
									</ul><!-- /.unstyled -->
								</li>
							</ul><!-- /.flat-unstyled -->
						</div><!-- /.col-md-4 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /.header-top -->
			<div class="header-middle">
				<div class="container">
					<div class="row">
						<div class="col-md-3">
							<div id="logo" class="logo">
								<a href="index.html" title="">
									<!-- <img src="assets/landing/images/logos/logo.png" alt=""> -->
								</a>
							</div><!-- /#logo -->
						</div><!-- /.col-md-3 -->
						<div class="col-md-6">
							<div class="top-search">
								<form action="home/search" method="post" class="form-search" accept-charset="utf-8">
									<div class="cat-wrap">
										<select name="category" class="selected_category">
											<option hidden value="">Toutes catégories</option>
										</select>
										<span><i class="fa fa-angle-down" aria-hidden="true"></i></span>
										<div class="all-categories">
											<?php foreach($operators as $operator): ?>
												<?php $categories = fetch_operator_categories($operator['id']); ?>
											<div class="cat-list-search">
												<div class="title">
													<?= $operator['operator_name'] ?>
												</div>
												<ul class="categories_list">
												<?php if(count($categories) != 0): ?>
													<?php foreach($categories as $category): ?>
													<li><?= $category['designation'] ?></li>
													<?php endforeach; ?>
												<?php else: ?>
													<li>Aucune categorie</li>
												<?php endif; ?>
												</ul>
											</div><!-- /.cat-list-search -->
											<?php endforeach; ?>
										</div><!-- /.all-categories -->
									</div><!-- /.cat-wrap -->
									<div class="box-search">
										<input type="text" name="search" class="main_search_box" placeholder="Rechercher ce que vous cherchez ?" autocomplete="off">
										<span class="btn-search">
											<button type="submit" class="waves-effect"><img src="assets/landing/images/icons/search.png" alt=""></button>
										</span>
										<div class="search-suggestions">
											<div class="box-suggestions">
												<div class="title">
													Suggestions de recherche <span id="search_keyword"></span>
												</div>
												<div id="search_result">

												</div>
												<ul>
												<?php if(count($top6products) != 0): ?>
													<?php foreach($top6products as $product): ?>
													<li>
														<div class="image">
															<img src="<?= $product['product_image'] ?>" alt="">
														</div>
														<div class="info-product">
															<div class="name">
																<a href="home/product?p_i=<?= $product['id'] ?>" title=""><?= $product['product_name'] ?></a>
															</div>
															<div class="price">
																<span class="sale">
																<?= $product['product_price'] ?> $
																</span>
															</div>
														</div>
													</li>
													<?php endforeach; ?>
												<?php else: ?>
													<li>Aucun produit en stock</li>	
												<?php endif; ?>
												</ul>
											</div><!-- /.box-suggestions -->
											<div class="box-cat">
												<div class="cat-list-search">
													<div class="title">
														Categories
													</div>
													<ul>
													<?php if(count($categories) != 0): ?>
														<?php foreach($categories as $category): ?>
														<li>
															<a href="home/search_by_category?category=<?= $category['designation'] ?>&c_i=<?= $category['id'] ?>"><?= $category['designation'] ?></a>
														</li>
														<?php endforeach; ?>
													<?php endif; ?>
													</ul>
												</div><!-- /.cat-list-search -->
											</div><!-- /.box-cat -->
										</div><!-- /.search-suggestions -->
									</div><!-- /.box-search -->
								</form><!-- /.form-search -->
							</div><!-- /.top-search -->
						</div><!-- /.col-md-6 -->
						<div class="col-md-3">
							<div class="box-cart">
								<div class="inner-box">
									<ul class="menu-compare-wishlist">
										<li class="compare">
											<a href="compare.html" title="">
												<img src="assets/landing/images/icons/compare.png" alt="">
											</a>
										</li>
										<li class="wishlist">
											<a href="wishlist.html" title="">
												<img src="assets/landing/images/icons/wishlist.png" alt="">
											</a>
										</li>
									</ul><!-- /.menu-compare-wishlist -->
								</div><!-- /.inner-box -->
								<div class="inner-box" id="cart_box">
									
								</div><!-- /.inner-box -->
							</div><!-- /.box-cart -->
						</div><!-- /.col-md-3 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /.header-middle -->
			<div class="header-bottom">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-2">
							<div id="mega-menu">
								<div class="btn-mega"><span></span>Toutes les categories</div>
								<ul class="menu">
									<li>
										<a href="#" title="" class="dropdown">
											<span class="menu-img">
												<img src="assets/landing/images/icons/menu/01.png" alt="">
											</span>
											<span class="menu-title">
												Laptops & Mac
											</span>
										</a>
										<div class="drop-menu">
											<div class="one-third">
												<div class="cat-title">
													Laptop And Mac
												</div>
												<ul>
													<li>
														<a href="#" title="">Networking & Internet Devices</a>
													</li>
													<li>
														<a href="#" title="">Laptops, Desktops & Monitors</a>
													</li>
													<li>
														<a href="#" title="">Hard Drives & Memory Cards</a>
													</li>
													<li>
														<a href="#" title="">Computer Accessories</a>
													</li>
													<li>
														<a href="#" title="">Software</a>
													</li>
												</ul>
												<div class="show">
													<a href="#" title="">Shop All</a>
												</div>
											</div>
											<div class="one-third">
												<div class="cat-title">
													Audio & Video
												</div>
												<ul>
													<li>
														<a href="#" title="">Headphones & Speakers</a>
													</li>
													<li>
														<a href="#" title="">Home Entertainment Systems</a>
													</li>
													<li>
														<a href="#" title="">MP3 & Media Players</a>
													</li>
													<li>
														<a href="#" title="">Software</a>
													</li>
												</ul>
												<div class="show">
													<a href="#" title="">Shop All</a>
												</div>
											</div>
											<div class="one-third">
												<ul class="banner">
													<li>
														<div class="banner-text">
															<div class="banner-title">
																Headphones
															</div>
															<div class="more-link">
																<a href="#" title="">Shop Now <img src="assets/landing/images/icons/right-2.png" alt=""></a>
															</div>
														</div>
														<div class="banner-img">
															<img src="assets/landing/images/banner_boxes/menu-01.png" alt="">
														</div>
														<div class="clearfix"></div>
													</li>
													<li>
														<div class="banner-text">
															<div class="banner-title">
																TV & Audio
															</div>
															<div class="more-link">
																<a href="#" title="">Shop Now <img src="assets/landing/images/icons/right-2.png" alt=""></a>
															</div>
														</div>
														<div class="banner-img">
															<img src="assets/landing/images/banner_boxes/menu-02.png" alt="">
														</div>
														<div class="clearfix"></div>
													</li>
													<li>
														<div class="banner-text">
															<div class="banner-title">
																Computers
															</div>
															<div class="more-link">
																<a href="#" title="">Shop Now <img src="assets/landing/images/icons/right-2.png" alt=""></a>
															</div>
														</div>
														<div class="banner-img">
															<img src="assets/landing/images/banner_boxes/menu-03.png" alt="">
														</div>
														<div class="clearfix"></div>
													</li>
												</ul>	
											</div>
										</div>
									</li>
									<li>
										<a href="#" title="" class="dropdown">
											<span class="menu-img">
												<img src="assets/landing/images/icons/menu/02.png" alt="">
											</span>
											<span class="menu-title">
												Mobile & Tablet
											</span>
										</a>
										<div class="drop-menu">
											<div class="one-third">
												<div class="cat-title">
													Laptop And Computer
												</div>
												<ul>
													<li>
														<a href="#" title="">Networking & Internet Devices</a>
													</li>
													<li>
														<a href="#" title="">Laptops, Desktops & Monitors</a>
													</li>
													<li>
														<a href="#" title="">Hard Drives & Memory Cards</a>
													</li>
													<li>
														<a href="#" title="">Printers & Ink</a>
													</li>
													<li>
														<a href="#" title="">Networking & Internet Devices</a>
													</li>
													<li>
														<a href="#" title="">Computer Accessories</a>
													</li>
													<li>
														<a href="#" title="">Software</a>
													</li>
												</ul>
												<div class="show">
													<a href="#" title="">Shop All</a>
												</div>
											</div>
											<div class="one-third">
												<div class="cat-title">
													Audio & Video
												</div>
												<ul>
													<li>
														<a href="#" title="">Headphones & Speakers</a>
													</li>
													<li>
														<a href="#" title="">Home Entertainment Systems</a>
													</li>
													<li>
														<a href="#" title="">MP3 & Media Players</a>
													</li>
												</ul>
												<div class="show">
													<a href="#" title="">Shop All</a>
												</div>
											</div>
											<div class="one-third">
												<ul class="banner">
													<li>
														<div class="banner-text">
															<div class="banner-title">
																Headphones
															</div>
															<div class="more-link">
																<a href="#" title="">Shop Now <img src="assets/landing/images/icons/right-2.png" alt=""></a>
															</div>
														</div>
														<div class="banner-img">
															<img src="assets/landing/images/banner_boxes/menu-01.png" alt="">
														</div>
														<div class="clearfix"></div>
													</li>
													<li>
														<div class="banner-text">
															<div class="banner-title">
																TV & Audio
															</div>
															<div class="more-link">
																<a href="#" title="">Shop Now <img src="assets/landing/images/icons/right-2.png" alt=""></a>
															</div>
														</div>
														<div class="banner-img">
															<img src="assets/landing/images/banner_boxes/menu-02.png" alt="">
														</div>
														<div class="clearfix"></div>
													</li>
													<li>
														<div class="banner-text">
															<div class="banner-title">
																Computers
															</div>
															<div class="more-link">
																<a href="#" title="">Shop Now <img src="assets/landing/images/icons/right-2.png" alt=""></a>
															</div>
														</div>
														<div class="banner-img">
															<img src="assets/landing/images/banner_boxes/menu-03.png" alt="">
														</div>
														<div class="clearfix"></div>
													</li>
												</ul>	
											</div>
										</div>
									</li>
									<li>
										<a href="#" title="" class="dropdown">
											<span class="menu-img">
												<img src="assets/landing/images/icons/menu/03.png" alt="">
											</span>
											<span class="menu-title">
												Home Devices
											</span>
										</a>
										<div class="drop-menu">
											<div class="one-third">
												<div class="cat-title">
													Home Devices
												</div>
												<ul>
													<li>
														<a href="#" title="">Internet Devices</a>
													</li>
													<li>
														<a href="#" title="">Desktops & Monitors</a>
													</li>
													<li>
														<a href="#" title="">Hard Drives & Memory Cards</a>
													</li>
													<li>
														<a href="#" title="">Networking</a>
													</li>
													<li>
														<a href="#" title="">Software</a>
													</li>
												</ul>
												<div class="show">
													<a href="#" title="">Shop All</a>
												</div>
											</div>
											<div class="one-third">
												<div class="cat-title">
													Audio
												</div>
												<ul>
													<li>
														<a href="#" title="">Home Entertainment Systems</a>
													</li>
													<li>
														<a href="#" title="">MP3 & Media Players</a>
													</li>
													<li>
														<a href="#" title="">Software</a>
													</li>
												</ul>
												<div class="show">
													<a href="#" title="">Shop All</a>
												</div>
											</div>
											<div class="one-third">
												<ul class="banner">
													<li>
														<div class="banner-text">
															<div class="banner-title">
																Headphones
															</div>
															<div class="more-link">
																<a href="#" title="">Shop Now <img src="assets/landing/images/icons/right-2.png" alt=""></a>
															</div>
														</div>
														<div class="banner-img">
															<img src="assets/landing/images/banner_boxes/menu-01.png" alt="">
														</div>
														<div class="clearfix"></div>
													</li>
													<li>
														<div class="banner-text">
															<div class="banner-title">
																TV & Audio
															</div>
															<div class="more-link">
																<a href="#" title="">Shop Now <img src="assets/landing/images/icons/right-2.png" alt=""></a>
															</div>
														</div>
														<div class="banner-img">
															<img src="assets/landing/images/banner_boxes/menu-02.png" alt="">
														</div>
														<div class="clearfix"></div>
													</li>
													<li>
														<div class="banner-text">
															<div class="banner-title">
																Computers
															</div>
															<div class="more-link">
																<a href="#" title="">Shop Now <img src="assets/landing/images/icons/right-2.png" alt=""></a>
															</div>
														</div>
														<div class="banner-img">
															<img src="assets/landing/images/banner_boxes/menu-03.png" alt="">
														</div>
														<div class="clearfix"></div>
													</li>
												</ul>	
											</div>
										</div>
									</li>
									<li>
										<a href="#" title="">
											<span class="menu-img">
												<img src="assets/landing/images/icons/menu/04.png" alt="">
											</span>
											<span class="menu-title">
												Software
											</span>
										</a>
									</li>
									<li>
										<a href="#" title="">
											<span class="menu-img">
												<img src="assets/landing/images/icons/menu/05.png" alt="">
											</span>
											<span class="menu-title">
												TV & Audio
											</span>
										</a>
									</li>
									<li>
										<a href="#" title="">
											<span class="menu-img">
												<img src="assets/landing/images/icons/menu/06.png" alt="">
											</span>
											<span class="menu-title">
												Sports & Fitness
											</span>
										</a>
									</li>
									<li>
										<a href="#" title="" class="dropdown">
											<span class="menu-img">
												<img src="assets/landing/images/icons/menu/07.png" alt="">
											</span>
											<span class="menu-title">
												Games & Toys
											</span>
										</a>
										<div class="drop-menu">
											<div class="one-third">
												<div class="cat-title">
													Games & Toys
												</div>
												<ul>
													<li>
														<a href="#" title="">Internet Devices</a>
													</li>
													<li>
														<a href="#" title="">Desktops & Monitors</a>
													</li>
													<li>
														<a href="#" title="">Hard Drives & Memory Cards</a>
													</li>
													<li>
														<a href="#" title="">Networking</a>
													</li>
													<li>
														<a href="#" title="">Software</a>
													</li>
												</ul>
												<div class="show">
													<a href="#" title="">Shop All</a>
												</div>
											</div>
											<div class="one-third">
												<div class="cat-title">
													Audio
												</div>
												<ul>
													<li>
														<a href="#" title="">Home Entertainment Systems</a>
													</li>
													<li>
														<a href="#" title="">MP3 & Media Players</a>
													</li>
													<li>
														<a href="#" title="">Software</a>
													</li>
												</ul>
												<div class="show">
													<a href="#" title="">Shop All</a>
												</div>
											</div>
											<div class="one-third">
												<ul class="banner">
													<li>
														<div class="banner-text">
															<div class="banner-title">
																Headphones
															</div>
															<div class="more-link">
																<a href="#" title="">Shop Now <img src="assets/landing/images/icons/right-2.png" alt=""></a>
															</div>
														</div>
														<div class="banner-img">
															<img src="assets/landing/images/banner_boxes/menu-01.png" alt="">
														</div>
														<div class="clearfix"></div>
													</li>
													<li>
														<div class="banner-text">
															<div class="banner-title">
																TV & Audio
															</div>
															<div class="more-link">
																<a href="#" title="">Shop Now <img src="assets/landing/images/icons/right-2.png" alt=""></a>
															</div>
														</div>
														<div class="banner-img">
															<img src="assets/landing/images/banner_boxes/menu-02.png" alt="">
														</div>
														<div class="clearfix"></div>
													</li>
													<li>
														<div class="banner-text">
															<div class="banner-title">
																Computers
															</div>
															<div class="more-link">
																<a href="#" title="">Shop Now <img src="assets/landing/images/icons/right-2.png" alt=""></a>
															</div>
														</div>
														<div class="banner-img">
															<img src="assets/landing/images/banner_boxes/menu-03.png" alt="">
														</div>
														<div class="clearfix"></div>
													</li>
												</ul>	
											</div>
										</div>
									</li>
									<li>
										<a href="#" title="">
											<span class="menu-img">
												<img src="assets/landing/images/icons/menu/08.png" alt="">
											</span>
											<span class="menu-title">
												Video Cameras
											</span>
										</a>
									</li>
									<li>
										<a href="#" title="" class="dropdown">
											<span class="menu-img">
												<img src="assets/landing/images/icons/menu/09.png" alt="">
											</span>
											<span class="menu-title">
												Accessories
											</span>
										</a>
										<div class="drop-menu">
											<div class="one-third">
												<div class="cat-title">
													Accessories
												</div>
												<ul>
													<li>
														<a href="#" title="">Internet Devices</a>
													</li>
													<li>
														<a href="#" title="">Desktops & Monitors</a>
													</li>
													<li>
														<a href="#" title="">Hard Drives & Memory Cards</a>
													</li>
													<li>
														<a href="#" title="">Networking</a>
													</li>
													<li>
														<a href="#" title="">Software</a>
													</li>
												</ul>
												<div class="show">
													<a href="#" title="">Shop All</a>
												</div>
											</div>
											<div class="one-third">
												<div class="cat-title">
													Audio
												</div>
												<ul>
													<li>
														<a href="#" title="">Home Entertainment Systems</a>
													</li>
													<li>
														<a href="#" title="">MP3 & Media Players</a>
													</li>
													<li>
														<a href="#" title="">Software</a>
													</li>
												</ul>
												<div class="show">
													<a href="#" title="">Shop All</a>
												</div>
											</div>
											<div class="one-third">
												<ul class="banner">
													<li>
														<div class="banner-text">
															<div class="banner-title">
																Headphones
															</div>
															<div class="more-link">
																<a href="#" title="">Shop Now <img src="assets/landing/images/icons/right-2.png" alt=""></a>
															</div>
														</div>
														<div class="banner-img">
															<img src="assets/landing/images/banner_boxes/menu-01.png" alt="">
														</div>
														<div class="clearfix"></div>
													</li>
													<li>
														<div class="banner-text">
															<div class="banner-title">
																TV & Audio
															</div>
															<div class="more-link">
																<a href="#" title="">Shop Now <img src="assets/landing/images/icons/right-2.png" alt=""></a>
															</div>
														</div>
														<div class="banner-img">
															<img src="assets/landing/images/banner_boxes/menu-02.png" alt="">
														</div>
														<div class="clearfix"></div>
													</li>
													<li>
														<div class="banner-text">
															<div class="banner-title">
																Computers
															</div>
															<div class="more-link">
																<a href="#" title="">Shop Now <img src="assets/landing/images/icons/right-2.png" alt=""></a>
															</div>
														</div>
														<div class="banner-img">
															<img src="assets/landing/images/banner_boxes/menu-03.png" alt="">
														</div>
														<div class="clearfix"></div>
													</li>
												</ul>	
											</div>
										</div>
									</li>
									<li>
										<a href="#" title="" class="dropdown">
											<span class="menu-img">
												<img src="assets/landing/images/icons/menu/10.png" alt="">
											</span>
											<span class="menu-title">
												Security
											</span>
										</a>
										<div class="drop-menu">
											<div class="one-third">
												<div class="cat-title">
													Security
												</div>
												<ul>
													<li>
														<a href="#" title="">Internet Devices</a>
													</li>
													<li>
														<a href="#" title="">Desktops & Monitors</a>
													</li>
													<li>
														<a href="#" title="">Hard Drives & Memory Cards</a>
													</li>
													<li>
														<a href="#" title="">Networking</a>
													</li>
													<li>
														<a href="#" title="">Software</a>
													</li>
												</ul>
												<div class="show">
													<a href="#" title="">Shop All</a>
												</div>
											</div>
											<div class="one-third">
												<div class="cat-title">
													Audio
												</div>
												<ul>
													<li>
														<a href="#" title="">Home Entertainment Systems</a>
													</li>
													<li>
														<a href="#" title="">MP3 & Media Players</a>
													</li>
													<li>
														<a href="#" title="">Software</a>
													</li>
													<li>
														<a href="#" title="">Hard Drives & Memory Cards</a>
													</li>
													<li>
														<a href="#" title="">Networking</a>
													</li>
												</ul>
												<div class="show">
													<a href="#" title="">Shop All</a>
												</div>
											</div>
											<div class="one-third">
												<ul class="banner">
													<li>
														<div class="banner-text">
															<div class="banner-title">
																Headphones
															</div>
															<div class="more-link">
																<a href="#" title="">Shop Now <img src="assets/landing/images/icons/right-2.png" alt=""></a>
															</div>
														</div>
														<div class="banner-img">
															<img src="assets/landing/images/banner_boxes/menu-01.png" alt="">
														</div>
														<div class="clearfix"></div>
													</li>
													<li>
														<div class="banner-text">
															<div class="banner-title">
																TV & Audio
															</div>
															<div class="more-link">
																<a href="#" title="">Shop Now <img src="assets/landing/images/icons/right-2.png" alt=""></a>
															</div>
														</div>
														<div class="banner-img">
															<img src="assets/landing/images/banner_boxes/menu-02.png" alt="">
														</div>
														<div class="clearfix"></div>
													</li>
													<li>
														<div class="banner-text">
															<div class="banner-title">
																Computers
															</div>
															<div class="more-link">
																<a href="#" title="">Shop Now <img src="assets/landing/images/icons/right-2.png" alt=""></a>
															</div>
														</div>
														<div class="banner-img">
															<img src="assets/landing/images/banner_boxes/menu-03.png" alt="">
														</div>
														<div class="clearfix"></div>
													</li>
												</ul>	
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div><!-- /.col-md-3 -->
						<div class="col-md-9 col-10">
							<div class="nav-wrap">
								<div id="mainnav" class="mainnav">
									<ul class="menu">
										<li class="column-1">
											<a href="home/home" title="Accueil">Accueil</a>
										</li><!-- /.column-1 -->
										<li class="column-1">
											<a href="home/shop" title="Shop">Shop</a>
										</li><!-- /.column-1 -->
										<li class="column-1">
											<a href="home/search" title="Shop">Rechercher</a>
										</li><!-- /.column-1 -->
										<li class="column-1">
											<a href="home/contact" title="Contact">Contact</a>
										</li><!-- /.column-1 -->
									</ul><!-- /.menu -->
								</div><!-- /.mainnav -->
							</div><!-- /.nav-wrap -->
							<div class="btn-menu">
	                            <span></span>
	                        </div><!-- //mobile menu button -->
						</div><!-- /.col-md-9 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /.header-bottom -->
		</section><!-- /#header -->