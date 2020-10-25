<?php 
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=u327085864_havafloserveur', 'u327085864_havafloserveur', '?c6ToaW^Q1');

if(isset($_POST['forminscription']))
{
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $password = htmlspecialchars($_POST['password']);
    $password2 = htmlspecialchars($_POST['password2']);
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $sexe = htmlspecialchars($_POST['sexe']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $ville = htmlspecialchars($_POST['ville']);
    $pays = htmlspecialchars($_POST['pays']);
    $phone = htmlspecialchars($_POST['phone']);

    if(!empty($pseudo) AND !empty($mail) AND !empty($password) AND !empty($nom) AND !empty($prenom) AND !empty($adresse) AND !empty($ville) AND !empty($phone))
    {
        if ($_POST['password'] == $_POST['password2'])
        {
            if(strlen($pseudo) > 2 AND strlen($pseudo) <15 AND strlen($password) > 2 AND strlen($password) < 15 AND strlen($nom) > 2 AND strlen($nom) < 15 AND strlen($prenom) > 2 AND strlen($prenom) < 15 AND strlen($adresse) > 2 AND strlen($adresse) < 50 AND strlen($ville) > 2 AND strlen($ville) < 30 AND strlen($phone) > 5 AND strlen($phone) < 15)
            {
 
                $reqpseudo = $bdd->prepare('SELECT * FROM membre WHERE pseudo = ?');
                $reqpseudo->execute(array($pseudo));

                $reqmail = $bdd->prepare('SELECT * FROM membre WHERE mail = ?');
                $reqmail->execute(array($mail));

                if ($reqpseudo->rowCount() == 0 AND $reqmail->rowCount() == 0)
                {
                    if(is_numeric($phone))
                    {
                        if(ctype_alpha($nom) AND ctype_alpha($prenom) AND ctype_alpha($ville))
                        {
                            $req = $bdd->prepare('INSERT INTO membre(pseudo, mail, password, nom, prenom, sexe, adresse, ville, pays, phone) VALUES(:pseudo, :mail, :password, :nom, :prenom, :sexe, :adresse, :ville, :pays, :phone)');
                            $req->execute(array(
                            'pseudo' => $pseudo,
                            'mail' => $mail,
                            'password' => $password,
                            'nom' => $nom,
                            'prenom' => $prenom,
                            'sexe' => $sexe,
                            'adresse' => $adresse,
                            'ville' => $ville,
                            'pays' => $pays,
                            'phone' => $phone,
                            ));

                            header("Location: http://havafloserveur.esy.es/index.php");

                        }
                        else {$error = 'Prenon, nom ou ville non disponible';}
                    }
                    else {$error = 'Phone non disponible';}

                }
                else {$error = 'pseudo ou mail déjà existant';}

            }
            else {$error = 'longueur non disponible';}
        }
        else {$error = 'password pas identique';}
    }
    else {$error = 'remplir tout les champs';}

}

?>
<html>
    <head>
        <title> Inscription </title>
        <meta charset="utf-8">
	<link rel="icon" href="logo.png" /> 
 
	<style>

*/

html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}

body {
  font-family: Arial, sans-serif;
  }
 
}
  


.block2 {
	margin-right: 15%;
	margin-left: auto;
	font-size: 30px;
	float:right;
	width:19%;
	padding:18px;
	border: 3px solid red;
	border-radius: 5px;
	background-image: url(Couleurblock.png);
	color: white;
}
 
</style>
<style type="text/css">a:link{text-decoration:none}</style>
 
 
    </head>
 
 
    <body>

    <h1> Inscription </h1>

    <form action="" method="POST">
    <table>
					<tr>
						<td>
    <label for="pseudo">Pseudo : </label> </td> <td>
    <input type="text" name="pseudo" placeholder="Votre pseudo" id ="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>"><br> </td> </tr> <tr> <td>


    <label for="mail">Adresse mail : </label></td> <td>
    <input type="email" name="mail" placeholder="Votre e-mail" id ="pseudo" value="<?php if(isset($mail)) { echo $mail; } ?>"><br></td> </tr> <tr> <td>

    <label for="password">Mot de passe : </label></td> <td>
    <input type="password" name="password" placeholder="Votre mot de passe" id ="pseudo" value="<?php if(isset($password)) { echo $password; } ?>"><br></td> </tr> <tr> <td>
    <label for="password2">Confirmation de mot de passe : </label></td> <td>
    <input type="password" name="password2" placeholder="Comfirmez votre mdp" id ="pseudo" value="<?php if(isset($password2)) { echo $password2; } ?>"><br></td> </tr> <tr> <td>

    <label for="nom">Nom : </label></td> <td>
    <input type="text" name="nom" placeholder="Votre nom" id ="pseudo" value="<?php if(isset($nom)) { echo $nom; } ?>"><br></td> </tr> <tr> <td>

    <label for="prenom">Prenom : </label></td> <td>
    <input type="text" name="prenom" placeholder="Votre prenom" id ="pseudo" value="<?php if(isset($prenom)) { echo $prenom; } ?>"><br></td> </tr> <tr> <td>

    <label for="sexe">Votre sexe : </label></td> <td>
    <input type="radio" name="sexe" value="homme" checked="checked" id="sexe"> Homme 
    <input type="radio" name="sexe" value="femme" id="sexe"/> Femme </td> </tr> <tr> <td></td> </tr> <tr> <td>
    
     // Les informations suivantes ne seront pas affiché : //</td> </tr> <tr> <td></td> </tr> <tr> <td>
    

    <label for="adresse">Adresse postale : </label></td> <td>
    <input type="text" name="adresse" placeholder="Votre adresse postale" id ="pseudo" value="<?php if(isset($adresse)) { echo $adresse; } ?>"><br></td> </tr> <tr> <td>

    <label for="ville">Ville : </label></td> <td>
    <input type="text" name="ville" placeholder="Votre ville" id ="pseudo" value="<?php if(isset($ville)) { echo $ville; } ?>"><br></td> </tr> <tr> <td>  

    <label for="pays">Pays : </label></td> <td>
    <select name="pays" id="pays">
    <option value="france" selected="selected">France</option>
    <option value="belgique">Belgique</option>
    <option value="suisse">Suisse</option>
    <option value="israel">Israel</option>
    </select><br></td> </tr> <tr> <td>  

    <label for="phone">Numéro de téléphone : </label></td> <td>
    <input type="text" name="phone" placeholder="Votre numéro de téléphone" id ="pseudo" value="<?php if(isset($phone)) { echo $phone; } ?>"><br></td> </tr> <tr> 

    </table>
    <br />
    <input type="submit" value="Envoyer" name="forminscription" />
    </form>
    <br />

        <?php if(isset($error)) {echo '<font color="red">Erreur dans le formulaire : '.$error.'</font>';} ?>

    </body>
 
 
 
<html>