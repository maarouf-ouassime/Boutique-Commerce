<?php
?>
<!DOCTYPE html>
<html>
	<head>
		<script src="js/jquery.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.6.22/css/uikit.min.css" integrity="sha512-dfbsuqWeCWwIEAtxRPRRHH0kwIR4+igihRwavxSQzrbidK+/SAQvODRxHzYCQ8IQfglfUCzIM5L1neEC4+lALQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

		<script src="js/bootstrap.min.js"></script>
		<style>
		.popover
		{
		    width: 100%;
		    max-width: 800px;
		}
		</style>
		
	</head>
	<body>
	<div id="root" align="center"></div>
		<div class="container" id="ro">
			<br />
			<br />
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Menu</span>
						<span class="glyphicon glyphicon-menu-hamburger"></span>
						</button>
						<a class="navbar-brand" href="/imp">boutique</a>
					</div>
					
					<div id="navbar-cart" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li>
								<a id="cart-popover" class="btn" data-placement="bottom" title="Shopping Cart">
									<span class="glyphicon glyphicon-shopping-cart"></span>
									<span class="badge"></span>
									<span class="total_price">$ 0.00</span>
								</a>
							</li>
						</ul>
					</div>
					<nav class="uk-navbar-container uk-margin-bottom" uk-navbar="mode: click">
        <div class="uk-navbar-right">
            <div>
                <ul class="uk-navbar-nav">
                <?php 
                if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
                ?>
                    <li>
                        <a href="#"><?=$_SESSION['username']?></a>
                        <div class="uk-navbar-dropdown">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li><a href="deconnexion.php">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                   
                <?php }else{?>
                    <li id='log'><a type="button" onclick="login()">Login</a></li>
                    <li id='sign'><a type="button" onclick="sign()">Sign in</a></li>
                <?php }?>
                </ul>
            </div>
        </div>

</nav>
					
				</div>
				
			</nav>
			<div id="popover_content_wrapper" style="display: none">
				<span id="cart_details"></span>
				<div align="right">
					<a href="#" class="btn btn-primary" id="check_out_cart">
					<span class="glyphicon glyphicon-shopping-cart"></span> valider la commande
					</a>
					<a href="#" class="btn btn-default" id="clear_cart">
					<span class="glyphicon glyphicon-trash"></span> supprimer.
					</a>
				</div>
			</div>

			<div id="display_item">


			</div>
			
			
		</div>
		<div style="margin-top :60px ;margin-bottom: 60px;text-align: center;"> <button class="page_su btn btn-primary " id="ba"> More</button> </div>
	</body>
</html>

<script>  
$(document).ready(function(){
	load_product();
	load_cart_data();
	function load_product()
	{
		$.ajax({
			url:"Affich_prod.php",
			method:"POST",
			data:{},
			success:function(data)
			{
				$('#display_item').html(data);
			}
		});
	}
	$(document).on('click', '.page_su', function(){
		$.ajax({
			url:"Affich_prod.php",
			method:"POST",
			data:{},
			success:function(data)
			{
				$('#display_item').html(data);
			}
		})
		});
	
	function load_cart_data()
	{
		$.ajax({
			url:"Panier.php",
			method:"POST",
			dataType:"json",
			success:function(data)
			{
				$('#cart_details').html(data.cart_details);
				$('.total_price').text(data.total_price);
				$('.badge').text(data.total_item);
			}
		});
	}
	$('#cart-popover').popover({
		html : true,
        container: 'body',
        content:function(){
        	return $('#popover_content_wrapper').html();
        }
	});
	$(document).on('click', '.add_to_cart', function(){
		var product_id = $(this).attr("id");
		var product_name = $('#name'+product_id+'').val();
		var product_price = $('#price'+product_id+'').val();
		var product_quantity = $('#quantity'+product_id).val();
		var action = "add";
		if(product_quantity > 0)
		{
			$.ajax({
				url:"ajouter.php",
				method:"POST",
				data:{product_id:product_id, product_name:product_name, product_price:product_price, product_quantity:product_quantity, action:action},
				success:function(data)
				{
					load_cart_data();
				}
			});
		}
		else
		{
			alert("entre la quantite ");
		}
	});
	$(document).on('click', '#clear_cart', function(){
		var ajouter = 'empty';
		$.ajax({
			url:"ajouter.php",
			method:"POST",
			data:{ajouter:ajouter},
			success:function()
			{
				load_cart_data();
				$('#cart-popover').popover('hide');
				alert("votre panier est videe");
			}
		});
	});
});
</script>
