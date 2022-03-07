<?php 

    $title = "Créer un produit"

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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Projects</a></li>
                                            <li class="breadcrumb-item active">Créer un produit</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Créer un produit</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                    <form method="post" enctype="multipart/form-data" action="dashboard/add_product">
                                        <div class="row">
                                            <div class="col-xl-6">

                                                <div class="mb-3">
                                                    <label class="form-label">Nom du produit</label> <br/>
                                                    <input type="text" id="product_name" name="product_name" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Petite description</label> <br/>
                                                    <textarea class="form-control" name="product_description"></textarea>
                                                </div>
                                                <div class="mb-3">
                                                        <label class="form-label">Quantité en stock</label>
                                                        <input type="number" id="product_quantity" name="product_quantity" class="form-control" placeholder="Quantité en stock" required>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="product_color" class="form-label">Couleur du produit</label>
                                                        <select id="product_color" class="form-control" name="product_color" required>
                                                        <?php if(count($colors) != 0): ?>
                                                        <?php foreach($colors as $color): ?>
                                                        <option value="<?= $color['id'] ?>"><?= $color['designation'] ?></option>
                                                        <?php endforeach; ?>
                                                        <?php else: ?>
                                                        <option>Aucune couleur</option>
                                                        <?php endif; ?>
                                                    </select>
                                                    </div>
                                                    </div>
                                                </div>  
                                            </div> <!-- end col-->

                                            <div class="col-xl-6">
                                                    <!-- form View -->
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                        <div class="mb-3">
                                                        <label class="form-label">Selectionnez une categorie</label>
                                                        <select id="product_category" class="form-control" name="product_category" required>
                                                            <?php if(count($product_categories) != 0): ?>
                                                            <?php foreach($product_categories as $categorie): ?>
                                                            <option id="<?= $categorie['id'] ?>" value="<?= $categorie['id'] ?>"><?= $categorie['designation'] ?></option>
                                                            <?php endforeach; ?>
                                                            <?php else: ?>
                                                            <option>Aucune categorie</option>
                                                            <?php endif; ?>
                                                        </select>
                                                        </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                        <div class="mb-3">
                                                        <label class="form-label">Selectionnez une sous-categorie</label>
                                                        <select id="product_sous_category" class="form-control" name="product_sous_category" required>
                                                            <?php if(count($sous_categories) != 0): ?>
                                                            <?php foreach($sous_categories as $sous_categorie): ?>
                                                            <option value="<?= $sous_categorie['id'] ?>"><?= $sous_categorie['designation'] ?></option>
                                                            <?php endforeach; ?>
                                                            <?php else: ?>
                                                            <option>Aucune sous categorie</option>
                                                            <?php endif; ?>
                                                        </select>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="product-price" class="form-label">Prix du produit</label>
                                                            <input type="number" id="product_price" name="product_price" class="form-control" placeholder="Prix du produit" required>
                                                        </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="product_image" class="form-label">Image du produit</label>
                                                            <input type="file" id="product_image" name="image" class="form-control" placeholder="Image du produit">
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="product_model" class="form-label">Model du produit</label>
                                                            <input type="text" id="product_model" name="product_model" class="form-control" placeholder="Model du produit" required>
                                                        </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="product_make" class="form-label">Marque du produit</label>
                                                            <input type="text" id="product_make" name="product_make" class="form-control" placeholder="Marque du produit">
                                                        </div>
                                                        </div>
                                                    </div>    
                                            </div> <!-- end col-->
                                        </div>
                                        <!-- end row -->


                                        <div class="row mt-3">
                                            <div class="col-12 text-center">
                                                <input type="submit" class="btn btn-success waves-effect waves-light m-1" name="add_product" value="Enregistrer"/>
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