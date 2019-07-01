# Symfony

## Installation

```
composer create-project symfony/skeleton my-project
```
que le squelette
ou

```
composer create-project symfony/website-skeleton my-project
```
twig et divers package en plus du squelette

Activer le plugin Symfony dans PHPStorm pour que l'autocomplétion soit activée.

Pour afficher toutes les commandes Symfony de base : 
php bin/console

obs : en installant l'orm Doctrine nous verrons que des commandes supp apparaîtront.

### Afficher les commandes Symfony

```shell
php bin/console
```

### Vérifier les pré-requis
```shell
composer require requirements-checker
```
ensuite dans le navigateur localhost/public/(rajouter à la main)check.php
afin de voir les conseils de symfony.
Une fois les mise à jour et corrections apportées on peut désinstaller composer.
```shell
composer remove requirements-checker
```

### Installer le serveur interne de Php
```shell
composer require symfony/web-server-bundle --dev
```

```shell
php bin/console server:run
```
ctrl+c pour couper le serveur et rendre le terminal disponible

ou

```shell
php bin/console server:start
php bin/console server:stop
```

### Installer Maker Bundel
```shell
composer require maker --dev
```

nous voyons que des commandes "make" supp ont été installées. Avec php bin/console list make nous pouvons les afficher.

obs : la bibliotheque config/packages/bundles.php s'incrémente automatiquement

INSTALLATION TERMINEE

## Doctrine

```shell
composer req orm
```

```shell
composer require orm
```

**Appeler la BDD :**
dans le dossier racine, fichier .env nous y avons la ligne DATABASE_URL
il ne faut pas modifier ce fichier donc nous créons un nouveau fichier .env.local dans lequel nous copions la ligne DATABASE et on met à jour la ligne qui fait appel à la BDD
.env : 
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
.env.local :
DATABASE_URL=mysql://root:@127.0.0.1:3306/symfony

obs : les commandes intègrent dorénavant celle de Doctrine : php bin/console list doctrine

## Création

Créer la base de données (vide) :

```shell
php bin/console doctrine:database:create
```

Pour la supprimer :

```shell
php bin/console doctrine:database:drop --force
```

### Création Entity CODE FIRST : 

**Créer les fichiers Entity avec Maker**
exemple : fichier category
```shell
php bin/console make:entity Category
```
puis on ajoute les colonnes de la table.

puis on créé le fichier de migration
```shell
php bin/console make:migration
```
puis on procède à la migration du/des fichiers
```shell
php bin/console doctrine:migrations:migrate
```

## Création des fixtures (données de test dans la BDD)

installer le bundle suivant :
```shell
composer require --dev orm-fixtures
```

Dans DataFixtures/AppFixtures.php 
=> pas soucis de lisibilité nous le supprimons et le récréons avec maker pour le renommer.
```shell
php bin/console make:fixtures
```
nous créons dons un fichier que nous allons nommer CategoryFixtures.

Dans ce fichier nous ajoutons des données manuellement
> ajouter le use
> ajouter les données

```shell
php bin/console doctrine:fixtures:load
```

OBS : il faut refaire la commande fixtures:load en cas de modification manuelle des fichiers fixtures.

Pour appeler les données d'un fichier fixtures à un autre il faut employer le 
setReference
et le 
getReference

Pour que les données soient chargées dans le bon ordre, il faut implémenter une méthode dans la class :
implements DependentFixtureInterface

## ROUTEUR - CONTROLEUR - VUE

> Créer un contrôleur avec le make
```shell
php bin/console make:controller
```
ensuite avec /default dans l'url cela affiche le message du controller.

Si sur serveur Apache il faut au préalable installer le pack suivant :
```shell
composer require symfony/apache-pack
```

> Installer TWIG Template
```shell
 composer req twig
```

OBS : pour pouvoir faire fonctionner les @Param converter, il faut installer
```shell
composer req annotations
```

## PROFILER PACK
installe la barre de debug qui apparait dans le navigateur en bas
```shell
composer req profiler --dev
```


---

**OBS :** un include appelle seulement un template mais pas la base de donnée.
On utilise donc une méthode spécifique RENDER(CONTROLLER :
{{render(controller('cheminducontrolleurrouteur'))}}

exemple avec le footer. 

---

## WEBPACK ENCORE & NPM RUN WATCH // SCSS
permet de compiler les fichiers scss dans symfony

installation Webpack Encore :
```shell
composer req encore
```

installation NPM :
```shell
npm install
```

> dans dossier racine fichier webpack.config.js on doit décommenter les lignes que l'on souhaite pour les activer
exemple ici ligne 57 pour autoriser l'utilisation du compilateur sass

du coup il faut installer sass loader 
```shell
npm install sass-loader@^7.0.1 node-sass --save-dev
```

> dans assets/css on renomme fichier app.css en scss
> dans assets/js dans le fichier app.js on renomme .css en scss dans le require ligne 9

puis pour la compilation des fichiers :
```shell
npm run watch
```

---
obs : code Ajax, c'est le javascript qui appelle le serveur

## Images statiques versus Images Dynamique

### Images Statiques :
il convient pour ces dernières de procéder de façon automatique. Dans webpack.config.js on ajoute une méthode copyFiles afin de copier les images de asset à images dans public/build, qui sera généré automatique et se mettre à jour automatiquement grâce au npm run watch.

### Images Dynamique
images de la bdd.

nous créons dossier uploads dans lequel nous copions les images "dynamiques".

Exemple dans templates/article/show.html.twig

---
obs : fonction dump, ex dump($articles); permet d'afficher sur le nav le contenu de la variable.


## FORMULAIRES

### Installation des pack form & validator
obs :
```shell
composer req form
composer req validator
```

objet formbuilder

### Validation du formulaire
créer un use dans Entity/Category.php :
use Symfony\Component\Validator\Constraints as Assert;
rajouter dans les annotations de ce même fichier ligne 24, exemple : 
* @Assert\iban
on peut insérer autant d'Assert que l'on veut.

---
obs : ctrl + alt + o   =  supprime automatiquement les use inutiles


# CRUD
crud permet d'auto créer tous les fichiers php et twig, et les routes.


installer au préalable la sécurité csrf
```shell
composer req security-csrf
```

puis
```shell
php bin/console make:crud
```

---

# Installation Bootstrap plus popper et jquerry

```shell
 npm install bootstrap

npm install jquery popper.js
```

puis dans assets/css/app.scss on ajoute la ligne 
@import "~bootstrap/scss/bootstrap";
qui permet d'importer le scss de bootstrap.

puis dans app.js on active la ligne require de jquerry (ligne 12)
et on rajoute la ligne 
require('bootstrap');


# SECURITY

```shell
composer req security
```
créé entre autre le fichier security.yaml dans config/packages/test/

création d'un utilisateur dans Entity
```shell
php bin/console make:user
```

---
OBS : pour VIDER la base de donnée et la RECREER :
```shell
php bin/console doctrine:database:drop --force

php bin/console doctrine:database:create

```

## Générer le formulaire d'AUTHENTIFICATION 
## CREER LOGIN / LOGOUT
génération du dossier Security et update du fichier security.yaml
```shell
php bin/console make:auth
```
nom du fichier php : LoginFormAuthenticator

### LOGIN
dans le fichier crée ici LoginFormAuthentificator
supprimer ligne 89
mettre à jour ligne 88

### LOGOUT
**security.yaml**
on ajoute à ligne 22
            logout:
                path:   app_logout
RESPECTER l'INDENTATION SINON ERREUR
               
**routes.yaml**
app_logout:
  path: /logout
  methods: GET
  
---
OBS : pour pouvoir créer un commentaire, il faut associer la création d'un commentaire à l'utilisateur en cours. Dans CommentController.php il faut ajouter donc la ligne :
$comment->setUser($this->getUser());

dans security.yaml
on décommente les 2 lignes pour qu'une personne non connecté ne puisse pas accéder à la page profile.
l'accent circonflexe ^ veut dire COMMENCE PAR
    access_control:
          - { path: ^/admin, roles: ROLE_ADMIN }
          - { path: ^/profile, roles: ROLE_USER }
---

## Générer le formulaire d'ENREGISTREMENT 
```shell
php bin/console make:registration-form
```

#BUNDLE ADMIN

```shell
composer require admin
```

dans le fichier
translation.yaml => modifier la langue en fr
esay_admin.yaml => tout décommenter et rajouter le cas échéant les Entity qui manquent.

dans l'url du nav accéder à l'admin avec SERVEUR/admin


# SERVICE

## Commandes

```shell
php bin/console list router

php bin/console debug:router

php bin/console debug:autowiring
```

création du dossier service

## SLUGGER
Slug = ce qu'on met dans l'url, on remplace les espace par un tiret par exemple etc.
dans dossier service :
création manuel fichier class slugger.php
création de la méthode slugify + copie doc

AJOUT DANS ARTICLE de FIXTURES d'une table slug
validation des paramètres de création

migrations + migrate

Fixtures:
ensuite dans ArticlesFixtures on ajoute le CONSTRUCT
qu'on met à jour avec l'instanciation $this
OBS : si on utilise l'autocomplétion le use se met à jour sinon rajouter manuellement le USE.
puis mettre à jour les données articles avec exemple :
$article1->setSlug($this->slugger->slugify($article1->getTitle()));

_thumbnail.html.thig de ARTICLE
remplacer les id par slug

Controller:
puis mise à jour du controller ArticleController
on remplace id par slug
on supprime requirement car il impose un id

# DESIGN PATTERNS



OBS : 
EN DE BUG ET BESOIN DE FAIRE MENAGE DANS LA BASE DE DONNE, procéder comme suit:
```shell
php bin/console doctrine:database:drop --force

php bin/console doctrine:database:create

php bin/console make:migration

php bin/console doctrine:migrations:migrate

php bin/console doctrine:fixtures:load
```







