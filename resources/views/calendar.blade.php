@extends('../template')
@section('contenu')

<?php
    $timestamp = mktime(0, 0, 0, date('m'), 1, date('Y'));

// === Si le mois correspond au mois actuel et l'année aussi, on retient le jour actuel pour le griser plus tard (sinon le jour actuel ne se situe pas dans le mois)
if(date('m', $timestamp) == date('m') && date('Y', $timestamp) == date('Y')) $coloreNum = date('d');

$m = array("01" => "Janvier", "02" => "Février", "03" => "Mars", "04" => "Avril", "05" => "Mai", "06" => "Juin", "07" => "Juillet", "08" => "Août", "09" => "Septembre", "10" => "Octobre",  "11" => "Novembre", "12" => "Décembre");
$j = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');

$numero_mois = date('m', $timestamp);
$annee = date('Y', $timestamp);

if($numero_mois == 12) {
    $annee_avant = $annee;
    $annee_apres = $annee + 1;
    $mois_avant = $numero_mois - 1;
    $mois_apres = 01;
}
elseif($numero_mois == 01) {
    $annee_avant = $annee - 1;
    $annee_apres = $annee;
    $mois_avant = 12;
    $mois_apres = $numero_mois + 1;
}
else {
    $annee_avant = $annee;
    $annee_apres = $annee;
    $mois_avant = $numero_mois - 1;
    $mois_apres = $numero_mois + 1;
}

// 0 => Dimanche, 1 => Lundi, 2 = > Mardi...
$numero_jour1er = date('w', $timestamp);

// Changement du numéro du jour car l'array commence à l'indice 0
if ($numero_jour1er == 0) $numero_jour1er = 6; // Si c'est Dimanche, on le place en 6ème position (après samedi)
else $numero_jour1er--; // Sinon on mets lundi à 0, Mardi à 1, Mercredi à 2...
?>

<table class="calendrier">
    <caption><?php echo '<a href="?m='.$mois_avant.'&amp;y='.$annee_avant.'"><<</a>  '.$m[$numero_mois].' '.$annee.'  <a href="?m='.$mois_apres.'&amp;y='.$annee_apres.'">>></a>'; ?></caption>

    <tr><th>Lu</th><th>Ma</th><th>Me</th><th>Je</th><th>Ve</th><th>Sa</th><th>Di</th></tr>
    <?php
    // Ecriture de la 1ère ligne
    echo '<tr>';
    // Ecriture de colones vides tant que le mois ne démarre pas
    for($i = 0 ; $i < $numero_jour1er ; $i++) {		echo '<td></td>';	}
    for($i = 1 ; $i <= 7 - $numero_jour1er; $i++) {
        // Ce jour possède un événement
        echo '<td ';

        if(isset($coloreNum) && $coloreNum == $i) echo 'class="lienCalendrierJour"';

        echo '>'.$i.'</td>';

    }
    echo '</tr>';

    $nbLignes = ceil((date('t', $timestamp) - ($i-1))/ 7); // Calcul du nombre de lignes à afficher en fonction de la 1ère (surtout pour les mois a 31 jours)

    for($ligne = 0 ; $ligne < $nbLignes ; $ligne++) {
        echo '<tr>';
        for($colone = 0 ; $colone < 7 ; $colone++) {
            if($i <= date('t', $timestamp))	{
                // Ce jour possède un événement

                    echo '<td ';

                    if(isset($coloreNum) && $coloreNum == $i) echo 'class="lienCalendrierJour"';

                    echo '>'.$i.'</td>';

            } else {
                echo '<td></td>';
            }
            $i = $i +1;
        }
        echo '</tr>';
    }
    ?>
</table>

<br/>


@endsection