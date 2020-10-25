<?php
session_start();
 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=', '', '');
 
if(isset($_POST['formconnexion']))
{
	$mail = htmlspecialchars($_POST['mail']);
	$password = htmlspecialchars($_POST['password']);
	if(!empty($mail) AND !empty($password))
	{
		$reqmail = $bdd->prepare('SELECT * FROM membre WHERE mail = ?');
		$reqmail->execute(array($mail));

		if ($reqmail->rowCount() != 0)
		{
			$reqpassword = $bdd->prepare('SELECT * FROM membre WHERE mail = ? AND password = ?');
			$reqpassword->execute(array($mail, $password));

			if($reqpassword->rowCount() != 0)
			{

				$req = $bdd->prepare('SELECT id FROM membre WHERE mail = ?');
				$req->execute(array($mail));
				$_SESSION = $req->fetch();
				
				header("Location: Profil.php?id=".$_SESSION['id']);
			
			} 
			else {$error = 'Mot de passe incorrect';}
		}		
		else {$error = 'Mail inexistant';}
	}
	else {$error = 'Veuillez remplir tout le formulaire';}
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

	<h1> Connexion </h1>

	<form method="POST" action="">
		<table>
			<tr>
				<td>
                    <label for="mail"> Mail :</label>
                </td>
                <td>	
					<input type="email" name="mail" placeholder="Mail" value="<?php if(isset($mail)){ echo $mail; } ?>"/>
				</td>
			</tr>		
			<tr>	
				<td>
                    <label for="password"> Mot de passe :</label>
                </td>
				<td>
					<input type="password" name="password" placeholder="Mot de passe" />    
				</td>
			</tr>
		</table>
		<br />
		<input type="submit" name="formconnexion" value="Se connecter" />
    </form>
    <?php if(isset($error)) {echo '<font color="red">'.$error.'</font>';}?>


	</body>
 
 
</html>