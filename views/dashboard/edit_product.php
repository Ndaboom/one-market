<?php 

    $title = "Modifier un produit"

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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Produit</a></li>
                                            <li class="breadcrumb-item active">Modifier produit</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Modifier <a href="dashboard/product?pr_i=<?= $product['id'] ?>"><?= $product['product_name'] ?></a> </h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                    <form method="post" enctype="multipart/form-data" action="dashboard/edit_product_validation?pr_i=<?= $product['id'] ?>">
                                        <div class="row">
                                            <div class="col-xl-6">

                                                <div class="mb-3">
                                                    <label class="form-label">Nom du produit</label> <br/>
                                                    <input type="text" id="product_name" name="product_name" value="<?= $product['product_name'] ?>" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Petite description</label> <br/>
                                                    <textarea class="form-control" name="product_description"><?= $product['product_description'] ?></textarea>
                                                </div>
                                                <div class="mb-3">
                                                        <label class="form-label">Quantité en stock</label>
                                                        <input type="number" id="product_quantity" value="<?= $product['product_quantity'] ?>" name="product_quantity" class="form-control" placeholder="Quantité en stock" required>
                                                </div>
                                                
                                            </div> <!-- end col-->

                                            <div class="col-xl-6">
                                                    <!-- form View -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Selectionnez une categorie</label>
                                                        <select id="product_category" class="form-control" name="product_category" required>
                                                        <?php foreach($categories as $category): ?>
                                                            <option value="<?= $category['id'] ?>" <?= $product['product_category'] == $category['id'] ? "selected" : "" ?> ><?= $category['designation'] ?></option>
                                                        <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="product-price" class="form-label">Prix du produit</label>
                                                            <input type="number" id="product_price" value="<?= $product['product_price'] ?>" name="product_price" class="form-control" placeholder="Prix du produit" required>
                                                        </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="product_image" class="form-label">Image du produit</label>
                                                            <input type="file" id="product_image" name="image" class="form-control" placeholder="Image du produit">
                                                        </div>
                                                        </div>
                                                    </div>   
                                            </div> <!-- end col-->
                                        </div>
                                        <!-- end row -->
                                        <div class="row mt-3">
                                            <div class="col-12 text-center">
                                                <input type="submit" class="btn btn-success waves-effect waves-light m-1" name="edit_product" value="Enregistrer"/>
                                                <a type="button" class="btn btn-light waves-effect waves-light m-1" href="dashboard/home"><i class="fe-x me-1"></i> Annuler</a>
                                            </div>
                                        </div>
                                    </form>
                                    </div> <!-- end card-body -->
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
                                <script>document.write(new Date().getFullYear())</script> &copy;<a href="#">One market</a> 
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