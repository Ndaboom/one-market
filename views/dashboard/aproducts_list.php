<?php 

    $title = "Liste des produits";

?>

<!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">One Market</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Liste</a></li>
                                            <li class="breadcrumb-item active">Produits</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Liste des produits</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row justify-content-between">
                                            <div class="col-auto">
                                                <form class="d-flex flex-wrap align-items-center">
                                                    <label for="inputPassword2" class="visually-hidden">Rechercher</label>
                                                    <div class="me-3">
                                                        <input type="search" class="form-control my-1 my-lg-0" id="inputPassword2" placeholder="Search...">
                                                    </div>
                                                    <label for="status-select" class="me-2">Trier par</label>
                                                    <div class="me-sm-3">
                                                        <select class="form-select my-1 my-lg-0 tri_products" id="status-select">
                                                            <option selected="" id="0">Tous</option>
                                                            <option value="1" id="1">Populaire</option>
                                                            <option value="2" id="2">Faible prix</option>
                                                            <option value="3" id="3">Prix élevé</option>
                                                            <option value="4" id="4">Solde</option>
                                                        </select>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-auto">
                                                <div class="text-lg-end my-1 my-lg-0">
                                                    <!-- <a href="dashboard/create_product" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-plus-circle me-1"></i> Ajouter nouveau</a> -->
                                                </div>
                                            </div><!-- end col-->
                                        </div> <!-- end row -->
                                    </div>
                                </div> <!-- end card -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->

                        <div class="row">
                            <?php foreach($products as $product): ?>
                                <?php $shop = find("products_tb", $product['id']); ?>
                            <div class="col-md-6 col-xl-3">
                                <div class="card product-box">
                                    <div class="card-body">
                                        <div class="product-action">
                                            <a href="dashboard/product?pr_i=<?= $product['id'] ?>" class="btn btn-success btn-xs waves-effect waves-light"> Voir</a>
                                            <a href="dashboard/edit_product?pr_i=<?= $product['id'] ?>" class="btn btn-danger btn-xs waves-effect waves-light"> Modifier</a>
                                        </div>
    
                                        <div class="bg-light">
                                            <img src="<?= $product['product_image'] ?>" alt="product-pic" class="img-fluid" />
                                        </div>
    
                                        <div class="product-info">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="font-16 mt-0 sp-line-1"><a href="dashboard/product?pr_i=<?= $product['id'] ?>" class="text-dark"><?=  $product['product_name'] ?></a> </h5>
                                                    <div class="text-warning mb-2 font-13">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <h5 class="m-0"> <span class="text-muted"> Stocks : <?= $product['product_quantity'] ?> pcs</span></h5>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="product-price-tag">
                                                        $ <?= $product['product_price']  ?>
                                                    </div>
                                                </div>
                                            </div> <!-- end row -->
                                        </div> <!-- end product info-->
                                    </div>
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <?php endforeach; ?>

                        </div>
                        <!-- end row-->

                        <div class="row">
                            <div class="col-12">
                                <ul class="pagination pagination-rounded justify-content-end mb-3">
                                    <li class="page-item">
                                        <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                            <span aria-hidden="true">«</span>
                                            <span class="visually-hidden">Previous</span>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="javascript: void(0);">1</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                            <span aria-hidden="true">»</span>
                                            <span class="visually-hidden">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> &copy; One Market 
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-end footer-links d-none d-sm-block">
                                    <a href="javascript:void(0);">About Us</a>
                                    <a href="javascript:void(0);">Help</a>
                                    <a href="javascript:void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->