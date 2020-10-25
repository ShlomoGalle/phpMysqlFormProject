<?php
session_start();
 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=', '', '');
 

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
    
	<h1> Tout les users qui existent : </h1>
	<br />
	
	<?php $reponse = $bdd->query('SELECT pseudo, id FROM membre');
	while ($donnees = $reponse->fetch())
	{
		echo '<a href="Profil.php?id='.$donnees['id'].'">'.$donnees['pseudo'].'</a>'.'<br />';
	} 
	
	?>


    </body>
 
<html>