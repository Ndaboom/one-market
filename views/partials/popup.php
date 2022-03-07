<div class="popup-newsletter">
    <div class="container">
        <div class="row">
            <div class="col-sm-2">	
            </div>
            <div class="col-sm-8">
                <div class="popup">
                    <span></span>
                    <div class="popup-text">
                        <h2>Inscrivez-vous à notre newsletter et<br />bénéficiez de réductions!</h2>
                        <p class="subscribe">Inscrivez-vous à la newsletter pour recevoir des informations sur les nouveaux produits.</p>
                        <div class="form-popup">
                            <form action="#" class="subscribe-form" method="get" accept-charset="utf-8">
                                <div class="subscribe-content">
                                    <input type="text" name="email" class="subscribe-email" placeholder="Votre E-Mail">
                                    <button type="submit"><img src="assets/landing/images/icons/right-2.png" alt=""></button>
                                </div>
                            </form><!-- /.subscribe-form -->
                            <div class="checkbox">
                                <input type="checkbox" id="popup-not-show" onclick="set_popup_to_false()" name="category">
                                <label for="popup-not-show">Ne plus montrer cette popup</label>
                            </div>
                        </div><!-- /.form-popup -->
                    </div><!-- /.popup-text -->
                    <div class="popup-image">
                        <img src="assets/landing/images/banner_boxes/popup.png" alt="">
                    </div><!-- /.popup-text -->
                </div><!-- /.popup -->
            </div><!-- /.col-sm-8 -->
            <div class="col-sm-2">
                
            </div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.popup-newsletter -->

<script>
    function set_popup_to_false(){
			$.ajax({
				url:"home/set_popup_to_false",
				method:"POST",
				success:function(){
				// alert("Success");
				}
			})
		}
</script>