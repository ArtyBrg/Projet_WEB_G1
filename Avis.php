<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Avis</title>
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<link rel="stylesheet" href="assets/style_avis.css">
	<link rel="shortcut icon" href="Image/logo.png"/>
	<script src="script/avis.js"></script>
</head>
<body>
	<header>

	    <img id="logo" src="Image/logo.png" alt="Logo">

	    <div class="liens">
		    <div class="lien-container">
		        <a class="menu-liens"><img src="Image/contact.png"></a>
		        <div class="dropdown">
					<a href="#">Option 7</a>
		            <a href="#">Option 8</a>
		            <a href="#">Option 9</a>
		        </div>
		    </div>
		    <div class="lien-container">
		        <a class="menu-liens"><img src="Image/notif.png"></a>
		        <div class="dropdown">
		            <a href="#">Option 4</a>
		            <a href="#">Option 5</a>
		            <a href="#">Option 6</a>
		        </div>
		    </div>
		    <div class="lien-container">
		        <a class="menu-liens"><img src="Image/profil.png"></a>
		        <div class="dropdown">
					<a href="Profil.html">Mon profil</a>
		            <a href="Avis.php">Mes avis</a>
		            <a href="#">Wish List</a>
		            <a href="Connexion.html">Déconnexion</a>
		        </div>
		    </div>
		</div>
	    
	</header>

	<div class="conteneur">
		<h2>
			Liste des entreprises
		</h2>
			<?php
				require 'connexion_bdd/creation_connexion.php';

				$page = isset($_GET['page']) ? $_GET['page'] : 1;
				$entrepriseParPage = 2; // Nombre d'étudiants par page

				$sql = "SELECT id_stage FROM stage";
				$result = $dbh->query($sql);
				$totalEntreprise = $result->rowCount();
				$totalPages = ceil($totalEntreprise / $entrepriseParPage);

				$offset = ($page - 1) * $entrepriseParPage;

				$sql = "SELECT id_stage FROM stage LIMIT $offset, $entrepriseParPage";
				$result = $dbh->query($sql);
				$index = 0;

				while ($colonne = $result->fetch(PDO::FETCH_ASSOC)) {
				    echo '<div class="container">';
				    echo '<div class="info">';
				    echo '<h2>' . $colonne['id_stage'] .'</h2>';
				    echo '<div class="stars">';
            		echo '<p class="lar la-star" data-value="1"></p>';
            		echo '<p class="lar la-star" data-value="2"></p>';
            		echo '<p class="lar la-star" data-value="3"></p>';
            		echo '<p class="lar la-star" data-value="4"></p>';
            		echo '<p class="lar la-star" data-value="5"></p>';
        			echo '</div></div>';
				    echo '<div class="points-container" onclick="toggleDropdown(' . $index . ')">';
				    echo '<div class="point"></div>';
				    echo '<div class="point"></div>';
				    echo '<div class="point"></div>';
				    echo '</div>';
				    echo '<div class="dropdown-menu" id="dropdownMenu_' . $index . '">';
				    echo '<a href="#">Profil</a>';
				    echo '<a href="#">Modifier</a>';
				    echo '<a href="#">Supprimer</a>';
				    echo '</div></div>';

				    $index++;
				}
			?>
		<div id="pagination" class="pagination"></div>
	</div>
	
	<footer id="footer">
		<nav>&copy;2024 | Tinkièt' | Tous droits réservés</nav>
	</footer>

</body>

<script type="text/javascript">
	// Fonction pour afficher les boutons de pagination
    function showPagination() {
        var totalPages = <?php echo $totalPages; ?>;
        var currentPage = <?php echo $page; ?>;
        var paginationContainer = document.getElementById('pagination');

        paginationContainer.innerHTML = '';

        for (var i = 1; i <= totalPages; i++) {
            var button = document.createElement('button');
            button.innerText = i;
            button.value = i;
            if (i === currentPage) {
                button.classList.add('active');
            }
            button.addEventListener('click', function () {
                showEntreprise(this.value);
            });
            paginationContainer.appendChild(button);
        }
    }
        showPagination();
</script>

</html>