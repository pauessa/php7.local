<?php
require_once  __DIR__ . '/../utils/utils.php';
require_once  __DIR__ . '/../utils/File.php';
require_once  __DIR__ . '/../entity/Asociado.php';
require_once  __DIR__ . '/../database/Connection.php';
require_once  __DIR__ . '/../repository/AsociadoRepository.php';
require_once  __DIR__ . '/../core/App.php';
require_once  __DIR__ . '/../exception/AppException.php';
require_once  __DIR__ . '/../exception/QueryException.php';
require_once  __DIR__ . '/../exception/FileException.php';


$errores = [];
$descripcion = '';
$mensaje = '';
try {

    $config = require_once  __DIR__ . '/../app/config.php';
    App::bind('config', $config);
    $connection = App::getConnection();
    $asociadoRepository = new AsociadoRepository();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $descripcion = trim(htmlspecialchars($_POST['descripcion']));
        $nombre=trim(htmlspecialchars($_POST['nombre']));

        $tiposAceptados = ['image/jpeg', 'image/png', 'image/gif'];
        $imagen = new File('imagen', $tiposAceptados);
        $imagen->saveUploadFile(Asociado::RUTA_IMAGENES_ASOCIADOS);

        $asociado = new Asociado($nombre,$imagen->getFileName(),$descripcion);
        $asociadoRepository->save($asociado);

        $mensaje = 'Se ha guardado la imagen';

    }
    $asociados = $asociadoRepository->findAll();

} catch (QueryException $exception) {
    throw  new QueryException("Error de base de datos");
} catch (FileException $exception) {
    throw  new FileException("Error en el fichero");
}


require  __DIR__ . '/../views/asociados.view.php';