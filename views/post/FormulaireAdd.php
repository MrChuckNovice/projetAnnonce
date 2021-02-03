
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
</head>
<body>
    <div align="center">
      <form action="" method="post" enctype="multipart/form-data">
         <table>
           <tr>
             <td>
                <label for="titreannonce">titreannonce</label>
             </td>
             <td>
                <input type="text" name="titreannonce"/>
             </td>
           </tr>
           <tr>
             <td>
                <label for="description">description</label>
             </td>
           </tr>
           <td>
                <input type="text" name="description"/>
             </td>
           <tr>
             <td>
                <label for="created_at">created_at</label>
             </td>
           </tr>
             <td>
                <input type="date" name="created_at"/>
             </td>
           <tr>
             <td>
                <label for="categorie">categorie</label>
             </td>
           </tr>
             <td>
                <input type="text" name="categorie"/>
             </td>
           <tr>
             <td>
                <label for="photo">photo</label>
             </td>
           </tr>
             <td>
                <input type="file" name="photo"/>
             </td>
           <tr>
              <td>
                <input type="submit" name="forminscription" value="envoyer"/>
             </td>
           </tr>
         </table>
      </form>
      <?php
        if(isset($erreur))
        {
        echo '<font color="red">'.$erreur."</font>";
        }
      ?>
    </div>
</body>
</html>
<?php/* $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>