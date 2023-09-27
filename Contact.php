<?php

/**
 * Class Contact
 * Cette classe représente un contact
 */
class Contact
{
    private ?int $id;
    private ?string $name;
    private ?string $email;
    private ?string $telephone;

    /**
     * Constructeur de la classe Contact, tous les champs sont optionnels
     * @param int|null $id
     * @param string|null $name
     * @param string|null $email
     * @param string|null $telephone
     */
    public function __construct(int $id = null, string $name = null, string $email = null, string $telephone = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->telephone = $telephone;
    }


    /**
     * Cette méthode permet de créer un contact à partir d'un tableau associatif, 
     * typiquement, le résultat d'un fetch sur une table SQL
     * @param array $array
     * @return Contact
     */
    public static function fromArray(array $array): Contact
    {
        $contact = new Contact();
        $contact->setId($array['id']);
        $contact->setName($array['name']);
        $contact->setEmail($array['email']);
        $contact->setTelephone($array['telephone']);
        return $contact;
    }

    public function toString() {
        return $this->id . ", " . $this->name . ", " . $this->email . ", " . $this->telephone . "\n";
    }

    // Liste des setters et getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): void
    {
        $this->telephone = $telephone;
    }


}