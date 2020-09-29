<?php
/*

      .app/controleurs/postsControleur.php

*/

namespace App\Controleurs\Posts;
use \App\Modeles\Post;

function indexAction(\PDO $connexion) {
  // Demander la liste des posts au modèle
  include_once '../app/modeles/postsModele.php';
  $posts = Post\findAll($connexion);
  // Charger la vue index dans $content
  GLOBAL $scripts, $content, $title;
  $scripts .= '<script src="js/posts/index.js"></script>';
  $title = TITRE_POST_INDEX;
  ob_start();
  include '../app/vues/posts/index.php';
  $content = ob_get_clean();
}

function showAction(\PDO $connexion, int $id) {
  // Demander la liste des posts au modèle
  include_once '../app/modeles/postsModele.php';
  $post = Post\findOneById($connexion, $id);
  // Charger la vue index dans $content
  GLOBAL $content, $title;
  $title = $post['titre'];
  ob_start();
  include '../app/vues/posts/show.php';
  $content = ob_get_clean();
}

// ACTIONS AJAX 
function ajaxOlderAction(\PDO $connexion, int $offset) { // Lui balancer l'offset pour pouvoir l'utiliser dans cette fonction
  // Demander la liste des posts au modèle
  include_once '../app/modeles/postsModele.php';
  $posts = Post\findAll($connexion, 4, $offset); // J'en prend 4 à partir du 4e (pour la fonction findAll du indexAction, ça sera 4 à partir du 0 par défaut dans la fonction ) le 2e 4 va remplacer le 0 du offset dans findAll )
  // Charger la vue older dans $scripts (passe par > reponsePHP du www/posts/index.js)
  include '../app/vues/posts/liste.php';
}
