<?php
header('Content-Type: application/json; charset=utf-8');
require __DIR__ . '/../includes/db.php';

$taal = $_GET['taal'] ?? 'nl';
if (!preg_match('/^[a-z]{2}$/', $taal)) { $taal = 'nl'; }

$punten = $pdo->query(
    "SELECT id, titel_key, tekst_key, tijd_in_film, positie_x, positie_y
     FROM punten WHERE actief = 1 ORDER BY tijd_in_film"
)->fetchAll();

$stmt = $pdo->prepare("SELECT sleutel, inhoud FROM teksten WHERE taal = :taal");
$stmt->execute(['taal' => $taal]);
$teksten = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

$instellingen = $pdo->query("SELECT sleutel, waarde FROM instellingen")->fetchAll(PDO::FETCH_KEY_PAIR);

echo json_encode([
    'punten' => $punten,
    'teksten' => $teksten,
    'instellingen' => $instellingen,
], JSON_UNESCAPED_UNICODE);
