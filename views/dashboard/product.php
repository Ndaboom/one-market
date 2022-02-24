<?php 
 $title = "".$product['product_name'];
?>

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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                            <li class="breadcrumb-item active"><?= $product['product_name'] ?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?= $product['product_name'] ?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-5">
    
                                                <div class="tab-content pt-0">
                                                    <div class="tab-pane active show" id="product-1-item">
                                                        <img src="<?= $product['product_image'] ?>" alt="" class="img-fluid mx-auto d-block rounded">
                                                    </div>
                                                    <div class="tab-pane" id="product-2-item">
                                                        <img src="../assets/images/products/product-10.jpg" alt="" class="img-fluid mx-auto d-block rounded">
                                                    </div>
                                                    <div class="tab-pane" id="product-3-item">
                                                        <img src="../assets/images/products/product-11.jpg" alt="" class="img-fluid mx-auto d-block rounded">
                                                    </div>
                                                    <div class="tab-pane" id="product-4-item">
                                                        <img src="../assets/images/products/product-12.jpg" alt="" class="img-fluid mx-auto d-block rounded">
                                                    </div>
                                                </div>
    
                                                <ul class="nav nav-pills nav-justified">
                                                    <li class="nav-item">
                                                        <a href="#product-1-item" data-bs-toggle="tab" aria-expanded="false" class="nav-link product-thumb active show">
                                                            <img src="<?= $product['product_image'] ?>" alt="" class="img-fluid mx-auto d-block rounded">
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#product-2-item" data-bs-toggle="tab" aria-expanded="true" class="nav-link product-thumb">
                                                            <img src="../assets/images/products/product-10.jpg" alt="" class="img-fluid mx-auto d-block rounded">
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#product-3-item" data-bs-toggle="tab" aria-expanded="false" class="nav-link product-thumb">
                                                            <img src="../assets/images/products/product-11.jpg" alt="" class="img-fluid mx-auto d-block rounded">
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#product-4-item" data-bs-toggle="tab" aria-expanded="false" class="nav-link product-thumb">
                                                            <img src="../assets/images/products/product-12.jpg" alt="" class="img-fluid mx-auto d-block rounded">
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div> <!-- end col -->
                                            <div class="col-lg-7">
                                                <div class="ps-xl-3 mt-3 mt-xl-0">
                                                    <h4 class="mb-3"><?= $product['product_name'] ?></h4>
                                                    <p class="text-muted float-start me-3">
                                                        <span class="mdi mdi-star text-warning"></span>
                                                        <span class="mdi mdi-star text-warning"></span>
                                                        <span class="mdi mdi-star text-warning"></span>
                                                        <span class="mdi mdi-star text-warning"></span>
                                                        <span class="mdi mdi-star"></span>
                                                    </p>
                                                    <h4 class="mb-4">Prix : <b>$<?= $product['product_price'] ?> USD</b></h4>
                                                    <h4><span class="badge bg-soft-success text-success mb-4">Instock</span></h4>
                                                    <p class="text-muted mb-4"><?= $product['product_description'] ?></p>
    
                                                    <div>
                                                        <button type="button" class="btn btn-danger me-2"><i class="mdi mdi-heart-outline"></i> Desactiver</button>
                                                        <a href="dashboard/edit_product?pr_i=<?= $product['id'] ?>" class="btn btn-success waves-effect waves-light">Modifier</a>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </div>
                                </div> <!-- end card-->
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
                                <script>document.write(new Date().getFullYear())</script> &copy; UBold theme by <a href="#">Coderthemes</a> 
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