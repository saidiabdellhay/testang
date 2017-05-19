<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_REQUEST['methode'])){
		if($_REQUEST['methode'] == 'getCustomerType'){
			echo getCustomerType();
		}else if($_REQUEST['methode'] == 'getCustomerAgeRange'){
			echo getCustomerAgeRange();
		}else if($_REQUEST['methode'] == 'getCustomerVille'){
			echo getCustomerVille();
		}else if($_REQUEST['methode'] == 'getBabySex'){
			echo getBabySex();
		}else if($_REQUEST['methode'] == 'getClientDash'){
			echo getClientDash();
		}else if($_REQUEST['methode'] == 'getBabyDash'){
			echo getBabyDash();
		}else if($_REQUEST['methode'] == 'getAllClient'){
			echo getAllClient();
		}else if($_REQUEST['methode'] == 'getClient'){
			echo getClient($_REQUEST['id']);
		}else if($_REQUEST['methode'] == 'deleteFullClient'){
			echo deleteFullClient($_REQUEST['id']);
		}else if($_REQUEST['methode'] == 'getAllCities'){
			echo getAllCities();
		}else if($_REQUEST['methode'] == 'getAllTypeMoms'){
			echo getAllTypeMoms();
		}else if($_REQUEST['methode'] == 'updateClient'){
			echo updateClient($_REQUEST['client']);
		}else if($_REQUEST['methode'] == 'getAllBox'){
			echo getAllBox();
		}else if($_REQUEST['methode'] == 'getAllProduct'){
			echo getAllProduct();
		}else if($_REQUEST['methode'] == 'getAllShop'){
			echo getAllShop();
		}else if($_REQUEST['methode'] == 'getBoxById'){
			echo getBoxById($_REQUEST['id']);
		}else if($_REQUEST['methode'] == 'getProductById'){
			echo getProductById($_REQUEST['id']);
		}else if($_REQUEST['methode'] == 'addProduct'){
			echo addProduct($_REQUEST['product']);
		}else if($_REQUEST['methode'] == 'addBox'){
			echo addBox($_REQUEST['box']);
		}else if($_REQUEST['methode'] == 'deleteBox'){
			echo deleteBox($_REQUEST['id']);
		}else if($_REQUEST['methode'] == 'deleteProduct'){
			echo deleteProduct($_REQUEST['id']);
		}else if($_REQUEST['methode'] == 'updateBox'){
			echo updateBox($_REQUEST['box']);
		}else if($_REQUEST['methode'] == 'updateProduct'){
			echo updateProduct($_REQUEST['product']);
		}else if($_REQUEST['methode'] == 'getAllCats'){
			echo getAllCats();
		}else if($_REQUEST['methode'] == 'getCatById'){
			echo getCatById($_REQUEST['id']);
		}else if($_REQUEST['methode'] == 'addCat'){
			echo addCat($_REQUEST['cat']);
		}else if($_REQUEST['methode'] == 'updateCat'){
			echo updateCat($_REQUEST['cat']);
		}else if($_REQUEST['methode'] == 'deleteCat'){
			echo deleteCat($_REQUEST['id']);
		}else if($_REQUEST['methode'] == 'getNumberPostsByCat'){
			echo getNumberPostsByCat();
		}else if($_REQUEST['methode'] == 'getPostsByCatId'){
			echo getPostsByCatId($_REQUEST['id']);
		}else{
			echo json_encode(array('result'=>'method_not_exist'));
		}
	}else{
		echo json_encode(array('result'=>'no_method_selected'));
	}
}

// $id = 216;
// echo getAllBox();
// echo getAllProduct();
// echo getAllShop();
// echo getBoxById(1);
// echo getProductById(1);
// $json_test = '{"refProduct": "fd", "id_box": "2", "id_shop": "1"}';
// $res = json_decode($json_test);
// echo addProduct($res);

function getAllCities(){
	$array = array();
	try {
		$connexion = db_connect();
		$resultats = $connexion->prepare("SELECT * FROM ville");

		$resultats->execute();

		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$resultat = $resultats->fetchAll();
		$array['result'] = $resultat;
	} catch (Exception $e) {
		$array['result'] = 0;
	}
	
	$connexion = null;
	return json_encode($array);	
}

function getAllTypeMoms(){
	$array = array();
	try {
		$connexion = db_connect();
		$resultats = $connexion->prepare("SELECT DISTINCT type FROM customer");

		$resultats->execute();

		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$resultat = $resultats->fetchAll();
		$array['result'] = $resultat;
	} catch (Exception $e) {
		$array['result'] = 0;
	}
	
	$connexion = null;
	return json_encode($array);	
}

function getCustomerType(){
	$array = array();
	try {
		$connexion = db_connect();
		$resultats = $connexion->prepare("SELECT type, ROUND(COUNT(*) / (SELECT COUNT(*) FROM `customer`) *100) AS poucentage , COUNT(*) AS nbr FROM `customer` GROUP BY type");

		$resultats->execute();

		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$resultat = $resultats->fetchAll();
		$array['result'] = $resultat;
	} catch (Exception $e) {
		$array['result'] = 0;
	}
	
	$connexion = null;
	return json_encode($array);	
}

function getCustomerAgeRange(){
	$array = array();
	try {
		$connexion = db_connect();
		$resultats = $connexion->prepare("SELECT COUNT(*) as nbr, CASE WHEN age >=0 AND age <=18 THEN '00-18' WHEN age >=19 AND age <=20 THEN '19-20' WHEN age >=21 AND age <=25 THEN '21-25' WHEN age >=26 AND age <=30 THEN '26-30' WHEN age >=31 AND age <=35 THEN '31-35' WHEN age >=36 AND age <=40 THEN '36-40' WHEN age >=40 THEN '40+' END AS ageband FROM ( SELECT YEAR(NOW()) - YEAR(`naissance`) as age FROM `customer` ) t group by ageband Order by ageband");

		$resultats->execute();

		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$resultat = $resultats->fetchAll();
		$array['result'] = $resultat;
	} catch (Exception $e) {
		$array['result'] = 0;
	}
	
	$connexion = null;
	return json_encode($array);	
}

function getCustomerVille(){
	$array = array();
	try {
		$connexion = db_connect();
		$resultats = $connexion->prepare("SELECT v.name, ROUND(COUNT(*) / (SELECT COUNT(*) FROM `customer`) *100) AS poucentage , COUNT(*) AS nbr FROM `customer` c INNER JOIN ville v ON c.Ville_id = v.id GROUP BY Ville_id");

		$resultats->execute();

		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$resultat = $resultats->fetchAll();
		$array['result'] = $resultat;
	} catch (Exception $e) {
		$array['result'] = 0;
	}
	
	$connexion = null;
	return json_encode($array);	
}

function getBabySex(){
	$array = array();
	try {
		$connexion = db_connect();
		$resultats = $connexion->prepare("SELECT sexe, ROUND(COUNT(*) / (SELECT COUNT(*) FROM `baby`) *100) AS poucentage , COUNT(*) AS nbr FROM `baby` GROUP BY sexe");

		$resultats->execute();

		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$resultat = $resultats->fetchAll();
		$array['result'] = $resultat;
	} catch (Exception $e) {
		$array['result'] = 0;
	}
	
	$connexion = null;
	return json_encode($array);	
}

function getClientDash(){
	$array = array();
	try {
		$connexion = db_connect();
		$resultats = $connexion->prepare("SELECT c.id,c.nom,c.prenom,c.gsm,YEAR(NOW()) - YEAR(c.naissance) as age,v.name FROM `customer` c INNER JOIN ville v ON c.Ville_id = v.id ORDER BY c.creationDate DESC LIMIT 5");

		$resultats->execute();

		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$resultat = $resultats->fetchAll();
		$array['result'] = $resultat;
	} catch (Exception $e) {
		$array['result'] = 0;
	}
	
	$connexion = null;
	return json_encode($array);	
}

function getBabyDash(){
	$array = array();
	try {
		$connexion = db_connect();
		$resultats = $connexion->prepare("SELECT b.id, b.naissance, b.prenom, b.sexe, c.nom, c.type FROM baby b INNER JOIN customer c ON c.id = b.customer_id WHERE sexe != 'NULL' ORDER BY b.id DESC LIMIT 5");

		$resultats->execute();

		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$resultat = $resultats->fetchAll();
		$array['result'] = $resultat;
	} catch (Exception $e) {
		$array['result'] = 0;
	}
	
	$connexion = null;
	return json_encode($array);	
}

function getAllClient(){
	$array = array();
	try {
		$connexion = db_connect();
		$resultats = $connexion->prepare("SELECT c.id,c.nom, c.prenom, c.email, c.gsm,YEAR(NOW()) - YEAR(c.naissance) as age, c.adresse, v.name FROM customer c INNER JOIN ville v ON c.Ville_id = v.id");

		$resultats->execute();

		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$resultat = $resultats->fetchAll();
		$array['result'] = $resultat;
	} catch (Exception $e) {
		$array['result'] = 0;
	}
	
	$connexion = null;
	return json_encode($array);	
}

function getClientWithEligibility(){
	$array = array();
	try {
		$connexion = db_connect();
		$resultats = $connexion->prepare("SELECT *, CASE WHEN age >=-3 AND age <=0 THEN 'BOX1' WHEN age >=1 AND age <=3 THEN 'BOX2' WHEN age >=6 AND age <=9 THEN 'BOX3' ELSE 'NON_ELIGIBLE' END AS eleg FROM ( SELECT *,PERIOD_DIFF(DATE_FORMAT(NOW(),'%Y%m'),DATE_FORMAT(naissance,'%Y%m')) as age FROM baby ) t INNER JOIN customer c ON c.id = t.customer_id INNER JOIN ville v ON c.Ville_id = v.id");

		$resultats->execute();

		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$resultat = $resultats->fetchAll();
		$array['result'] = $resultat;
	} catch (Exception $e) {
		$array['result'] = 0;
	}
	
	$connexion = null;
	return json_encode($array);	
}

function getClient($id){
	$array = array();
	try {
		$connexion = db_connect();
		$resultats = $connexion->prepare("SELECT *,c.id as id_client,c.creationDate as creationDateClient FROM customer c INNER JOIN ville v ON c.Ville_id = v.id WHERE c.id = :id");
    	
    	$resultats->bindParam(':id', $id);

		$resultats->execute();

		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$resultat = $resultats->fetchAll();
		$array['result']['client'] = $resultat;

		$resultatsBaby = $connexion->prepare("SELECT * FROM baby WHERE customer_id = :id");
    	
    	$resultatsBaby->bindParam(':id', $id);

		$resultatsBaby->execute();

		$resultatsBaby->setFetchMode(PDO::FETCH_OBJ);
		$resultatBaby = $resultatsBaby->fetchAll();
		$array['result']['baby'] = $resultatBaby;
	} catch (Exception $e) {
		$array['result'] = 0;
	}
	
	$connexion = null;
	return json_encode($array);	
}

function deleteFullClient($id){
	$array = array();

	try {
		$connexion = db_connect();

		$stmt = $connexion->prepare("DELETE FROM baby WHERE customer_id = :id");
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$count_baby = $stmt->rowCount();

		$stmt = $connexion->prepare("DELETE FROM customer WHERE id = :id");
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$count_customer = $stmt->rowCount();
		if($count_baby == 1 && $count_customer == 1){
			$array['result'] = 'ok';
		}

	} catch (Exception $e) {
		$array['result'] = 'ko';
	}
	
	$connexion = null;
	return json_encode($array);	
}

function updateClient($client){
	$array = array();

	$array['id'] = $client['id'];
	$array['nom'] = $client['nom'];
	$array['prenom'] = $client['prenom'];
	$array['email'] = $client['email'];
	$array['gsm'] = $client['gsm'];
	$array['naissance'] = $client['dof'];
	$array['adresse'] = $client['adresse'];
	$array['cp'] = $client['cp'];
	$array['type'] = $client['type'];
	$array['Ville_id'] = $client['ville'];

	try {
		$connexion = db_connect();

		$stmt = $connexion->prepare("UPDATE customer SET nom = :nom,prenom = :prenom,email = :email,gsm = :gsm,naissance = :naissance,adresse = :adresse,CP = :cp,type = :type,Ville_id = :Ville_id WHERE id = :id ");
		
		$stmt->bindValue(':id', $client['id']);
		$stmt->bindValue(':nom', $client['nom']);
		$stmt->bindValue(':prenom', $client['prenom']);
		$stmt->bindValue(':email', $client['email']);
		$stmt->bindValue(':gsm', $client['gsm']);
		$stmt->bindValue(':naissance', $client['dof']);
		$stmt->bindValue(':adresse', $client['adresse']);
		$stmt->bindValue(':cp', $client['cp']);
		$stmt->bindValue(':type', $client['type']);
		$stmt->bindValue(':Ville_id', $client['ville']);

		$stmt->execute();

		if($stmt->rowCount()) {
			$array['result'] = 'success';
		} else {
			$array['result'] = 'failed';
		}
	} catch (Exception $e) {
		$array['result'] = 'ko';
	}
	
	$connexion = null;

	return json_encode($array);	
}

function getAllBox(){
	$array = array();
	try {
		$connexion = db_connect();
		$resultats = $connexion->prepare("SELECT * FROM box");

		$resultats->execute();

		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$resultat = $resultats->fetchAll();
		$array['result'] = $resultat;
	} catch (Exception $e) {
		$array['result'] = 0;
	}
	
	$connexion = null;
	return json_encode($array);	
}

function getAllProduct(){
	$array = array();
	try {
		$connexion = db_connect();
		$resultats = $connexion->prepare("SELECT *,p.id as id_product FROM product p INNER JOIN box b ON b.id = p.id_box INNER JOIN shop s ON p.id_shop = s.id");

		$resultats->execute();

		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$resultat = $resultats->fetchAll();
		$array['result'] = $resultat;
	} catch (Exception $e) {
		$array['result'] = 0;
	}
	
	$connexion = null;
	return json_encode($array);	
}

function getAllShop(){
	$array = array();
	try {
		$connexion = db_connect();
		$resultats = $connexion->prepare("SELECT *,s.id as id_shop FROM `shop` s INNER JOIN ville v ON s.Ville_id = v.id");

		$resultats->execute();

		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$resultat = $resultats->fetchAll();
		$array['result'] = $resultat;
	} catch (Exception $e) {
		$array['result'] = 0;
	}
	
	$connexion = null;
	return json_encode($array);	
}

function getBoxById($id){
	$array = array();
	try {
		$connexion = db_connect();
		$resultats = $connexion->prepare("SELECT * FROM `box`WHERE id = :id");
    	
    	$resultats->bindParam(':id', $id);

		$resultats->execute();

		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$resultat = $resultats->fetchAll();
		$array['result'] = $resultat;

	} catch (Exception $e) {
		$array['result'] = 0;
	}
	
	$connexion = null;
	return json_encode($array);
}

function getProductById($id){
	$array = array();
	try {
		$connexion = db_connect();
		$resultats = $connexion->prepare("SELECT *, p.id as id_product FROM `product` p INNER JOIN box b ON b.id = p.id_box INNER JOIN shop s ON s.id = p.id_shop WHERE p.id = :id");
    	
    	$resultats->bindParam(':id', $id);

		$resultats->execute();

		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$resultat = $resultats->fetchAll();
		$array['result'] = $resultat;

	} catch (Exception $e) {
		$array['result'] = 0;
	}
	
	$connexion = null;
	return json_encode($array);
}

function addProduct($product){
	$array = array();
	try {
		$connexion = db_connect();
		$sql = "INSERT INTO `product`(`id_box`, `id_shop`, `RefBox`) VALUES (:id_box, :id_shop, :RefBox)";
		
		//Prepare our statement.
		$statement = $connexion->prepare($sql);
		
		//Bind our values to our parameters (we called them :make and :model).
		$statement->bindValue(':id_box', $product['id_box']);
		$statement->bindValue(':id_shop', $product['id_shop']);
		$statement->bindValue(':RefBox', $product['refProduct']);
		 
		//Execute the statement and insert our values.
		$inserted = $statement->execute();
		 
		//Because PDOStatement::execute returns a TRUE or FALSE value,
		//we can easily check to see if our insert was successful.
		if($inserted){
			$indertedId = $connexion->lastInsertId();
			$array['inserted_id'] = $indertedId;
			$array['result'] = 1;
		}

	} catch (Exception $e) {
		$array['result'] = 0;
	}
	
	$connexion = null;
	return json_encode($array);
}

function addBox($box){
	$array = array();
	try {
		$connexion = db_connect();
		$sql = "INSERT INTO `box` (`name`, `debut`, `fin`, `description`) VALUES (:name, :debut, :fin, :description)";
		
		//Prepare our statement.
		$statement = $connexion->prepare($sql);
		
		//Bind our values to our parameters (we called them :make and :model).
		$statement->bindValue(':name', $box['name']);
		$statement->bindValue(':debut', $box['debut']);
		$statement->bindValue(':fin', $box['fin']);
		$statement->bindValue(':description', $box['description']);
		 
		//Execute the statement and insert our values.
		$inserted = $statement->execute();
		 
		//Because PDOStatement::execute returns a TRUE or FALSE value,
		//we can easily check to see if our insert was successful.
		if($inserted){
			$indertedId = $connexion->lastInsertId();
			$array['inserted_id'] = $indertedId;
			$array['result'] = 1;
		}

	} catch (Exception $e) {
		$array['result'] = 0;
	}
	
	$connexion = null;
	return json_encode($array);
}

function updateBox($box){
	$array = array();

	try {
		$connexion = db_connect();

		$stmt = $connexion->prepare("UPDATE `box` SET `name`= :name,`debut`= :debut,`fin`= :fin,`description`= :description WHERE id = :id ");
		
		$stmt->bindValue(':id', $box['id']);
		$stmt->bindValue(':name', $box['name']);
		$stmt->bindValue(':debut', $box['debut']);
		$stmt->bindValue(':fin', $box['fin']);
		$stmt->bindValue(':description', $box['description']);

		$stmt->execute();

		if($stmt->rowCount()) {
			$array['result'] = 'success';
		} else {
			$array['result'] = 'failed';
		}
	} catch (Exception $e) {
		$array['result'] = 'ko';
	}
	
	$connexion = null;

	return json_encode($array);	
}

function updateProduct($product){
	$array = array();

	try {
		$connexion = db_connect();

		$stmt = $connexion->prepare("UPDATE `product` SET `id_box`= :id_box,`id_shop`= :id_shop,`RefBox`= :RefBox WHERE id = :id ");
		
		$stmt->bindValue(':id', $product['id']);
		$stmt->bindValue(':id_box', $product['id_box']);
		$stmt->bindValue(':id_shop', $product['id_shop']);
		$stmt->bindValue(':RefBox', $product['RefBox']);

		$stmt->execute();

		if($stmt->rowCount()) {
			$array['result'] = 'success';
		} else {
			$array['result'] = 'failed';
		}
	} catch (Exception $e) {
		$array['result'] = 'ko';
	}
	
	$connexion = null;

	return json_encode($array);	
}

function deleteBox($id){
	$array = array();
	$array['result'] = 0;

	try {
		$connexion = db_connect();

		$stmt = $connexion->prepare("DELETE FROM `box` WHERE id = :id");
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$count = $stmt->rowCount();

		if($count == 1){
			$array['result'] = 1;
		}

	} catch (Exception $e) {
		$array['result'] = 0;
	}
	
	$connexion = null;
	return json_encode($array);	
}

function deleteProduct($id){
	$array = array();
	$array['result'] = 0;

	try {
		$connexion = db_connect();

		$stmt = $connexion->prepare("DELETE FROM `product` WHERE id = :id");
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$count = $stmt->rowCount();

		if($count == 1){
			$array['result'] = 1;
		}

	} catch (Exception $e) {
		$array['result'] = 0;
	}
	
	$connexion = null;
	return json_encode($array);	
}

function getAllCats(){
	$array = array();

	try {
		$connexion = db_connect();
		$resultats = $connexion->prepare("SELECT * FROM `blog_cats`");

		$resultats->execute();

		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$resultat = $resultats->fetchAll();
		$array['status'] = 'success';
		$array['result'] = $resultat;
	} catch (Exception $e) {
		$array['status'] = 'failed';
		$array['result'] = 0;
	}
	
	$connexion = null;
	return json_encode($array);	
}

function getCatById($id){
	$array = array();

	try {
		$connexion = db_connect();
		$resultats = $connexion->prepare("SELECT * FROM `blog_cats` WHERE catID = :id");
		
		$resultats->bindParam(':id', $id);

		$resultats->execute();

		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$resultat = $resultats->fetchAll();
		$array['status'] = 'success';
		$array['result'] = $resultat;

	} catch (Exception $e) {
		$array['result'] = 0;
		$array['status'] = 'failed';
	}

	$connexion = null;
	return json_encode($array);
}

function addCat($cat){
	$array = array();
	$catSlug = strtolower($cat['catTitle']);

	try {
		$connexion = db_connect();
		$sql = "INSERT INTO `blog_cats`(`catTitle`, `catSlug`) VALUES (:catTitle, :catSlug)";
		
		//Prepare our statement.
		$statement = $connexion->prepare($sql);
		
		//Bind our values to our parameters (we called them :make and :model).
		$statement->bindValue(':catTitle', $cat['catTitle']);
		$statement->bindValue(':catSlug', $catSlug);
		 
		//Execute the statement and insert our values.
		$inserted = $statement->execute();
		 
		//Because PDOStatement::execute returns a TRUE or FALSE value,
		//we can easily check to see if our insert was successful.
		if($inserted){
			$indertedId = $connexion->lastInsertId();
			$array['status'] = 'success';
			$array['inserted_id'] = $indertedId;
		}

	} catch (Exception $e) {
		$array['status'] = 'failed';
	}
	
	$connexion = null;
	return json_encode($array);
}

function updateCat($cat){
	$array = array();
	$catSlug = strtolower($cat['catTitle']);

	try {
		$connexion = db_connect();

		$stmt = $connexion->prepare("UPDATE `blog_cats` SET `catTitle` = :catTitle,`catSlug` = :catSlug WHERE catID = :id ");
		
		$stmt->bindValue(':id', $cat['id']);
		$stmt->bindValue(':catTitle', $cat['catTitle']);
		$stmt->bindValue(':catSlug', $catSlug);

		$stmt->execute();

		if($stmt->rowCount()) {
			$array['result'] = 'success';
		} else {
			$array['result'] = 'failed';
		}
	} catch (Exception $e) {
		$array['result'] = 'failed';
	}
	
	$connexion = null;

	return json_encode($array);	
}


function deleteCat($id){
	$array = array();
	$array['result'] = 0;

	try {
		$connexion = db_connect();

		$stmt = $connexion->prepare("DELETE FROM `blog_cats` WHERE catID = :id");
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$count = $stmt->rowCount();

		if($count == 1){
			$array['result'] = 'success';
		}else{
			$array['result'] = 'failed';
		}
	} catch (Exception $e) {
		$array['result'] = 'failed';
	}
	
	$connexion = null;
	return json_encode($array);	
}

function getNumberPostsByCat(){
	$array = array();
	try {
		$connexion = db_connect();
		$resultats = $connexion->prepare("SELECT bc.catID, bc.catTitle, COUNT(*) as nombre FROM `blog_post_cats` bpc INNER JOIN `blog_cats` bc ON bpc.catID = bc.catID GROUP BY bc.catID");
		$resultats->execute();
		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$resultat = $resultats->fetchAll();
		$array['result'] = $resultat;
		$array['status'] = 'success';
	} catch (Exception $e) {
		$array['status'] = 'failed';
	}
	
	$connexion = null;
	return json_encode($array);	
}

function getPostsByCatId($id){
	$array = array();
	try {
		$connexion = db_connect();
		$resultats = $connexion->prepare("SELECT bps.postID, bps.postTitle, bps.postDate FROM `blog_posts_seo` bps INNER JOIN `blog_post_cats` bpc ON bps.postID = bpc.postID WHERE bpc.catID = :id");
		$resultats->bindParam(':id', $id);
		$resultats->execute();
		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$resultat = $resultats->fetchAll();
		$array['result'] = $resultat;
		$array['status'] = 'success';
	} catch (Exception $e) {
		$array['status'] = 'failed';
	}
	
	$connexion = null;
	return json_encode($array);	
}

function db_connect(){

	
	/*Local Kindy*/

	$hote   	='localhost';
	$passDb 	='S3cr3T%44';
	$bd 		='oumdev_leads';
	$user		='root';	


	/*$hote   	='localhost';
	$passDb 	='S3cr3T%44';
	$bd 		='oumdev_leads';
	$user		='root';	
*/

	/*Local*/
	// $hote   	='localhost';
	// $passDb 	='';
	// $bd 		='oumdev_leads';
	// $user		='root';

	/*Distant*/
	/*$hote   	='localhost';
	$passDb 	='oumdev';
	$bd 		='id709237_oumdev_leads';
	$user		='id709237_oumdev';*/
	

	$connexion = new PDO('mysql:host='.$hote.';dbname='.$bd.';charset=utf8', $user, $passDb);

	return $connexion;
}