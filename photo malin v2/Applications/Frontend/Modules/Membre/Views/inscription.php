<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$message = array();
if (isset($reussite) && $reussite)
{
    $message['reussi'] = ("compte créé");
} else
{
    if (isset($matchpass))
    {
        $message['nomatch'] = ("erreur les mots de passe ne correspondent pas");
    }
    if (isset($reussite) && !$reussite)
    {
        $message['existe'] = ("erreur le pseudo ou le mail existe déja");
    }
    if (isset($erreurs) && in_array(\Library\Entities\Membre::PSEUDO_INVALIDE, $erreurs))
        $message['PSEUDO_INVALIDE'] = 'Le pseudo est invalide.<br />';
    if (isset($erreurs) && in_array(\Library\Entities\Membre::PSEUDO_TROP_LONG, $erreurs))
        $message['PSEUDO_TROP_LONG'] = 'Le pseudo est trop long, 20 caractere  max.<br />';
    if (isset($erreurs) && in_array(\Library\Entities\Membre::MDP_INVALIDE, $erreurs))
        $message['MDP_INVALIDE'] = 'Le mot de passe est invalide.<br />';
    if (isset($erreurs) && in_array(\Library\Entities\Membre::MDP_TROP_COURT, $erreurs))
        $message['MDP_TROP_COURT'] = 'Le mot de passe est trop court 6 caractéres mini.<br />';
    if (isset($erreurs) && in_array(\Library\Entities\Membre::PSEUDO_CARACTERE_SPECIAUX, $erreurs))
        $message['PSEUDO_CARACTERE_SPECIAUX'] = 'Le pseudo ne peut pas contenir de caractere speciaux. <br />';
    if (isset($erreurs) && in_array(\Library\Entities\Membre::MAIL_INVALIDE, $erreurs))
        $message['MAIL_INVALIDE'] = 'Le mail est invalide. <br />';
}
echo (json_encode($message));
