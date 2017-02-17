<?php

namespace myProject\Forum\Models;


class PersonneDTO
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $nom;
    /**
     * @var string
     */
    private $prenom;
    /**
     * @var \DateTime
     */
    private $dateNaissance;
    /**
     * @var int
     */
    private $adresseId;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return PersonneDTO
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     * @return PersonneDTO
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     * @return PersonneDTO
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @return string
     */
    public function getDateNaissanceForSQL()
    {
        return $this->dateNaissance->format('Y-m-d');
    }

    /**
     * @param \DateTime $dateNaissance
     * @return PersonneDTO
     */
    public function setDateNaissance(DateTime $dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdresseId()
    {
        return $this->adresseId;
    }

    /**
     * @param mixed $adresseId
     * @return PersonneDTO
     */
    public function setAdresseId($adresseId)
    {
        $this->adresseId = $adresseId;
        return $this;
    }


}