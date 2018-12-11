<?php
/**
 * Created by PhpStorm.
 * User: Pauessa
 * Date: 07/12/2018
 * Time: 11:33
 */
require_once __DIR__ . '/../exception/QueryException.php';
require_once __DIR__ . '/../core/App.php';

class QueryBuilder
{
    private $connection;
    private $table;
    private $classEntity;


    /**
     * QueryBuilder constructor.
     * @param string $table
     * @param string $classEntity
     * @throws AppException
     */



    public function __construct(string $table,string $classEntity)
    {
        $this->connection=App::getConnection();
        $this->table=$table;
        $this->classEntity=$classEntity;
    }

    /**
     * @param string $table
     * @param string $classEntity
     * @return array
     * @throws QueryException
     */
    public function findAll(){
        $sql="SELECT * FROM $this->table";
        //$this->connection->query($sql);
        $pdostatement=$this->connection->prepare($sql);
         if($pdostatement->execute()===false){
           throw new QueryException("no se ha podido ejecutar la query");
         }

         return $pdostatement->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,$this->classEntity);
    }


}