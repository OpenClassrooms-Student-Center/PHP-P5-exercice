<?php 

/**
 * Cette classe permet de gérer toutes les commandes tapées par l'utilisateur. 
 * En particulier, l'affichage de l'aide et la gestion des commandes list, create et delete
 */
class Command
{
    private $manager;

    /**
     * Le constructeur de la classe. Il permet d'initialiser le manager de Contact
     */
    public function __construct()
    {
        $this->manager = new ContactManager();
    }

    /**
     * Commande "help" : affiche l'aide
     * @return void
     */
    public function help(): void {
        echo "aide : affiche cette aide\n";
        echo "lister : liste les contacts\n";
        echo "créer [nom], [email], [telephone] : crée un contact\n";
        echo "supprimer [id] : supprime un contact\n";
        echo "quitter : quitte le programme\n";
        echo "\n";
        echo "Attention à la syntaxe des commandes, les espaces et virgules sont importants.\n";
    }

    /**
     * Commande "detail" : affiche le détail d'un contact
     * @param int $id L'id du contact à afficher
     * @return void
     */
    public function detail($id): void {
        $contact = $this->manager->findById($id);
        if (!$contact) {
            echo "Contact non trouvé\n";
            return;
        }
        echo $contact->toString();
    }


    /**
     * Commande "list" : affiche la liste des $contacts
     * @return void
     */
    public function list(): void
    {
        $contacts = $this->manager->findAll();
        // Si le tableau de contact est vide, on affiche un message et on arrête l'exécution de la méthode
        if (empty($contacts)) {
            echo "Aucun contact\n";
            return;
        }

        echo "Liste des contacts : \n";
        echo "id, nom, email, telephone\n";
        foreach ($contacts as $contact) {
            echo $contact->toString();
        }
    }

    /**
     * Commande "create" : crée un contact
     * @param string $name Le nom du contact
     * @param string $email L'email du contact
     * @param string $telephone Le téléphone du contact
     * @return void
     */
    public function create($name, $email, $telephone): void
    {
        $contact = $this->manager->create($name, $email, $telephone);
        echo "Contact créé : " . $contact->toString();
    }

    /**
     * Commande "delete" : supprime un contact
     * @param int $id L'id du contact à supprimer
     * @return void
     */
    public function delete($id): void
    {
        $this->manager->delete($id);
        echo "Contact supprimé\n";
    }

}