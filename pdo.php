<?php
/* Connecter la base de données */
        try
        {
            $mysqlClient = new PDO('mysql:host=localhost;dbname=my_database;charset=utf8', 'root', 'root');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }

        $sqlQuery = 'select count(id_image) as compt from images';  // la requete sql
        $count = $mysqlClient->prepare($sqlQuery); 
        $count->execute(); 	
        $booksCount = $count->fetchAll();

        $page = $_GET["page"];
        $elementsPerPage = 2;  // Mettre qu'un seul element dans la page (un livre par page)
        $pagesCount=ceil($booksCount[0]["compt"]/$elementsPerPage);  // pagesCount est le nombre de page qu'on va avoir -  ceil permet d'arrondir le nombre pour un avoir un nombre entier
        $start = ($page-1) * $elementsPerPage;  // l'element par lequel commencer


        // On récupère tout le contenu de la table books
        $sqlQuery = 'SELECT * FROM images limit :start,:elementsPerPage';
        $booksStatement = $mysqlClient->prepare($sqlQuery);
        $booksStatement->bindValue('elementsPerPage',$elementsPerPage,PDO::PARAM_INT);
        $booksStatement->bindValue('start',$start,PDO::PARAM_INT);
        $booksStatement->execute();
        $books = $booksStatement->fetchAll();
?>