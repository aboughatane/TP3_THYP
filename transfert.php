<?php
function transfert(){
    $size_image = 0;
    $type_image = '';
    $title_image = '';
    $taille_max = 250000;
    $mysqlClient = is_uploaded_file($_FILES['file']['tmp_name']);

    if (!$mysqlClient) {
        echo "Problème de transfert";
        return false;

    } else {
        $size_image = $_FILES['file']['size'];
        
        // Gérer la taille de l'image
        if ($size_image > $taille_max) {
            echo "Attention ce fichier est trop gros !";
            return false;
        }

        $file_tmp = $_FILES['file']["tmp_name"];
        $type_image = $_FILES['file']['type'];
        $title_image  = $_FILES['file']['name'];
        $path_image = "photo/".$title_image;
        
        // connexion à la base de données
        include("pdo.php");
        echo "Fichier bien reçu ! <br>";

        $querry = "INSERT INTO `images`
        (`title_image`, `size_image`, `type_image`) VALUES
        ('$title_image', '$size_image', '$type_image');";   
        
        move_uploaded_file($file_tmp,$path_image);
        $imageInsert = $mysqlClient->prepare($querry);
        $inserted = $imageInsert->execute();

        $querry2 = "INSERT INTO `books`
        (`title`) VALUES
        ('$title_image');"; 
        $bookInsert = $mysqlClient->prepare($querry2);
        $inserted = $bookInsert->execute();  
    }
}
?>
