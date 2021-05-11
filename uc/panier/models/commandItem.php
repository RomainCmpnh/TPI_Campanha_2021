<?php

require_once 'commons/model/DbConnection.php';
require_once 'uc/user/model/User.php';

class commandItem
{
    protected $idCommand;

    protected $idItem;

    protected $salePrice;

    protected $quantity;

    public function __construct()
    {
    }

    public function getIdCommand(): ?int
    {
        return $this->idCommand;
    }

    public function setIdCommand(?int $id)
    {
        $this->idCommand = $id; 
    }

    public function getIdItem(): ?int
    {
        return $this->idItem;
    }

    public function setIdItem(?int $id)
    {
        $this->idItem = $id; 
    }

    public function getSalePrice(): ?int
    {
        return $this->salePrice;
    }

    public function setSalePrice(int $salePrice)
    {
        $this->salePrice = $salePrice;
    }
    
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }
    public static function getAll(User $user): array
    {
        $sql = 'SELECT commands_has_items.idCommand, idItem, salePrice, quantity 
        FROM commands_has_items 
        INNER JOIN commands
        ON commands_has_items.idCommand = commands.idCommand 
        WHERE commandStatus = "Basket" AND idUser =:idUser';
        $req = DbConnection::getInstance()->prepare($sql);
        $userId = $user->getIdUser();
        $req->bindParam(':idUser',$userId,PDO::PARAM_INT);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_OBJ);
        return $req->fetchAll();
    }

    public static function Add(commandItem $commandItem) : ?int
    {
        $sql = "INSERT INTO commands_has_items(idCommand,idItem,salePrice,quantity) 
                VALUES(:idCommand, :idItem , :salePrice, :quantity)";
        $req = DbConnection::getInstance()->prepare($sql);
        $req->bindParam(':idCommand',$commandItem->idCommand,PDO::PARAM_INT);
        $req->bindParam(':idItem',$commandItem->idItem,PDO::PARAM_INT);
        $req->bindParam(':salePrice',$commandItem->salePrice,PDO::PARAM_INT);
        $req->bindParam(':quantity',$commandItem->quantity,PDO::PARAM_INT);
        return $req->execute();
 
    }

     
    
    //  public static function Delete(Item $item) : bool
    //  {
    //      $sql = "DELETE FROM items WHERE idItem = :idItem";
    //      $req = DbConnection::getInstance()->prepare($sql);
    //      $req->bindParam(':idItem',$item->getIdItem(),PDO::PARAM_INT);
    //      return $req->execute();
    //  }
 

    // public static function FindById($id): Item
    // {
    //     $sql = "SELECT idItem as idItem, name, description,price, manufacturer,partNumber, published, idCategory FROM items WHERE idItem= :idItem";
    //     $req = DbConnection::getInstance()->prepare($sql);
    //     $req->setFetchMode(PDO::FETCH_CLASS, 'Item');
    //     $req->bindParam(':idItem', $id, PDO::PARAM_INT);
    //     $req->execute();
    //     $r = $req->fetch();
    //     if ($r === false) {
    //         $r = null;
    //     }
    //     return $r;
    // }
}