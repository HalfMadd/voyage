<?php
//connexion BDD
$mysqli = mysqli_connect("127.0.0.1", "root", "", "aeroport");

//création requête
$req = "SELECT nom_ville,nom_continent,nom_mois,temp_min,temp_max FROM villes
		INNER JOIN continents ON villes.continent_id = continents.id_continent
		INNER JOIN temperatures ON villes.id_ville = temperatures.ville_id
		INNER JOIN mois ON temperatures.mois_id = mois.id_mois";

$month = filter_input(INPUT_POST, 'month');

$req .= " WHERE mois.id_mois = ".$month;

$thermometerMin = filter_input(INPUT_POST, 'thermometerMin');
$thermometerMax = filter_input(INPUT_POST, 'thermometerMax');

$req.= " AND temp_min > ".$thermometerMin." AND temp_max < ".$thermometerMax;

$req .= " LIMIT 1";

//exécution
$res = mysqli_query($mysqli, $req);

//traitement JSON
if(mysqli_num_rows($res) > 0){
        $userData = $res->fetch_assoc();
        $data['status'] = 'ok';
        $data['result'] = $userData;
    }else{
        $data['status'] = 'err';
        $data['result'] = '';
    }
print json_encode($data);
