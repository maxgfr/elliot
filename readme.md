# Isep Project
Projet scolaire consistant à réaliser un site permettant de gérer des capteurs.

L'utilisation des framework et library est strictement interdit.

## Le controller :

La première étape est d'ajouter des méthodes à un controller. Dans notre cas, nous souhaitons que seul les utilisateurs connectées puisse gérer les capteurs.

![alt text](https://github.com/maxgfr/elliot/blob/master/tutoriel/controllerauth.png)

Le but du controller est de faire des appels au model. En fonction du résultat issu de ce modèle nous afficherons des vues d'erreurs ou de succès.

![alt text](https://github.com/maxgfr/elliot/blob/master/tutoriel/controller.png)

## Le model :

Le model va interragir avec la base de données. Le résultat est renvoyé par la suite au controller.

![alt text](https://github.com/maxgfr/elliot/blob/master/tutoriel/model.png)

## Les vues:

### La configuration :

Nous devons configurer les vues que nous allons renvoyer à l'utilisateur dans /mvc/Config/Config.php

![alt text](https://github.com/maxgfr/elliot/blob/master/tutoriel/config.png)

### La création:

Nous pouvons maintenant réaliser ces vues.

![alt text](https://github.com/maxgfr/elliot/blob/master/tutoriel/vue.png)
