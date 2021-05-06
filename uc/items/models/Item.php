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

      /**
     * getAllCategoriesBelongingTo fournit la liste de toutes les sous-catégories à partir d'une catégorie.
     * La construction ici est faite de manière statique et correspond au contenu de la table category fournie en début de TPI
     *
     * @param  mixed $idCategory id de la catégorie dont on souhaite connaître toutes les sous-catégories.
     * @return array tableau comprenant toutes les sous-catégories, ainsi que la catégorie passée en paramètre
     */
    public static function getAllCategoriesBelongingTo(?int $idCategory=null) : ?array{
        
        switch ($idCategory){
            case null : $result = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18); break;
            case 1: $result = array(1,3,4,5); break;
            case 2: $result = array(2,6,7,8,9,10,11,12,13,14,15,16,17,18); break;
            case 3: $result = array(3); break;
            case 4: $result = array(4); break;
            case 5: $result = array(5); break;
            case 6: $result = array(6); break;
            case 7: $result = array(7); break;
            case 8: $result = array(8); break;
            case 9: $result = array(9); break;
            case 10: $result = array(10); break;
            case 11: $result = array(11); break;
            case 12: $result = array(12); break;
            case 13: $result = array(13,14,15,16,17,18); break;
            case 14: $result = array(14); break;
            case 15: $result = array(15); break;
            case 16: $result = array(16); break;
            case 17: $result = array(17); break;
            case 18: $result = array(18); break;
            default: $result = array();
        }
        return $result;
    }

    public static function getAllCategories() : array {

        return array(
             1=>'Ordinateurs',
             2=>'Composants',
             3=>'Ordinateurs de bureau',
             4=>'Ordinateurs portables',
             5=>'Tablettes',
             6=>'Processeurs',
             7=>'Cartes mères',
             8=>'Mémoire RAM',
             9=>'Cartes graphiques',
             10=>'Boîtiers',
             11=>'Alimentations',
             12=>'Refroidissement',
             13=>'Stockage', 
             14=>'SSD',
             15=>'Disques internes HDD',
             16=>'Clés USB',
             17=>'NAS',
             18=>'Lecteurs optiques DVD/BD');
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

    //  public static function Add(Item $item) : ?int
    //  {
    //      $sql = "INSERT INTO item(description,price,manufacturer,partNumber,published,idCategory) 
    //              VALUES(:description, :price, :manufacturer , :partNumber , :published, )";
    //      $req = DbConnection::getInstance()->prepare($sql);
    //      $req->bindParam(':word',$definition->word,PDO::PARAM_STR);
    //      $req->bindParam(':definition',$definition->definition,PDO::PARAM_STR);
    //      $req->bindParam(':idOwner',$definition->idOwner,PDO::PARAM_INT);
    //      if ($req->execute() == 1)
    //          return DbConnection::getInstance()->lastInsertId();
    //      else
    //          return null;
    //  }

    
    public static function delete(Item $item): void
    {
        $sql = "DELETE FROM `ecommerce`.`items` WHERE (`idItem` = :idItem)";
        $req = DbConnection::getInstance()->prepare($sql);
        $req->bindParam(":idItem", $item->idItem);
        $req->execute();
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
