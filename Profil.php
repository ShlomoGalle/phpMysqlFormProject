<?php
session_start();
 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=', '', '');

if(isset($_POST['deconnexion']))
{
    var_dump ('debug');
    $_SESSION = array();
    session_destroy();
    header('Location : http://havafloserveur.esy.es/');
}

if(isset($_GET['id']) AND $_GET['id'] > 0)
{
$getid = intval($_GET['id']);

$req = $bdd->prepare('SELECT pseudo, mail, password, nom, prenom, sexe, adresse, ville, pays, phone, admin  FROM membre WHERE id = ?');
$req->execute(array($_SESSION['id']));
$realuserinfo = $req->fetch();

$req = $bdd->prepare('SELECT pseudo, mail, nom, prenom, sexe, pays  FROM membre WHERE id = ?');
$req->execute(array($getid));
$fakeuserinfo = $req->fetch();


if(isset($_POST['retour']))
{
    header("Location: Profil.php?id=".$_SESSION['id']);
}

if(isset($_POST['confirmer']))
{
    require('ModifierProfil.php');
}

?>



<html>
    <head>
        <title> Connexion </title>
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
 
</style>

<style type="text/css">a:link{text-decoration:none}</style>
 
 
   </head>
 
 
<body>
    
    <h1> PROFIL :  </h1>

    <br />

<?php 
if(!isset($_POST['modifier']))
{
?>
<form method="POST" action="">
    <table style="width:100%">
    <tr>
        <td>Pseudo : <?php echo $fakeuserinfo['pseudo'] ?> </td>
        <td>Mail : <?php echo $fakeuserinfo['mail'] ?> </td>
        <td>Pays : <?php echo $fakeuserinfo['pays'] ?> </td>
<?php if($getid == $_SESSION['id']) { ?>
        <td>Adresse : <?php echo $realuserinfo['adresse'] ?> </td>
        <td>Ville : <?php echo $realuserinfo['ville'] ?> </td>
<?php    } ?>
    </tr>
    <tr>
        <td>Nom : <?php echo $fakeuserinfo['nom'] ?> </td>
        <td>Prenom : <?php echo $fakeuserinfo['prenom'] ?> </td>
        <td>Sexe : <?php echo $fakeuserinfo['sexe'] ?> </td>
<?php if($getid == $_SESSION['id']) { ?>
        <td>Password : <?php echo $realuserinfo['password'] ?> </td>
        <td>Numéro de téléphone : <?php echo $realuserinfo['phone'] ?> </td>
<?php    } ?>
     </tr>
    </table>

    <br />
    <tr>

    <input type="submit" name="deconnexion" value="Deconnexion" /> 
    <tr>
    </tr>
    <?php if($getid == $_SESSION['id']) { ?>
    <input type="submit" name="modifier" value="Modifier mes infos" /> </form> </tr>

    <?php    } 
    else {
    ?>
    <form method="POST" action=""> <input type="submit" name="retour" value="Retour vers mon profil" /> </form>
    <?php
    }
    ?>

<?php
}
else {
?>
<form method="POST" action="">
<table style="width:100%">
    <tr>
        <td>Pseudo : <input type="text" name="pseudo" placeholder="Votre pseudo" value="<?php echo $fakeuserinfo['pseudo']; ?>"/> </td>
        <td>Mail : <input type="email" name="mail" placeholder="Votre mail" value="<?php echo $fakeuserinfo['mail']; ?>"/> </td>
        <td>Pays : <input type="text" name="pays" placeholder="Votre pays" value="<?php echo $fakeuserinfo['pays']; ?>"/> </td>
<?php if($getid == $_SESSION['id']) { ?>
        <td>Adresse : <input type="text" name="adresse" placeholder="Votre adresse" value="<?php echo $realuserinfo['adresse']; ?>"/> </td>
        <td>Ville : <input type="text" name="ville" placeholder="Votre ville" value="<?php echo $realuserinfo['ville']; ?>"/> </td>
<?php    } ?>
    </tr>
    <tr>
        <td>Nom : <input type="text" name="nom" placeholder="Votre nom" value="<?php echo $fakeuserinfo['nom']; ?>"/> </td>
        <td>Prenom : <input type="text" name="prenom" placeholder="Votre prenom" value="<?php echo $fakeuserinfo['prenom']; ?>"/> </td>
        <td>Sexe : <input type="text" name="sexe" placeholder="Votre sexe" value="<?php echo $fakeuserinfo['sexe']; ?>"/> </td>
<?php if($getid == $_SESSION['id']) { ?>
        <td>Password : <input type="text" name="password" placeholder="Votre mot de passe" value="<?php echo $realuserinfo['password']; ?>"/> </td>
        <td>Numéro de téléphone : <input type="text" name="phone" placeholder="Numéro de téléphone" value="<?php echo $realuserinfo['phone']; ?>"/> </td>
<?php    } ?>
     </tr>
    </table>


<br />
<tr>
    <input type="submit" name="deconnexion" value="Deconnexion" /> 
    </tr>
    <tr>
    <?php if($getid == $_SESSION['id']) { ?>
    <input type="submit" name="confirmer" value="Confirmer la modification" /> </tr>  
    </form> 
    <?php    } 
    else {
    ?>
    <form method="POST" action=""> <input type="submit" name="retour" value="Retour vers mon profil" /> </form> 
    <?php
    }
    ?>
    
<?php
}
?>

    <?php if(isset($error)) {echo '<font color="red">Erreur dans le formulaire : '.$error.'</font><br />';} ?>
    
    <br />

    <a href="http://havafloserveur.esy.es/ToutUser.php"> Liste de tout les Users </a>

    
    <br />

    <a href="http://havafloserveur.esy.es/selectable.html"> FullCalendar </a>

</body>
 
</html>
<?php 
}
else echo 'Error ID invalid';
?>