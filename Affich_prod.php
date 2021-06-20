<?php
include('database_connection.php');
$query = "SELECT * FROM products ORDER BY REF DESC LIMIT 50";
$statement = $connect->prepare($query);
if($statement->execute())
{
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '
		<div class="col-md-3" style="margin-top:12px;">  
            <div style="border:3px solid #333; background-color:#eec; border-radius:10%; padding:16px; height:500px;" align="center">
            	<img style="width: 110px;height: 120px;" src="'.$row["IMAGE"].'" class="img-responsive" /><br />
            	<h4 class="text-info">'.$row["NAME"].'</h4>
            	<h4 class="text-danger">$ '.$row["PRICE"] .'</h4>
            	<input type="text" name="quantity" id="quantity' . $row["REF"] .'" class="form-control" value="1" />
            	<input type="hidden" name="hidden_name" id="name'.$row["REF"].'" value="'.$row["NAME"].'" />
				<input type="hidden" name="hidden_price" id="price'.$row["REF"].'" value="'.$row["PRICE"].'" />
            	<input type="button" name="add_to_cart" id="'.$row["REF"].'" style="margin-top:2px;" class="btn btn-primary form-control add_to_cart" value="ajouter au panier " />
            </div>
        </div>
		';
	}
	echo $output;
}


?>