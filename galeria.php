<?php
require_once 'utils/utils.php';
require_once 'utils/File.php';
require_once 'entity/ImagenGaleria.php';
require_once 'database/Connection.php';
require_once 'repository/ImagenGaleriaRepository.php';
require_once 'core/App.php';
require_once 'exception/AppException.php';
require_once 'exception/QueryException.php';
require_once 'exception/FileException.php';


$errores = [];
$descripcion = '';
$mensaje = '';
try {

    $config = require_once 'app/config.php';
    App::bind('config', $config);
    $connection = App::getConnection();
    $imagenGaleriaRepository = new ImagenGaleriaRepository();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $descripcion = trim(htmlspecialchars($_POST['descripcion']));

        $tiposAceptados = ['image/jpeg', 'image/png', 'image/gif'];
        $imagen = new File('imagen', $tiposAceptados);
        $imagen->saveUploadFile(ImagenGaleria::RUTA_IMAGENES_GALLERY);
        $imagen->copyFile(ImagenGaleria::RUTA_IMAGENES_GALLERY, ImagenGaleria::RUTA_IMAGENES_PORTFOLIO);

        $imagenGaleria = new ImagenGaleria($imagen->getFileName(), $descripcion);
        $imagenGaleriaRepository->save($imagenGaleria);

        $mensaje = 'Se ha guardado la imagen';
        $descripcion = "";
    }
    $imagenes = $imagenGaleriaRepository->findAll();

} catch (QueryException $exception) {
    throw  new QueryException("Error de base de datos");
} catch (FileException $exception) {
    throw  new FileException("Error en el fichero");
}


require 'views/galeria.view.php';