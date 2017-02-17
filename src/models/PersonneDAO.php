<?php

namespace myProject\Forum\Models;


class PersonneDAO implements IDAO, IPersonneDAO
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @var \PDOStatement
     */
    private $selectStatement;

    /**
     * PersonneDAO constructor.
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupération d'une personne en fonction de son id
     * @param integer $id
     * @return array : un tableau associatif des données de la personne
     */
    public function findOneById(int $id): PersonneDAO
    {
        $sql = "SELECT * FROM personnes WHERE id=?";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$id]);
        $this->selectStatement = $statement;
        return $this;
    }

    private function getResults($data)
    {
        if (!$data) {
            throw new \Exception("Aucun résultat pour cette requête");
        } else {
            return $data;
        }
    }

    public function getOneAsArray()
    {
        $data = $this->selectStatement->fetch(\PDO::FETCH_ASSOC);
        return $this->getResults($data);
    }

    public function getOneAsEntity()
    {
        $this->selectStatement->setFetchMode(\PDO::FETCH_CLASS, PersonneDTO::class);
        $data = $this->selectStatement->fetch();
        return $this->getResults($data);
    }

    /**
     * Création d'une clause order by en fonction d'un tableau associatif
     * des colonnes (clef) et du sens du tri (valeurs)
     * @param array $orderBy
     * @return string
     */
    private function getOrderByClause(array $orderBy): string
    {
        $order = [];
        $sql = "";

        foreach ($orderBy as $key => $val) {
            //TODO tester que $val est égal à ASC ou DESC
            array_push($order, "$key $val");
        }

        if (count($order) > 0) {
            $sql = " ORDER BY " . implode(', ', $order);
        }

        return $sql;
    }

    /**
     * Création d'une clause LIMIT à partir d'un tableau ordinal
     * où la première position correspond à la limite
     * et la deuxième à l'offset (décalage)
     * @param array $limit
     * @return string
     */
    private function getLimitClause(array $limit): string
    {
        $sql = "";

        //Définition de la limite
        if (isset($limit[0]) && (int)$limit[0] > 0) {
            $sql .= " LIMIT " . $limit[0];

            //Définition du décalage
            if (isset($limit[1]) && (int)$limit[1] > 0) {
                $sql .= " OFFSET " . $limit[1];
            }
        }

        return $sql;
    }

    /**
     * Récupération de l'ensemble des lignes de la table personne
     * @param array $orderBy
     * @param array $limit
     * @return array : un tableau ordinal de tableaux associatifs
     */
    public function findAll(array $orderBy = [], array $limit = []): array
    {
        $sql = "SELECT * FROM personnes";

        //Constitution de l'éventuelle clause ORDER BY
        $sql .= $this->getOrderByClause($orderBy);

        //constitution de l'éventuelle clause LIMIT
        $sql .= $this->getLimitClause($limit);

        $resultSet = $this->pdo->query($sql);
        return $resultSet->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Récupération de l'ensemble des lignes de la table personne
     * en fonction de critères passés dans le tableau $search
     * @param array $search
     * @return array : un tableau ordinal de tableaux associatifs
     */
    public function find(array $search, array $orderBy = [], array $limit = []): array
    {
        //Requête de base
        $sql = "SELECT * FROM personnes";

        $sql = $this->getWhereClause($search, $sql);

        //Constitution de l'éventuelle clause ORDER BY
        $sql .= $this->getOrderByClause($orderBy);

        //constitution de l'éventuelle clause LIMIT
        $sql .= $this->getLimitClause($limit);

        //Préparation de la requête
        $statement = $this->pdo->prepare($sql);
        //Exécution de la requête
        $statement->execute($search);

        return $statement->fetchAll(\PDO::FETCH_ASSOC);

    }

    /**
     * Constitution de la clause WHERE en fonction d'un tableau associatif $search
     * où la clef correspond au nom de la colonne
     * et la valeur correspond à la valeur recherchée (avec l'opérateur de comparaison)
     * @param array $search
     * @param $sql
     * @return string
     */
    private function getWhereClause(array &$search, $sql): string
    {
        //Constitution de la clause WHERE
        $query = [];
        foreach ($search as $key => $val) {
            $simpleOperatorsPattern = "/(=|!=|<>|<|>|>=|<=|LIKE)([ ]?.*)/i";
            preg_match($simpleOperatorsPattern, $val, $matches);
            if ($matches) {
                array_push($query, "$key " . $matches[1] . " :$key");
                $search[$key] = trim($matches[2]);
            }

        }
        //Ajout de la clause WHERE à la requête de base
        //uniquement s'il y a des paramètres dans $query
        if (count($query) > 0) {
            $sql .= " WHERE " . implode(" AND ", $query);
            return $sql;
        }

        return $sql;
    }

    /**
     * Suppression d'une personne en fonction de son id
     * @param int $id
     * @return bool
     */
    public function deleteOneById(int $id): bool
    {
        $success = false;
        $sql = "DELETE FROM personnes WHERE id=?";

        if ($id > 0) {
            $statement = $this->pdo->prepare($sql);
            $statement->execute([$id]);
            $success = $statement->rowCount() == 1;
        }
        return $success;
    }

    /**
     * Insertion d'une personne
     * @param PersonneDTO $dto
     * @return int
     */
    private function insert(PersonneDTO $dto): int
    {
        $sql = "INSERT INTO personnes (nom, prenom, date_naissance, adresse_id) 
                VALUES (:nom, :prenom, :dateNaissance, :adresseId)";

        $params = [
            'nom' => $dto->getNom(),
            'prenom' => $dto->getPrenom(),
            'dateNaissance' => $dto->getDateNaissanceForSQL(),
            'adresseId' => $dto->getAdresseId()
        ];

        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);

        return $this->pdo->lastInsertId();
    }

    /**
     * Mise à jour d'une personne
     * @param PersonneDTO $dto
     */
    private function update(PersonneDTO $dto)
    {
        $sql = "UPDATE personnes SET 
                      nom=:nom, prenom=:prenom, 
                      date_naissance=:dateNaissance, 
                      adresse_id=:adresseId
                      WHERE id=:id";

        $params = [
            'nom' => $dto->getNom(),
            'prenom' => $dto->getPrenom(),
            'dateNaissance' => $dto->getDateNaissanceForSQL(),
            'adresseId' => $dto->getAdresseId(),
            'id' => $dto->getId()
        ];

        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);
    }

    public function save(PersonneDTO &$dto)
    {
        if ($dto->getId()) {
            $this->update($dto);
        } else {
            $pk = $this->insert($dto);
            $dto->setId($pk);
        }
    }
}