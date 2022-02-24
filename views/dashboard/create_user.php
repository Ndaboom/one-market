<?php 

    $title = "Créer un utilisateur"

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
                                            <li class="breadcrumb-item active">Créer un utilisateur</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Créer un utilisateur</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                    <?php if(!isset($_GET['u_i'])): ?>
                                    <form method="post" action="dashboard/add_user">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="row">
                                                    <div class="col-lg-6">  
                                                        <div class="mb-3">
                                                            <label for="first_name" class="form-label">Prenom</label>
                                                            <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Entrez votre prenom" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="last_name" class="form-label">Nom de famille</label>
                                                            <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Entrez votre nom de famille" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                        <label for="telephone" class="form-label">Telephone</label>
                                                        <input type="text" class="form-control" name="phone_number" data-toggle="input-mask" data-mask-format="(000) 000-000-000" maxlength="14" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                        <label for="email"  class="form-label">Email</label>
                                                        <input type="email" id="email" name="email" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Localisation de l'operateur</label> <br/>
                                                    <select id="selectize-select" class="form-control country_selector" name="country" required>
                                                        <option data-display="Select">Pays</option>
                                                        <?php foreach($countries as $country): ?>
                                                        <option value="<?= $country['id'] ?>" id="<?= $country['id'] ?>" ><?= $country['name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                
                                            </div> <!-- end col-->

                                            <div class="col-xl-6">
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <!-- form View -->
                                                            <div class="mb-3">
                                                                <label class="form-label">Mot de passe</label>
                                                                <input type="password" id="password" name="password" class="form-control" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <!-- form View -->
                                                            <div class="mb-3">
                                                                <label class="form-label">Re-entrez le mot de passe</label>
                                                                <input type="password" id="repassword" name="repassword" class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div class="row">
                                                        <div class="col-lg-6">
                                                            <!-- form View -->
                                                            <div class="mb-3">
                                                                <label class="form-label">Province</label>
                                                                <select id="state_selector" class="form-control state_selector" name="state" required>
                                        
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <!-- form View -->
                                                            <div class="mb-3">
                                                                <label class="form-label">Ville</label>
                                                                <select id="city_selector" class="form-control city_selector" name="city" required>
                                                                
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="operator-adress" class="form-label">Adresse precise</label>
                                                        <input type="text" id="operator_adress" name="adress" class="form-control" placeholder="Entrez l'adresse precise">
                                                    </div>

                                                    <div class="mb-3">
                                                    <label class="form-label">Magasin</label> <br/>
                                                    <select id="selectize-select" class="form-control" name="shop_id" required>
                                                        <option data-display="Select">Selectionnez un magasin</option>
                                                        <?php foreach($shops as $row): ?>
                                                        <option value="<?= $row['id'] ?>" id="<?= $row['id'] ?>" ><?= $row['operator_name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                            </div> <!-- end col-->
                                        </div>
                                        <!-- end row -->


                                        <div class="row mt-3">
                                            <div class="col-12 text-center">
                                                <input type="submit" class="btn btn-success waves-effect waves-light m-1" name="add_user" value="Enregistrer"/>
                                                <a type="button" class="btn btn-light waves-effect waves-light m-1" href="dashboard/home"><i class="fe-x me-1"></i> Annuler</a>
                                            </div>
                                        </div>
                                    </form>
                                    <?php else: ?>
                                        <form method="post" action="dashboard/edit_user?u_i=<?= $_GET['u_i'] ?>">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="row">
                                                    <div class="col-lg-6">  
                                                        <div class="mb-3">
                                                            <label for="first_name" class="form-label">Prenom</label>
                                                            <input type="text" id="first_name" name="first_name" value="<?= get_input('first_name') ? get_input('first_name') : e($current_user['first_name'])?>" class="form-control" placeholder="Entrez votre prenom" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="last_name" class="form-label">Nom de famille</label>
                                                            <input type="text" id="last_name" name="last_name" value="<?= get_input('last_name') ? get_input('last_name') : e($current_user['last_name'])?>" class="form-control" placeholder="Entrez votre nom de famille" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                        <label for="telephone" class="form-label">Telephone</label>
                                                        <input type="text" class="form-control" name="phone_number" value="<?= get_input('phone_number') ? get_input('phone_number') : e($current_user['phone_number'])?>" data-toggle="input-mask" data-mask-format="(000) 000-000-000" maxlength="14" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                        <label for="email"  class="form-label">Email</label>
                                                        <input type="email" id="email" name="email" value="<?= get_input('email') ? get_input('email') : e($current_user['email'])?>" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Localisation de l'operateur</label> <br/>
                                                    <select id="selectize-select" class="form-control country_selector" name="country" required>
                                                        <option data-display="Select">Pays</option>
                                                        <?php foreach($countries as $country): ?>
                                                        <option value="<?= $country['id'] ?>" id="<?= $country['id'] ?>" <?= $country['id'] == $current_user['country'] ? "selected" : "" ?> ><?= $country['name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="row">
                                                        <div class="col-lg-6">
                                                            <!-- form View -->
                                                            <div class="mb-3">
                                                                <label class="form-label">Mot de passe</label>
                                                                <input type="password" id="password" name="password" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <!-- form View -->
                                                            <div class="mb-3">
                                                                <label class="form-label">Re-entrez le mot de passe</label>
                                                                <input type="password" id="repassword" name="repassword" class="form-control">
                                                            </div>
                                                        </div>
                                                </div>

                                                
                                            </div> <!-- end col-->

                                            <div class="col-xl-6">
                                                <div class="row">
                                                        <div class="col-lg-6">
                                                            <!-- form View -->
                                                            <div class="mb-3">
                                                                <label class="form-label">Province</label>
                                                                <select id="state_selector" class="form-control state_selector" name="state" required>
                                                                    <option data-display="Select">Province</option>
                                                                    <?php foreach($states as $state): ?>
                                                                    <option value="<?= $state['id'] ?>" id="<?= $state['id'] ?>" <?= $state['id'] == $current_user['state'] ? "selected" : "" ?> ><?= $state['name'] ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <!-- form View -->
                                                            <div class="mb-3">
                                                                <label class="form-label">Ville</label>
                                                                <select id="city_selector" class="form-control city_selector" name="city" required>
                                                                    <option data-display="Select">Ville</option>
                                                                    <?php foreach($cities as $city): ?>
                                                                    <option value="<?= $city['id'] ?>" id="<?= $city['id'] ?>" <?= $city['id'] == $current_user['city'] ? "selected" : "" ?> ><?= $city['name'] ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="operator-adress" class="form-label">Adresse precise</label>
                                                        <input type="text" id="operator_adress" name="adress" value="<?= get_input('adress') ? get_input('adress') : e($current_user['adress'])?>" class="form-control" placeholder="Entrez l'adresse precise">
                                                    </div>

                                                    <div class="mb-3">
                                                    <label class="form-label">Magasin</label> <br/>
                                                    <select id="selectize-select" class="form-control" name="shop_id" required>
                                                        <option data-display="Select">Selectionnez un magasin</option>
                                                        <?php foreach($shops as $row): ?>
                                                        <option value="<?= $row['id'] ?>" id="<?= $row['id'] ?>" <?= $row['id'] == $current_user['shop_id'] ? "selected" : "" ?> ><?= $row['operator_name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                            </div> <!-- end col-->
                                        </div>
                                        <!-- end row -->


                                        <div class="row mt-3">
                                            <div class="col-12 text-center">
                                                <input type="submit" class="btn btn-success waves-effect waves-light m-1" name="edit_user" value="Enregistrer"/>
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