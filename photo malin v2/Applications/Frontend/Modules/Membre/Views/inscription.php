<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (isset($reussite) && $reussite)
{
    echo("<p>compte créé</p>");
}
else if (isset($reussite) && !$reussite)
{
    echo("<p>erreur le pseudo ou le mail existe déja</p>");
}
 else {
     if (isset($erreurs) && in_array(\Library\Entities\Membre::PSEUDO_INVALIDE, $erreurs)) echo 'Le pseudo est invalide.<br />';
     if (isset($erreurs) && in_array(\Library\Entities\Membre::PSEUDO_TROP_LONG, $erreurs)) echo 'Le pseudo est trop long, 20 caractere  max.<br />';
     if (isset($erreurs) && in_array(\Library\Entities\Membre::MDP_INVALIDE, $erreurs)) echo 'Le mot de passe est invalide.<br />';
     if (isset($erreurs) && in_array(\Library\Entities\Membre::MDP_TROP_COURT, $erreurs)) echo 'Le mot de passe est trop court 6 caractéres mini.<br />';
     if (isset($erreurs) && in_array(\Library\Entities\Membre::MAIL_INVALIDE, $erreurs)) echo 'Le mail est invalide. <br />';
}
