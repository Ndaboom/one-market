<?php 
$title = "Créer une marque"
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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Marques</a></li>
                                        <li class="breadcrumb-item active">Ajouter</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Ajouter une marque</h4>
                            </div>
                        </div>
                    </div>     
                    <!-- end page title --> 

                    <div class="row">
                        <div class="col-12">
                        <?php if(!isset($_GET['m_i'])): ?>
                        <form method="post" action="dashboard/add_make_validation">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="mb-3">
                                                <label for="make_designation" class="form-label">Designation du model</label>
                                                <input type="text" id="make_designation" name="make_designation" class="form-control" placeholder="Designation" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Etat</label> <br/>
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" class="form-check-input" id="customSwitch1" name="status">
                                                    <label class="form-check-label" for="customSwitch1">Basculer cet interrupteur pour activer cette marque</label>
                                                </div>
                                            </div>
                                        </div> <!-- end col-->
                                    </div>
                                    <!-- end row -->
                                    <div class="row mt-3">
                                        <div class="col-12 text-center">
                                            <input type="submit" class="btn btn-success waves-effect waves-light m-1" name="add_sous_category" value="Ajouter"/>
                                            <button type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x me-1"></i> Annuler</button>
                                        </div>
                                    </div>
                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                        </form>
                        <?php else: ?>
                            <form method="post" action="dashboard/update_make_validation?m_i=<?= $model_details['id'] ?>">
                            <div class="card">
                                <div class="card-body">
                                <div class="row">
                                        <div class="col-xl-6">
                                            <div class="mb-3">
                                                <label for="make_designation" class="form-label">Designation de la marque</label>
                                                <input type="text" id="make_designation" name="make_designation" class="form-control" value="<?= $model_details['designation'] ?>" placeholder="Designation" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="status">Etat</label> <br/>
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" class="form-check-input" id="customSwitch1" name="status" <?= $model_details['state'] == 1 ? 'checked' : ''?>>
                                                    <label class="form-check-label" for="customSwitch1">Basculer cet interrupteur pour activer cette marque</label>
                                                </div>
                                            </div>
                                        </div> <!-- end col-->
                                    </div>
                                    <!-- end row -->
                                    <div class="row mt-3">
                                        <div class="col-12 text-center">
                                            <input type="submit" class="btn btn-success waves-effect waves-light m-1" name="update_make" value="Modifier"/>
                                            <button type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x me-1"></i> Annuler</button>
                                        </div>
                                    </div>
                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                        </form>
                        <?php endif; ?>
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
                            <script>document.write(new Date().getFullYear())</script> &copy; by <a href="#">One Market</a> 
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