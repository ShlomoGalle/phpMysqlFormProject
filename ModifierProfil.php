<?php


    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $password = htmlspecialchars($_POST['password']);
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $sexe = htmlspecialchars($_POST['sexe']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $ville = htmlspecialchars($_POST['ville']);
    $pays = htmlspecialchars($_POST['pays']);
    $phone = htmlspecialchars($_POST['phone']);

    if(!empty($pseudo) AND !empty($mail) AND !empty($password) AND !empty($nom) AND !empty($prenom) AND !empty($adresse) AND !empty($ville) AND !empty($phone))
    {
        
            if(strlen($pseudo) > 2 AND strlen($pseudo) <15 AND strlen($password) > 2 AND strlen($password) < 15 AND strlen($nom) > 2 AND strlen($nom) < 15 AND strlen($prenom) > 2 AND strlen($prenom) < 15 AND strlen($adresse) > 2 AND strlen($adresse) < 50 AND strlen($ville) > 2 AND strlen($ville) < 30 AND strlen($phone) > 5 AND strlen($phone) < 15)
            {
                if ($pseudo != $realuserinfo['pseudo'])
                    {
                        $reqpseudo = $bdd->prepare('SELECT * FROM membre WHERE pseudo = ?');
                        $reqpseudo->execute(array($pseudo));
                        if ($reqpseudo->rowCount() != 0)
                        {$bool = false;}

                    }
                if ($mail != $realuserinfo['mail'])
                {
                    $reqmail = $bdd->prepare('SELECT * FROM membre WHERE mail = ?');
                    $reqmail->execute(array($mail));
                    if ($reqmail->rowCount() != 0)
                    {$bool = false;}
                }

                if (!isset($bool))
                {
                    if(is_numeric($phone))
                    {
                        if(ctype_alpha($nom) AND ctype_alpha($prenom) AND ctype_alpha($ville))
                        {
                            $req = $bdd->prepare('UPDATE membre SET pseudo=:pseudo, mail=:mail, password=:password, nom=:nom, prenom=:prenom, sexe=:sexe, adresse=:adresse, ville=:ville, pays=:pays, phone=:phone WHERE id = :id');
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
                            'id' => $_SESSION['id']
                            ));
                            header("Location: Profil.php?id=".$_SESSION['id']);
                        }
                        else {$error = 'Prenon, nom ou ville non disponible';}
                    }
                    else {$error = 'Phone non disponible';}

                }
                else {$error = 'pseudo ou mail déjà existant';}

            }
            else {$error = 'longueur non disponible';}
    }
    else {$error = 'remplir tout les champs';}



?>