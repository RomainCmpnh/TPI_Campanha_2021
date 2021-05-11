<?php

require_once 'commons/model/DbConnection.php';
require_once 'uc/user/model/User.php';

class command
{
    protected $idCommand;

    protected $commandStatus;

    protected $commandDate;

    protected $idUser;

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


    public function getCommandStatus(): ?string
    {
        return $this->commandStatus;
    }

    public function setCommandStatus($commandStatus)
    {
        $this->commandStatus = $commandStatus;
    }

    public function getCommandDate(): ?string
    {
        return $this->commandDate;
    }

    public function setCommandDate($commandDate)
    {
        $this->commandDate = $commandDate;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(?int $id)
    {
        $this->idUser = $id; 
    }


    public static function Add(command $command) : ?int
     {
         $sql = "INSERT INTO commands(commandStatus,commandDate,idUser) 
                 VALUES(:commandStatus, :commandDate, :idUser)";
         $req = DbConnection::getInstance()->prepare($sql);
         $req->bindParam(':commandStatus',$command->commandStatus,PDO::PARAM_STR);
         $req->bindParam(':commandDate',$command->commandDate);
         $req->bindParam(':idUser',$command->idUser,PDO::PARAM_INT);
         if ($req->execute() == 1)
             return DbConnection::getInstance()->lastInsertId();
         else
             return null;
     }

    // public static function getAll(User $user): array
    // {
    //     $sql = 'SELECT commands_has_items.idCommand, idItem, salePrice, quantity 
    //     FROM commands_has_items 
    //     INNER JOIN commands
    //     ON commands_has_items.idCommand = commands.idCommand 
    //     WHERE commandStatus = "Basket" AND idUser =:idUser';
    //     $req = DbConnection::getInstance()->prepare($sql);
    //     $userId = $user->getIdUser();
    //     $req->bindParam(':idUser',$userId,PDO::PARAM_INT);
    //     $req->execute();
    //     $req->setFetchMode(PDO::FETCH_OBJ);
    //     return $req->fetchAll();
    // }

  

     
    
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
