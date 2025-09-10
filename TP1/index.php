
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Exo-1</title>
  <link rel="stylesheet" href="exo1.css">

</head>
<body>

<?php
//Helpers génériques
function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }


function render_table(array $rows)
{
    if (empty($rows)) return;
    echo "<table>";

    // Header row
    echo "<tr>";
    foreach (array_keys(reset($rows)) as $header) {
        echo "<th>" . h($header) . "</th>";
    }
    echo "</tr>";

    // Data rows
    foreach ($rows as $row) {
        echo "<tr>";
        foreach ($row as $cell) {
            echo "<td>";
            if (is_array($cell)) {
                echo h(implode(", ", $cell));
            } else {
                echo h($cell);
            }
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}//FinFunction




// Utilisateurs
$users = [
  ['nom'=>'Anna','age'=>23,'taille_cm'=>165,'poids_kg'=>56,'email'=>'anna@example.org','pays'=>'DE'],
        ['nom'=>'Anna','age'=>23,'taille_cm'=>165,'poids_kg'=>56,'email'=>'anna@example.org','pays'=>'DE'],
        ['nom'=>'Anna','age'=>23,'taille_cm'=>165,'poids_kg'=>56,'email'=>'anna@example.org','pays'=>'DE'],
  ['nom'=>'Ben','age'=>31,'taille_cm'=>178,'poids_kg'=>82,'email'=>'ben@example.org','pays'=>'DE'],
  ['nom'=>'Aya','age'=>27,'taille_cm'=>160,'poids_kg'=>50,'email'=>'aya@example.org','pays'=>'FR'],
        ['nom'=>'Aya','age'=>27,'taille_cm'=>160,'poids_kg'=>50,'email'=>'aya@example.org','pays'=>'FR'],
  ['nom'=>'Luca','age'=>29,'taille_cm'=>182,'poids_kg'=>79,'email'=>'luca@example.org','pays'=>'IT'],
  ['nom'=>'Sara','age'=>25,'taille_cm'=>168,'poids_kg'=>60,'email'=>'sara@example.org','pays'=>'ES'],
  ['nom'=>'Tom','age'=>34,'taille_cm'=>185,'poids_kg'=>88,'email'=>'tom@example.org','pays'=>'UK'],
  ['nom'=>'Inès','age'=>22,'taille_cm'=>158,'poids_kg'=>52,'email'=>'ines@example.org','pays'=>'FR'],
  ['nom'=>'Omar','age'=>28,'taille_cm'=>175,'poids_kg'=>74,'email'=>'omar@example.org','pays'=>'MA'],
  ['nom'=>'Nina','age'=>26,'taille_cm'=>170,'poids_kg'=>62,'email'=>'nina@example.org','pays'=>'DE'],
  ['nom'=>'Paul','age'=>33,'taille_cm'=>180,'poids_kg'=>85,'email'=>'paul@example.org','pays'=>'FR'],
  ['nom'=>'Zoé','age'=>21,'taille_cm'=>162,'poids_kg'=>54,'email'=>'zoe@example.org','pays'=>'BE'],
  ['nom'=>'Hugo','age'=>30,'taille_cm'=>190,'poids_kg'=>92,'email'=>'hugo@example.org','pays'=>'FR'],
];

// Ventes mensuelles
$sales = [
  ['mois'=>'2025-01','montant'=>1200],
  ['mois'=>'2025-02','montant'=>1730],
  ['mois'=>'2025-03','montant'=>1490],
  ['mois'=>'2025-04','montant'=>1610],
  ['mois'=>'2025-05','montant'=>1845],
  ['mois'=>'2025-06','montant'=>1950],
  ['mois'=>'2025-07','montant'=>1320],
  ['mois'=>'2025-08','montant'=>1405],
  ['mois'=>'2025-09','montant'=>2015],
  ['mois'=>'2025-10','montant'=>1870],
  ['mois'=>'2025-11','montant'=>2100],
  ['mois'=>'2025-12','montant'=>2260],
];

// Étudiants et notes
$students = [
  ['nom'=>'Léa','notes'=>[14,12,13]],
  ['nom'=>'Max','notes'=>[9,11,8]],
  ['nom'=>'Noa','notes'=>[15,16,14]],
  ['nom'=>'Eli','notes'=>[10,13,12]],
  ['nom'=>'Yanis','notes'=>[7,9,11]],
  ['nom'=>'Maya','notes'=>[16,15,17]],
  ['nom'=>'Iris','notes'=>[12,12,13]],
  ['nom'=>'Jules','notes'=>[18,14,16]],
  ['nom'=>'Nora','notes'=>[11,10,12]],
  ['nom'=>'Léo','notes'=>[13,14,15]],
];

// Produits
$products = [
  ['label'=>'A','prix'=>19.9,'note'=>3.8],
  ['label'=>'B','prix'=>9.9,'note'=>4.6],
  ['label'=>'C','prix'=>14.5,'note'=>4.2],
  ['label'=>'D','prix'=>29.0,'note'=>4.8],
  ['label'=>'E','prix'=>24.9,'note'=>4.1],
  ['label'=>'F','prix'=>39.9,'note'=>3.6],
  ['label'=>'G','prix'=>12.5,'note'=>4.4],
  ['label'=>'H','prix'=>17.0,'note'=>3.9],
  ['label'=>'I','prix'=>49.0,'note'=>4.9],
  ['label'=>'J','prix'=>5.5,'note'=>3.2],
  ['label'=>'K','prix'=>27.4,'note'=>4.0],
  ['label'=>'L','prix'=>33.3,'note'=>4.3],
];

$logs_countries = ['FR','DE','FR','ES','FR','DE','IT'];

$config_def = ['theme'=>'dark','items_per_page'=>10,'features'=>['export'=>false,'beta'=>false]];
$config_user = ['items_per_page'=>25,'features'=>['beta'=>true]];

$titles = ['Hallo Welt','Äpfel & Birnen','PHP Arrays 101'];
?>



<h2>Ex. 1 — Transformation simple (array_map)</h2>
<p>Ajouter une colonne <code>initiales</code> (p.ex. « A. », « B. ») à partir de <code>nom</code> via <code>array_map</code>, sans modifier $users d’origine.</p>
<?php

$users = array_map(function ($u) {
    $u['initiales'] = substr($u['nom'], 0, 1);
    return $u;
}, $users);
render_table($users);

?>

<h2>Ex. 2 — Calcul IMC</h2>
<p>Créer une colonne <code>imc</code> = poids / (taille en m)^2 (arrondi à 1 décimale) via <code>array_map</code>.</p>
<?php
$users = array_map(function ($u) {
    $u['imc'] = round($u['poids_kg'] / ($u['taille_cm'] / 100) ** 2, 1);
    return $u;
}, $users);
render_table($users);
?>

<h2>Ex. 3 — Filtrage (array_filter)</h2>
<p>Garder les étudiants dont la moyenne ≥ 12 ; afficher <code>nom</code> et <code>moyenne</code>.</p>
<?php
// Calculer la moyenne
$students = array_map(function ($student) {
    $sommes = 0;
    foreach ($student['notes'] as $n) {
        $sommes += $n;
    }
    $student['moyenne'] = $sommes / count($student['notes']);
    return $student;
}, $students);

// Filtrer
$students = array_filter($students, function ($student) {
    return $student['moyenne'] >= 12;
});

render_table($students);
?>

<h2>Ex. 4 — Agrégations (array_reduce)</h2>
<p>À partir de $sales, calculer <code>total</code> et <code>moyenne</code> des montants (2 décimales).</p>
<?php
$total = array_reduce($sales, function ($total, $sale) {
    return $total + $sale['montant'];
}, 0);
$moyenne = $total / count($sales);
echo '<p>Total: '.number_format($total, 2). '</p>' . '<p>Moyenne: ' .number_format($moyenne, 2).'</p>';
?>

<h2>Ex. 5 — Regroupement par clé</h2>
<p>Regrouper $users par <code>pays</code> et compter le nombre d’utilisateurs par pays (utiliser <code>array_reduce</code> ou <code>array_count_values</code> après un <code>array_column</code>).</p>
<?php
$users_by_country = array_reduce($users, function ($users_by_country, $user) {
    $country = $user['pays'];
    $users_by_country[$country][] = $user;
    return $users_by_country;
});

// Compter les utilisateurs par pays et l'afficher
$user_countries = (array_count_values(array_column($users, 'pays')));
// Affiche proprement les pays des utilisateurs
foreach ($user_countries as $country => $count) {
    echo '<p>' . $country . ': ' . $count . '</p>';
}

// var_dump($users_by_country);
?>

<h2>Ex. 6 — Déduplication & doublons</h2>
<p>À partir d’une liste d’emails (dupliquez-en quelques-uns), afficher les doublons détectés (indices et valeurs) en utilisant <code>array_count_values</code>.</p>
<?php
$usersMail = array_count_values(array_column($users, 'email'));
foreach ($usersMail as $email => $count) {
    if ($count > 1) {
        echo '<p>' . $email . ' : ' . $count . ' occurences</p>';
    }
}
?>

<h2>Ex. 7 — Tri composé</h2>
<p>Trier $products par <code>prix</code> croissant puis, à prix égal, par <code>note</code> décroissante (via <code>usort</code>).</p>
<?php
usort($products, function ($a, $b){
    $result = $a['prix'] <=> $b['prix'];
    if ($result === 0) {
        $result = $b['note'] <=> $a['note'];
    }
    return $result;
});
render_table($products);
?>

<h2>Ex. 8 — Pagination simple (array_chunk)</h2>
<p>Découper $users en pages de 2 et afficher la page 2 (si elle existe).</p>
<?php
$pages = array_chunk($users, 2);
render_table($pages[1] ?? []);
render_table($pages);
?>

<h2>Ex. 9 — Fusion de configuration</h2>
<p>Fusionner $config_def et $config_user en conservant les sous-clés (utiliser une fusion récursive ; afficher le résultat).</p>
<?php
$cfg = array_replace_recursive($config_def, $config_user);
echo '<pre>' . (print_r($cfg, true)) . '</pre>';
?>

<h2>Ex. 10 — Génération de slug</h2>
<p>À partir de $titles, produire des slugs (minuscules, espaces → «-», accents simplifiés) avec <code>array_map</code>.</p>
<?php
$titles = array_map(function ($title) {
    // Crée un tableau associatif pour chaque titre
    return ['slug' => strtolower(str_replace(' ', '-', iconv('UTF-8', 'ASCII//TRANSLIT', $title)))];
}, $titles);
render_table($titles);
?>

</body>
</html>
