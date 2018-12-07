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
     */
 public static function make(){
     try {
         $opciones = [
             PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
             PDO::ATTR_PERSISTENT => true
         ];
         $connection = new PDO(
             'mysql:host=php7.local;dbname=cursophp7;charset=utf8',
             'userCurso',
             'php',
             $opciones
         );
     }catch (PDOException $PDOException){
         die($PDOException->getMessage());
     }
     return $connection;
 }
}