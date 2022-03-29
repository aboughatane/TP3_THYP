<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" href="css.css">
      <title>bdd images</title>
   </head>
   <body>
   <?php
      include ("transfert.php");
      if ( isset($_FILES['file'])){
             transfert();
      }                 
   ?>
   <div id="div">  
      <h1> Envoyer une image </h1>
      <form enctype="multipart/form-data" action="#" method="post">
         <input type="hidden" name="MAX_FILE_SIZE" value="250000" />
         <input type="file" name="file" size=1000/>
         <input type="submit" value="Envoyer" />
         <br><br>
      </form>
   </div>
      <h2 > Voici les images présentes dans la base : </h2>
      <center><table border="1" cellpadding="10" cellspacing="3">
         <?php include_once('pdo.php');   
            // Afficher l'image et ses informations
            foreach ($books as $book) {
         ?>
            <tr>
               <td><?php echo "  ID  " .$book['id_image']; ?></td>
               <td style="background-color:#67B6EB"><?php echo "Titre  : " .$book['title_image']; ?></td>
                   <?php $id = $book['id_image']; ?>

               <?php 
               $imgs = glob("photo/*{_$id}.{jpg,png,jpeg,gif}", GLOB_BRACE);
                  foreach ($imgs as $img){         
                     echo "<td><img src='$img' alt='image bdd' width='250' height='200'></td>";               
                  }
            }
               ?>
            </tr>
         </table></center>
   <footer id="footer">
      <?php            
         // la boucle pour afficher les elements page par page       
         for($i=1; $i<=$pagesCount; $i++)
               echo "<a href='?page=$i'> $i </a>&nbsp &nbsp";         
      ?>  
   </body>
</html>
