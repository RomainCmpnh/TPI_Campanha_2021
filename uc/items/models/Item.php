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

    public function setIdItem(?int $id)
    {
        $this->idItem = $id; 
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
        $sql = 'SELECT idItem as idItem, name, description,price, manufacturer,partNumber, published, idCategory FROM items WHERE published = 1;';
        $req = DbConnection::getInstance()->prepare($sql);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_OBJ);
        return $req->fetchAll();
    }

    public static function SearchCount(?string $name): int {
        $name = "%$name%";
        $sql = "SELECT COUNT(*) FROM items
                WHERE name LIKE :name
                OR description LIKE :name
                OR manufacturer LIKE :name";
        $req = DbConnection::getInstance()->prepare($sql);
        $req->bindParam(":name",$name,PDO::PARAM_STR);
        $req->execute();
        return $req->fetchColumn();
    }


    public static function SearchAllOffsetLimit(?string $name,int $offset, int $limit) : array {
        $name = "%$name%";
        $sql =  'SELECT idItem, name, description,price, manufacturer,partNumber, published, idCategory 
                 FROM items
                 WHERE name LIKE :name
                 OR description LIKE :name
                 OR manufacturer LIKE :name
                 LIMIT :offset, :limit';
         $req = DbConnection::getInstance()->prepare($sql);
         $req->setFetchMode(PDO::FETCH_OBJ);
         $req->bindParam(':limit', $limit,PDO::PARAM_INT);
         $req->bindParam(':offset', $offset,PDO::PARAM_INT);
         $req->bindParam(":name",$name,PDO::PARAM_STR);
         $req->execute();
         return $req->fetchAll();
     }

     public static function Add(Item $item) : ?int
     {
         $sql = "INSERT INTO items(name, description,price,manufacturer,partNumber,published,idCategory) 
                 VALUES(:name, :description, :price, :manufacturer , :partNumber , :published, :idCategory)";
         $req = DbConnection::getInstance()->prepare($sql);
         $req->bindParam(':name',$item->name,PDO::PARAM_STR);
         $req->bindParam(':description',$item->description,PDO::PARAM_STR);
         $req->bindParam(':price',$item->price,PDO::PARAM_INT);
         $req->bindParam(':manufacturer',$item->manufacturer,PDO::PARAM_STR);
         $req->bindParam(':partNumber',$item->partNumber,PDO::PARAM_STR);
         $req->bindParam(':published',$item->published,PDO::PARAM_INT);
         $req->bindParam(':idCategory',$item->idCategory,PDO::PARAM_INT);
         if ($req->execute() == 1)
             return DbConnection::getInstance()->lastInsertId();
         else
             return null;
     }

     public static function Update(Item $item) : ?int
     {
         $sql = "UPDATE items SET 
                 name = :name,
                 description = :description,
                 price = :price,
                 manufacturer = :manufacturer,
                 partNumber = :partNumber,
                 published = :published,
                 idCategory = :idCategory
                 WHERE idItem = :idItem";
         $req = DbConnection::getInstance()->prepare($sql);
         $req->bindParam(':name',$item->name,PDO::PARAM_STR);
         $req->bindParam(':description',$item->description,PDO::PARAM_STR);
         $req->bindParam(':price',$item->price,PDO::PARAM_INT);
         $req->bindParam(':manufacturer',$item->manufacturer,PDO::PARAM_STR);
         $req->bindParam(':partNumber',$item->partNumber,PDO::PARAM_STR);
         $req->bindParam(':published',$item->published,PDO::PARAM_INT);
         $req->bindParam(':idCategory',$item->idCategory,PDO::PARAM_INT);
         $req->bindParam(':idItem',$item->idItem,PDO::PARAM_INT);
         if ($req->execute()==1)
             return $item->idItem;
         else 
             return null;
     }
     
    
     public static function Delete(Item $item) : bool
     {
         $sql = "DELETE FROM items WHERE idItem = :idItem";
         $req = DbConnection::getInstance()->prepare($sql);
         $req->bindParam(':idItem',$item->getIdItem(),PDO::PARAM_INT);
         return $req->execute();
     }
 

    public static function FindById($id): Item
    {
        $sql = "SELECT idItem as idItem, name, description,price, manufacturer,partNumber, published, idCategory FROM items WHERE idItem= :idItem";
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
