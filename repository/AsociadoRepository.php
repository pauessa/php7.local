<?php

require_once __DIR__ . '/../database/QueryBuilder.php';

class AsociadoRepository extends QueryBuilder
{

    /**
     * ImagenGaleriaRepository constructor.
     * @param string $table
     * @param string $classEntity
     * @throws AppException
     */
    public function __construct(string $table='asociados',string $classEntity='Asociado')
    {
        parent::__construct($table,$classEntity);
    }
}