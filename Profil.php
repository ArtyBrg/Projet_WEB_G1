<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mon profil</title>
	<link rel="stylesheet" href="assets/style_profil.css">
	<link rel="shortcut icon" href="Image/logo.png"/>
	<script defer src="script/profil.js"></script>
</head>
<body>
	<header>

	    <?php include 'header.php'; ?>
	    
	</header>

	<?php

	require 'connexion_bdd/creation_connexion.php';

	if(isset($_SESSION['id_compte'])) 
	{
		$id_compte = $_SESSION['id_compte'];
	}

	$sql = "SELECT id_etudiant FROM Etudiant WHERE id_compte = :id_compte";

	$stmt = $dbh->prepare($sql);
	$stmt->bindParam(':id_compte', $id_compte);
	$stmt->execute();

	$result = $stmt->fetch(PDO::FETCH_ASSOC);

    $id_etudiant = $result['id_etudiant'];

	$sql = "SELECT Etudiant.nom, Etudiant.prenom, Compte.email_pro, Promotion.nom_promotion, Promotion.specialite, Centre.nom_centre, GROUP_CONCAT(Competences.nom_competence SEPARATOR ', ') AS competences_acquises FROM Etudiant JOIN Compte ON Etudiant.id_compte = Compte.id_compte LEFT JOIN Etudier ON Etudiant.id_etudiant = Etudier.id_etudiant LEFT JOIN Promotion ON Etudier.id_promotion = Promotion.id_promotion LEFT JOIN Centre ON Promotion.id_centre = Centre.id_centre LEFT JOIN Acquerir ON Etudiant.id_etudiant = Acquerir.id_etudiant LEFT JOIN Competences ON Acquerir.id_competence = Competences.id_competence WHERE Etudiant.id_etudiant = :id_etudiant GROUP BY Etudiant.id_etudiant";

	$stmt = $dbh->prepare($sql);
	$stmt->bindParam(':id_etudiant', $id_etudiant);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);

	?>

	<div class="conteneur">
	    <div class="profil">
	    	<div class="overlay" id="overlay"></div>
			<img src="Image/pascontent.png" alt="Image" class="zoomed-image" id="zoomedImage">
			<img src="Image/pascontent.png" alt="Image" class="profil-pic" id="profilPic">
	        <div class="info">
	            <label class="h2">
	            	<?php
						$nom = $result['nom'];
						echo $nom;
					?>
	            </label>
	            <label class="h2">
	            	<?php
						$prenom = $result['prenom'];
						echo $prenom;
					?>
	            </label>
	            <p>
	            	<?php
						$email = $result['email_pro'];
						echo $email;
					?>
				</p>
	        </div>
	    </div>
    
    	<div class="conteneur">
	        <div class="profil-info">
	            <div class="info">
	                <h2>Skills</h2>
	                <label>
	                <?php
						$comp = $result['competences_acquises'];
						if($comp === NULL){
							echo "Cette étudiant n'a pas de compétences";
						}else{
							echo $comp;
						}
					?>
	                </label>
	            </div>
	         </div>
	         <div class="profil-info">
	            <div class="stage-statut">
	                <h2>Statut du stage</h2>
	                <p>Actuellement en recherche de stage</p>
	            </div>
	        </div>
    	</div>
    </div>

	<?php include 'footer.php'; ?>
</body>
</html>