<?php
$mysqli = new mysqli("localhost", "root", "", "droptonprono");
if ($mysqli->connect_errno) {
    echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo $mysqli->host_info . "\n";

$score = 0;
$score_pts_exacts = 0;
$score_bon_prono = 0;

$users = $mysqli->query("SELECT * FROM users");


foreach ($users as $k => $user) {

    //var_dump($user['id']);
    echo '<br /><br />';

    $pronosTermines = $mysqli->query('SELECT * FROM pronos WHERE pronos.id_user = $user["id"]');
    var_dump($pronosTermines);
}

?>