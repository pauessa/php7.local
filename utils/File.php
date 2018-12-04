<?php

require_once __DIR__ .'/../exception/FileException.php';

class File
{
    private $file;
    private $fileName;

    /**
     * File constructor.
     * @param string $fileName
     * @param array $arrTypes
     * @throws FileException
     */
    public function __construct(string $fileName, array $arrTypes ){
        $this->file=$_FILES[$fileName];
        $this->fileName='';

        if (!isset($this->file)){
            throw new FileException('Debes Selecionar un fichero');
        }
        if ($this->file['error']!== UPLOAD_ERR_OK){
            switch ($this->file['error']){
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                throw new FileException('El fichero es demasiado grande');
                case UPLOAD_ERR_PARTIAL:
                    throw new FileException('No se ha podido subir el fichero completo');
                default:
                    throw new FileException('No se ha podido subir el fichero');
                    break;
            }
        }
         if(in_array($this->file['type'],$arrTypes)===false){
             throw new FileException('Tipo de fichero no soportado');
         }

    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @param $rutaDestino
     * @throws FileException
     */
    public function saveUploadFile($rutaDestino)
    {
       if (is_uploaded_file($this->file['tmp_name'])===false){
            throw new FileException("El archivo no se ha subido con en formulario");
       }
       $this->fileName=$this->file['name'];
       $ruta=$rutaDestino . $this->fileName;
       if(is_file($ruta)===true){
           $idUnico=time();
           $this->fileName=$this->fileName.$idUnico;
           $ruta=$rutaDestino . $this->fileName;
       }
       if(move_uploaded_file($this->file['tmp_name'],$ruta)===false){
           throw new FileException("No se puede Mover el fichero a su destino");
       }
    }
    public function copyFile(string $rutaOrigen,string $rutaDestino){
        $origen=$rutaOrigen.$this->fileName;
        $destino=$rutaDestino.$this->fileName;
        if(is_file($origen)===false){
            throw new FileException("No existe el fichero $origen que estas intentando copiar");
        }
        if(is_file($destino)===true){
            throw new FileException("ya existe el fichero $destino que estas intentando copiar");
        }
        if(copy($origen,$destino)==false){
            throw new FileException("no se a podido copiar $origen en  $destino");

        }
    }
}