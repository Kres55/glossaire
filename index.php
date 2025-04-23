<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Glossaire Interactif</title>

</head>

<body>
    <div class="container">
        <h1>Glossaire Formation DWWM</h1>

        
        <?php if (isset($_GET['message'])): ?>
            <div class="message">
                <?php echo htmlspecialchars($_GET['message']); ?>
            </div>
        <?php endif; ?>

        
        <form action="process.php" method="POST">
            <input type="text" name="term" placeholder="Entrez un terme" required>
            <input type="text" name="definition" placeholder="Entrez une définition" required>
            <button type="submit" name="action" value="add">Ajouter</button>
        </form>

        
        <ul class="glossary">
            <?php
            
            $conn = new mysqli('localhost', 'root', '1234', 'glossary_db');

            if ($conn->connect_error) {
                die("Échec de la connexion : " . $conn->connect_error);
            }

            $result = $conn->query("SELECT * FROM glossary ORDER BY term ASC");

            while ($row = $result->fetch_assoc()): ?>
                <li class="glossary-item">
                    <span><strong><?php echo htmlspecialchars($row['term']); ?>:</strong> <?php echo htmlspecialchars($row['definition']); ?></span>
                    <form action="process.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="action" value="delete">Supprimer</button>
                    </form>
                </li>
            <?php endwhile; ?>

            <?php $conn->close(); ?>
        </ul>
    </div>
</body>

</html>