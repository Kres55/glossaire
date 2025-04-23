<?php
$conn = new mysqli('localhost', 'root', '1234', 'glossary_db');

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

$action = $_POST['action'] ?? '';

if ($action === 'add') {
    $term = $_POST['term'];
    $definition = $_POST['definition'];

    $stmt = $conn->prepare("INSERT INTO glossary (term, definition) VALUES (?, ?)");
    $stmt->bind_param('ss', $term, $definition);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php?message=Terme ajouté avec succès");
} elseif ($action === 'delete') {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM glossary WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php?message=Terme supprimé avec succès");
}

$conn->close();
