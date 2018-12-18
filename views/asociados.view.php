<?php include __DIR__ . '/partials/inicio-doc.part.php'; ?>

<?php include __DIR__ . '/partials/nav-doc.part.php'; ?>

<!-- Principal Content Start -->
<div id="galeria">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h1>ASOCIADOS</h1>
            <hr>
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
                <div class="alert alert-<?= empty($errores) ? 'info' : 'danger'; ?> alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php if (empty($errores)) : ?>
                        <p><?= $mensaje ?></p>
                    <?php else : ?>
                        <ul>
                            <?php foreach ($errores as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <form class="form-horizontal" action="<?= $_SERVER['PHP_SELF'] ?>" method="post"
                  enctype="multipart/form-data">

                <div class="col-xs-12">
                    <label class="label-control">Name</label>
                    <input class="form-control" type="text" name="nombre">
                </div>

                <div class="col-xs-12">
                    <label class="label-control">Imagen</label>
                    <input class="form-control-file" type="file" name="imagen">
                </div>

                <div class="col-xs-12">
                    <label class="label-control">Descripción</label>
                    <textarea class="form-control" name="descripcion"></textarea>
                    <br>
                    <button class="pull-right btn btn-lg sr-button">ENVIAR</button>
                </div>


            </form>
            <hr class="divider">
            <div class="imagenes_galeria">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Descripcion</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($asociados ?? [] as $a) : ?>
                        <tr>
                            <th scope="row"><?= $a->getIdAsociado() ?></th>
                            <td><?= $a->getNombre() ?></td>
                            <td>
                                <img src="<?= $a->getUrlAsociados() ?>"
                                     alt="<?= $a->getDescripcion() ?>"
                                     title="<?= $a->getDescripcion() ?>"
                                     width="100px"/>
                            </td>
                            <td><?= $a->getDescripcion() ?></td>

                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<!-- Principal Content Start -->

<?php include __DIR__ . '/partials/fin-doc.part.php'; ?>
