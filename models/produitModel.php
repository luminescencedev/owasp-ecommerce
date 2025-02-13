<?php 

require_once "../models/database.php";

class Produit
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }

    public function getProduits()
    {
        $stmt = $this->pdo->query('SELECT * FROM produits');
        return $stmt->fetchAll();
    }

    public function addProduit($name, $category, $description, $price, $image)
    {
        if (!is_numeric($price) || $price <= 0) {
            return false;
        }

        if (!filter_var($image, FILTER_VALIDATE_URL) && !file_exists($image)) {
            return false;
        }

        $stmt = $this->pdo->prepare('INSERT INTO produits (name, category, description, price, image) 
                                     VALUES (:name, :category, :description, :price, :image)');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);

        return $stmt->execute();
    }


    public function getProduit($id)
    {
        if (!filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]])) {
            return false;
        }

        $stmt = $this->pdo->prepare('SELECT * FROM produits WHERE id_produit = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function updateProduit($id, $category, $name, $description, $price, $image)
    {
        if (!is_numeric($price) || $price <= 0) {
            return false;
        }

        $stmt = $this->pdo->prepare('UPDATE produits SET name = :name, category = :category, description = :description, price = :price, image = :image WHERE id_produit = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function deleteProduit($id)
    {
        if (!filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]])) {
            return false;
        }

        $stmt = $this->pdo->prepare('DELETE FROM produits WHERE id_produit = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}