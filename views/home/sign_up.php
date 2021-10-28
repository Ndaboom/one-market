<?php
	$title = 'Ajouter propriétaire';
?>

				<form class="login100-form validate-form" id="signup-form" method="post">
					<span class="login100-form-title">
						Create An Account on Kiwanda
					</span>

					<div class="wrap-input100 validate-input" data-validate="FirstName is required">
						<input class="input100" required="required" type="text" name="firstname" placeholder="Firstname" <?= html_value_attr('firstname') ?>>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-pencil" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Phone Number is required">
						<input class="input100" required="required" type="text" name="lastname" placeholder="Lastname" <?= html_value_attr('lastname') ?>>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-pencil" aria-hidden="true"></i>
						</span>
                    </div>
                    
                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<?= isset($errors['email'])? '<div class="err">Email invalide ou est utilisé par une autre personne</div>': '' ?>
						<input class="input100" required="required" type="email" name="email" placeholder="Email" <?= html_value_attr('email') ?>>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid phone is required: 9700383838">
						<input class="input100" required="required" type="tel" name="phone" placeholder="Phone number" <?= html_value_attr('phone') ?>>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<?= isset($errors['username'])? '<div class="err">Ce nom d\'utilisateur est utilisé par un autre</div>': '' ?>
						<input class="input100" required="required" type="text" name="username" placeholder="Username" <?= html_value_attr('username') ?>>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<?= isset($errors['password'])? '<div class="err">Mot de passe trop faible</div>': '' ?>
						<input class="input100" required="required" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<?= get_msg_at('password_not_match') ?>
					
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" required="required" type="password" name="password-repeat" placeholder="Confirm Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" id= "btn-continue">
							Continue
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Already have an account ? 
						</span>
						<a class="txt2" href="home">
							login
						</a>
					</div>
				</form>
