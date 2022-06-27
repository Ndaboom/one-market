<?php
	$title = 'Se connecter';
?>

<body class="loading auth-fluid-pages pb-0">

<div class="auth-fluid">
    <!--Auth fluid left content -->
    <div class="auth-fluid-form-box">
        <div class="align-items-center d-flex h-100">
            <div class="card-body">
                <!-- Logo -->
                <div class="auth-brand text-center text-lg-start">
                    <div class="auth-logo">
                        <a href="" class="logo logo-dark text-center">
                            <span class="logo-lg">
                                <img src="assets/images/logo-dark.png" alt="" height="22">
                            </span>
                        </a>
    
                        <a href="" class="logo logo-light text-center">
                            <span class="logo-lg">
                                <img src="assets/images/logo-light.png" alt="" height="22">
                            </span>
                        </a>
                    </div>
                </div>

                <ul class="nav nav-tabs nav-bordered">
                    <li class="nav-item">
                        <a href="#tab-login" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                        Se connecter
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab-signup" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                        S'inscrire
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="tab-login">
                        <?php if(get_session('error')){
                         ?>
                            <div class="alert alert-danger" role="alert">
                                <i class="mdi mdi-block-helper me-2"></i><?= get_session('error') ?>
                            </div>
                         <?php  
                         unset($_SESSION['error']);
                        }?>
                        <p class="text-muted mb-3">Saisissez votre adresse e-mail et votre mot de passe pour accéder à votre compte.</p>
                        <!-- form -->
                        <form method="post" action="auth/sign_in_validation">
                            <div class="mb-3">
                                <label for="emailaddress" class="form-label">Adresse e-mail</label>
                                <input class="form-control" type="email" name="email" id="emailaddress" required="" placeholder="Entrez votre email">
                            </div>
                            <div class="mb-3">
                                <a href="auth-recoverpw-2.html" class="text-muted float-end"><small>Vous avez oublié votre mot de passe ?</small></a>
                                <label for="password" class="form-label">Mot de passe</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Entez votre mot de passe">
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-signin">
                                    <label class="form-check-label" for="checkbox-signin">Se souvenir de moi</label>
                                </div>
                            </div>
                            <div class="text-center d-grid">
                                <button class="btn btn-primary" type="submit">Se connecter </button>
                            </div>
                            <!-- social-->
                            <div class="text-center mt-4">
                                <p class="text-muted font-16">Se connecter avec</p>
                                <ul class="social-list list-inline mt-3">
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </form>
                        <!-- end form-->

                    </div>
                    <div class="tab-pane" id="tab-signup">
                    <?php if(get_session('r_error')){
                         ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="mdi mdi-block-helper me-2"></i><?= get_session('r_error') ?>
                        </div>
                        <?php  
                        unset($_SESSION['r_error']);
                    }?>
                        <p class="text-muted mb-3">Vous n'avez pas de compte ? Créez votre compte, cela prend moins d'une minute.</p>

                        <!-- form -->
                        <form method="post" action="auth/sign_up_validation">
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Nom Complet</label>
                                <input class="form-control" type="text" id="fullname" name="fullname" placeholder="Entrer votre nom complet" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">  
                                <div class="mb-3">
                                    <label for="telephone" class="form-label">Telephone</label>
                                    <input class="form-control" type="text" name="telephone" id="telephone" required="" placeholder="Entrer votre numero de telephone">
                                </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="birth_date" class="form-label">Date de naissance</label>
                                        <input type="date" id="birth_date" name="birth_date" class="form-control" placeholder="Entrer votre date de naissance" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="emailaddress" class="form-label">Addresse email</label>
                                <input class="form-control" type="email" id="emailaddress" name="emailadress" required placeholder="Entrer votre email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input class="form-control" type="password" required id="password" name="password" placeholder="Entrer votre mot de passe">
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-signup" required>
                                    <label class="form-check-label" for="checkbox-signup">J'accepte <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                                </div>
                            </div>
                            <div class="text-center d-grid">
                                <button class="btn btn-primary waves-effect waves-light" type="submit"> Suivant </button>
                            </div>
                            <!-- social-->
                            <div class="text-center mt-4">
                                <p class="text-muted font-16">S'inscrire avec</p>
                                <ul class="social-list list-inline mt-3 mb-0">
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </form>
                        <!-- end form-->
                    </div>
                </div>

                <footer class="footer footer-alt">
                    <p class="text-muted">2021 - <script>document.write(new Date().getFullYear())</script> &copy;  <a href="javascript: void(0);" class="text-muted">One Market</a> </p>
                </footer>

            </div> <!-- end .card-body -->
        </div> <!-- end .align-items-center.d-flex.h-100-->
    </div>
    <!-- end auth-fluid-form-box-->

    <!-- Auth fluid right content -->
    <div class="auth-fluid-right text-center">
        <div class="auth-user-testimonial">
            <h2 class="mb-3 text-white">Vous ne savez pas ou faire des courses?</h2>
            <p class="lead"><i class="mdi mdi-format-quote-open"></i> Voici pour vous une plateforme pour vous faciliter le choix du magasin ou supermarche ou faire vos courses. <i class="mdi mdi-format-quote-close"></i>
            </p>
        </div> <!-- end auth-user-testimonial-->
    </div>
    <!-- end Auth fluid right content -->
</div>
<!-- end auth-fluid-->

<!-- Vendor js -->
<script src="assets/js/vendor.min.js"></script>

<!-- App js -->
<script src="assets/js/app.min.js"></script>

</body>