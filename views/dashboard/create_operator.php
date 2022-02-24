<?php 

    $title = "Créer un opérateur"

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
                                            <li class="breadcrumb-item active">Créer un opérateur</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Créer un opérateur</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                    <?php if(!isset($operator)): ?>
                                    <form method="post" enctype="multipart/form-data" action="dashboard/add_operator">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label for="operator_name" class="form-label">Nom</label>
                                                    <input type="text" id="operatorname" name="operator_name" value="" class="form-control" placeholder="Entrez le nom de l'operateur" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="operator_description" class="form-label">Petite description</label>
                                                    <textarea class="form-control" id="operator_description" name="operator_description" rows="5" placeholder="Entrez quelques détails sur l'operateur'..." required></textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Localisation de l'operateur</label> <br/>
                                                    <select id="selectize-select" class="form-control country_selector" name="operator_country" required>
                                                        <option data-display="Select">Pays</option>
                                                        <?php foreach($countries as $country): ?>
                                                        <option value="<?= $country['id'] ?>" id="<?= $country['id'] ?>" ><?= $country['name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <!-- form View -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Province</label>
                                                            <select id="state_selector" class="form-control state_selector" name="operator_state" required>
                                    
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <!-- form View -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Ville</label>
                                                            <select id="city_selector" class="form-control city_selector" name="operator_city" required>
                                                            
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="operator-adress" class="form-label">Adresse precise</label>
                                                    <input type="text" id="operator_adress" name="operator_adress" class="form-control" placeholder="Entrez l'adresse precise">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Type operateur/ Magasin</label>
                                                    <select class="form-control" name="operator_category">
                                                        <option value="Magasin à prix unique" selected="selected">Magasin à prix unique</option>
                                                        <option value="Magasin d'usine" selected="selected">Magasin d'usine</option>
                                                        <option value="Magasin de bricolage">Magasin de bricolage</option>
                                                        <option value="Autres">Autres</option>
                                                    </select>
                                                </div>

                                            </div> <!-- end col-->

                                            <div class="col-xl-6">
                                                <div class="my-3 mt-xl-0">
                                                    <label for="projectname" class="mb-0 form-label">Logo</label>
                                                    <p class="text-muted font-14">Taille recommandée de la vignette 800x400 (px).</p>

                                                        <div class="fallback">
                                                            <input name="file" type="file"/>
                                                        </div>
                                                    
                                                </div>

                                            </div> <!-- end col-->
                                        </div>
                                        <!-- end row -->


                                        <div class="row mt-3">
                                            <div class="col-12 text-center">
                                                <input type="submit" class="btn btn-success waves-effect waves-light m-1" name="add_operator" value="Enregistrer"/>
                                                <a type="button" class="btn btn-light waves-effect waves-light m-1" href="dashboard/home"><i class="fe-x me-1"></i> Annuler</a>
                                            </div>
                                        </div>
                                    </form>
                                    <?php else: ?>
                                        <form method="post" enctype="multipart/form-data" action="dashboard/edit_operator?op_i=<?= $_GET['op_i'] ?>">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label for="operator_name" class="form-label">Nom</label>
                                                    <input type="text" id="operatorname" name="operator_name" value="<?= get_input('operator_name') ? get_input('operator_name') : e($operator['operator_name'])?>" class="form-control" placeholder="Entrez le nom de l'operateur" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="operator_description" class="form-label">Petite description</label>
                                                    <textarea class="form-control" id="operator_description" name="operator_description" rows="5" placeholder="Entrez quelques détails sur l'operateur'..." required><?= get_input('operator_description') ? get_input('operator_description') : e($operator['operator_description'])?></textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Localisation de l'operateur</label> <br/>
                                                    <select id="selectize-select" class="form-control country_selector" name="operator_country" required>
                                                        <option data-display="Select">Pays</option>
                                                        <?php foreach($countries as $country): ?>
                                                        <option value="<?= $country['id'] ?>" id="<?= $country['id'] ?>" <?= $country['id'] == $operator['operator_country'] ? "selected" : "" ?> ><?= $country['name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <!-- form View -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Province</label>
                                                            <select id="state_selector" class="form-control state_selector" name="operator_state" required>
                                                                <option data-display="Select">Province</option>
                                                                <?php foreach($states as $state): ?>
                                                                <option value="<?= $state['id'] ?>" id="<?= $state['id'] ?>" <?= $state['id'] == $operator['operator_state'] ? "selected" : "" ?> ><?= $state['name'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <!-- form View -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Ville</label>
                                                            <select id="city_selector" class="form-control city_selector" name="operator_city" required>
                                                                <option data-display="Select">Ville</option>
                                                                <?php foreach($cities as $city): ?>
                                                                <option value="<?= $city['id'] ?>" id="<?= $city['id'] ?>" <?= $city['id'] == $operator['operator_city'] ? "selected" : "" ?> ><?= $city['name'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="operator-adress" class="form-label">Adresse precise</label>
                                                    <input type="text" id="operator_adress" value="<?= get_input('operator_adress') ? get_input('operator_adress') : e($operator['operator_adress'])?>" name="operator_adress" class="form-control" placeholder="Entrez l'adresse precise">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Type operateur/ Magasin</label>
                                                    <select class="form-control" name="operator_category">
                                                        <option value="Magasin à prix unique" <?= $operator['operator_category'] == "Magasin à prix unique" ? "selected" : ""?>>Magasin à prix unique</option>
                                                        <option value="Magasin d'usine" <?= $operator['operator_category'] == "Magasin d'usine" ? "selected" : ""?>>Magasin d'usine</option>
                                                        <option value="Magasin de bricolage" <?= $operator['operator_category'] == "Magasin de bricolage" ? "selected" : ""?>>Magasin de bricolage</option>
                                                        <option value="Autres" <?= $operator['operator_category'] == "Autres" ? "selected" : ""?>>Autres</option>
                                                    </select>
                                                </div>

                                            </div> <!-- end col-->

                                            <div class="col-xl-6">
                                                <div class="my-3 mt-xl-0">
                                                    <label for="projectname" class="mb-0 form-label">Logo</label>
                                                    <p class="text-muted font-14">Taille recommandée de la vignette 800x400 (px).</p>

                                                        <div class="fallback">
                                                            <input name="file" type="file"/>
                                                        </div>
                                                    
                                                </div>

                                            </div> <!-- end col-->
                                        </div>
                                        <!-- end row -->


                                        <div class="row mt-3">
                                            <div class="col-12 text-center">
                                                <input type="submit" class="btn btn-success waves-effect waves-light m-1" name="edit_operator" value="Enregistrer"/>
                                                <a type="button" class="btn btn-light waves-effect waves-light m-1" href="dashboard/home"><i class="fe-x me-1"></i> Annuler</a>
                                            </div>
                                        </div>
                                    </form>
                                    <?php endif; ?>
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