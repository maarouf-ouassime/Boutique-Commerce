
<?php 
include_once 'database_connection.php';
$json = file_get_contents('./products.json');
$ini = json_decode($json,true);
foreach($ini as $row){
    $array=$row['category'];
        $insert = $connect->prepare('INSERT INTO products(REF,NAME,DESCRIPTION,PRICE,IMAGE)VALUES(?,?,?,?,?)');
        $insert->execute(array($row['sku'],$row['name'],$row['description'],$row['price'],$row['image']));
            $insertCat = $connect->prepare('INSERT INTO category (ID, NAME)VALUES (?,?)');
            $insertCat->execute(array($array[0]['id'],$array[0]['name']));
            $insertapp = $connect->prepare('INSERT INTO appartient (ID, REF)VALUES (?,?)');
            $insertapp->execute(array($array[0]['id'],$row['sku']));
        
}
?>
