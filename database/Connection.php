<?php
/**
 * Created by PhpStorm.
 * User: Pauessa
 * Date: 07/12/2018
 * Time: 10:01
 */

class Connection
{
    /**
     * @return PDO
     * @throws AppException
     */
 public static function make(){

     try{
         $config=App::get('config')['database'];
         $connection=new PDO(
             $config['connection'] . ';dbname=' . $config['name'] ,
             $config['username'],
             $config['password'],
             $config['options']
         );
     }catch (PDOException $PDOException){
         throw new AppException("no se ha podido conectar a la BDA");
//         die($PDOException->getMessage());
     }
     return $connection;
 }
}