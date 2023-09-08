<?php

/**
 * Cette classe permet de gérer les interactions avec la table contact. C'est elle qui s'occupe
 * d'écrire les requêtes à la base de données Mysql, mais aussi de transformer les résultats en objets Contact.
 */
class ContactManager
{
    // On crée une propriété privée qui contient l'instance de PDO
    private $db;

    /**
     * Le constructeur de la classe. Il permet d'initialiser la propriété $db
     * Cette propriété contient une classe PDO, fournie par php, et qui pemet d'intéragir avec la base de données
     */
    public function __construct()
    {
        // On récupère l'instance de PDO
        $this->db = DBConnect::getInstance()->getPDO();
    }

    /**
     * Méthode permettant de récupérer tous les contacts de la base de données
     * @return array : un tableau d'objets Contact
     */
    public function findAll(): array
    {
        $query = $this->db->prepare("SELECT * FROM contact");
        $query->execute();

        // On boucle sur les résultats avec fetch pour créer un tableau de Contact
        $contacts = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $contacts[] = Contact::fromArray($row);
        }
        
        return $contacts;
    }

    /**
     * Méthode permettant de récupérer un contact par son id
     * @param int $id : l'id du contact à récupérer
     * @return Contact|null : le contact correspondant à l'id, ou null si aucun contact n'est trouvé
     */
    public function findById(int $id): ?Contact
    {
        $query = $this->db->prepare("SELECT * FROM contact WHERE id = :id");
        $query->execute(["id" => $id]);
        $contact = $query->fetch(PDO::FETCH_ASSOC);
        if (!$contact) {
            return null;
        }
        $contact = Contact::fromArray($contact);
        return $contact;
    }

    /**
     * Méthode permettant de créer un contact dans la base de données
     * @param string $name : le nom du contact
     * @param string $email : l'email du contact
     * @param string $telephone : le téléphone du contact
     * @return Contact : le contact qui vient d'être créé
     */
    public function create(string $name, string $email, string $telephone): Contact
    {
        $query = $this->db->prepare("INSERT INTO contact (name, email, telephone) VALUES (:name, :email, :telephone)");
        $query->execute(["name" => $name, "email" => $email, "telephone" => $telephone]);
        // Récupération du dernier id inséré. 
        $id = $this->db->lastInsertId();
        // On retourne le contact que l'on vient juste de créer
        return $this->findById($id);
    }

    /**
     * Méthode permettant de supprimer un contact de la base de données
     * @param int $id : l'id du contact à supprimer
     */
    public function delete(int $id): void
    {
        $query = $this->db->prepare("DELETE FROM contact WHERE id = :id");
        $query->bindParam(":id", $id);
        $query->execute();
    }
}