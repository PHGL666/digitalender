CONSTRUCTION FLOW

- Création de la Database

- Création des Entity

- Création des Fixtures (données fictives)

- Création du login pour checker si les les évènements peuvent être modifier en admin / user ou non
    modification de l'algorithme de securité en auto à la place d'argon dans le fichier packages/security.yaml
    
- CRUD Event pour créer : Proposer nouvel événement. Création automatique du fichier Controller / Form / template twig: remove : edit : new : form : index : show

- Modifications des fichiers ( services.yaml / EventController.php / EventType) afin d’inclure les images ainsi que : get user et get slugg.
    Ajout d'un dossier service pour y créer la classe SLUGGER
    
- Découpage du fichier html de pierre pour intégrer dans les twigs et les rendres dynamiques avec des BLK.
  
- Ajout d'une page admin avec composer req admin
    modification dans easyadmin.yaml des entity


    
    
    