<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->

<head>
	<!-- Basic Page Needs -->
	<meta charset="UTF-8">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<title>One Market </title>
	<meta name="author" content="CreativeLayers">
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<base href="<?= $base ?>"/>
	<!-- Boostrap style -->
	<link rel="stylesheet" type="text/css" href="assets/landing/stylesheets/bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" type="text/css" href="assets/landing/stylesheets/style.css">
	<!-- Reponsive -->
	<link rel="stylesheet" type="text/css" href="assets/landing/stylesheets/responsive.css">
	<link rel="shortcut icon" href="assets/landing/favicon/favicon.png">
	<style>
		#mainnav {
		padding-left: 30px;
		float: right;
		}
	</style>
</head>
	<?= $content  ?>
	<script>
		
		// $.getJSON('https://api.ipgeolocation.io/ipgeo?apiKey=' + apiKey, function(data) {
		// 	console.log(JSON.stringify(data, null, 2));
		// 	fetch_client_cart(data.ip);
		// });

		$(document).on('click','.btn-add-cart', function(e){
			e.preventDefault();
			let user_ip = '';
			let product_id = $(this).data('product_id');
			let product_name = '';
			//Get client ip
			let apiKey = 'b0a1516e3569484aad283b6a51608633';
			$.getJSON('https://api.ipgeolocation.io/ipgeo?apiKey=' + apiKey, function(data) {
			console.log(JSON.stringify(data, null, 2));
			user_ip = data.ip;

			$.ajax({
            url:"home/add_product_ajax",
            method:"POST",
			data:{user_ip:user_ip,product_id:product_id},
            success:function(data){
				alert('Produit ajouté');
				fetch_client_cart(user_ip);
            }
          	})
			});
		});

		//Remove product from cart
		$(document).on('click','.remove_from_cart', function(e){
			e.preventDefault();
			let user_ip = '';
			let order_id = $(this).data('order_id');
			//Get client ip
			let apiKey = 'b0a1516e3569484aad283b6a51608633';
			$.getJSON('https://api.ipgeolocation.io/ipgeo?apiKey=' + apiKey, function(data) {
			console.log(JSON.stringify(data, null, 2));
			user_ip = data.ip;

			$.ajax({
            url:"home/remove_product_ajax",
            method:"POST",
			data:{order_id:order_id},
            success:function(data){
				fetch_client_cart(user_ip);
            }
          	})
			});
		});

		//Client cart
		function fetch_client_cart(client_ip){
			$.ajax({
            url:"home/fetch_cart_ajax",
            method:"POST",
			data:{client_ip:client_ip},
            success:function(data){
              $('#cart_box').html(data);
            }
          	})
		}
	</script>
</html>