<?php

require_once 'commons/model/DbConnection.php';

class Item
{
    protected $idItem;

    protected $name;

    protected $description;

    protected $price;

    protected $manufacturer;

    protected $partNumber;

    protected $published;

    protected $idCategory;

    public function __construct()
    {
    }

    public function getIdItem(): ?int
    {
        return $this->idItem;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price)
    {
        $this->price = $price;
    }
    
    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    public function getPartNumber(): ?string
    {
        return $this->partNumber;
    }

    public function setPartNumber(string $partNumber)
    {
        $this->partNumber = $partNumber;
    }

    public function getPublished(): ?int
    {
        return $this->published;
    }
    public function setPublished(string $published)
    {
        $this->published = $published;
    }
    public function getIdCategory(): ?int
    {
        return $this->idCategory;
    }
    public function setIdCategory(int $idCategory)
    {
        $this->idCategory = $idCategory;
    }

    public static function getAll(): array
    {
        $sql = 'SELECT idItem as idItem, name, description,price, manufacturer,partNumber, published, idCategory FROM items;';
        $req = DbConnection::getInstance()->prepare($sql);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_OBJ);
        return $req->fetchAll();
    }

    // public static function insert(string $content, int $idSender): void
    // {
    //     $sql = "INSERT INTO messages (content, idSender) VALUES (:content, :idSender);";
    //     $req = DbConnection::getInstance()->prepare($sql);
    //     $req->bindParam(":content", $content, PDO::PARAM_STR);
    //     $req->bindParam(":idSender", $idSender, PDO::PARAM_INT);
    //     $req->execute();
    // }

    
    public static function delete(Item $item): void
    {
        $sql = "DELETE FROM `ecommerce`.`items` WHERE (`idItem` = :idItem)";
        $req = DbConnection::getInstance()->prepare($sql);
        $req->bindParam(":idItem", $item->idItem);
        $req->execute();
    }

    public static function FindById(int $id): Item
    {
        $sql = "SELECT idItem as idItem, name, description,price, manufacturer,partNumber, published, idCategory FROM items WHERE idItem= :id";
        $req = DbConnection::getInstance()->prepare($sql);
        $req->setFetchMode(PDO::FETCH_CLASS, 'Item');
        $req->bindParam(':idItem', $id, PDO::PARAM_INT);
        $req->execute();
        $r = $req->fetch();
        if ($r === false) {
            $r = null;
        }
        return $r;
    }
}
