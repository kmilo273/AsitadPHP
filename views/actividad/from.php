<!-- Se llama el Header -->
<?php require_once 'views/layout/header.php'; ?>
<title>Asitad - Actividad</title>
</head>

<!-- El <body> solo se abre, el </body> esta en el FOOTER -->

<body>

    <!-- Aqui va el Contenido de la Pagina -->
    <div class="container mt-4">
        <?php require_once 'views/layout/banner.php'; ?>

        <?php if (isset($_SESSION['registrado'])) : ?>
            <h5 class="text-success text-center"><?= registrado ?></h5>
        <?php elseif (isset($_SESSION['actualizado'])) : ?>
            <h5 class="text-info text-center"><?= actualizado ?></h5>
        <?php elseif (isset($_SESSION['eliminado'])) : ?>
            <h5 class="text-warning text-center"><?= eliminado ?></h5>
        <?php else : ?>
            <hr class="border-dark">
        <?php endif ?>
        <?= Utils::deleteSession('registrado') ?>
        <?= Utils::deleteSession('actualizado') ?>
        <?= Utils::deleteSession('eliminado') ?>

        <!-- Formulario De Registro -->
        <?php if (!isset($_GET['id'])) : ?>
            <form action="<?= baseUrl ?>actividad/registrarPracti" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="fechaActividad"><?= fechaactividad ?></label>
                        <input id="fechaActividad" name="fechaActividad" class="form-control" type="date">
                    </div>
                    <div class="form-group col-6">
                        <label for="nombreActividad"><?= nombreactividad ?></label>
                        <textarea class="form-control" id="nombreActividad" name=nombreActividad></textarea>
                    </div>
                    <div class="form-group col-6">
                        <label for="horaActividad"><?= horaactividad ?></label>
                        <input id="horaActividad" name="horaActividad" class="form-control" type="number">
                    </div>
                    <div class="col-6">
                        <span><?= tipoactividad ?></span><br>
                        <select class="custom-select mr-sm-2 mt-1" name="tipoActividad" id="tipoActividad">
                            <option><?= elija ?></option>
                            <?php while ($t = $tipos->fetch_object()) : ?>
                                <option value="<?= $t->idTipoActividad; ?>"><?= $t->tipoActividad; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-label-group col-12 col-lg-6 py-2">
                        <label><?= SeleccionarArchivojpeg ?> <i class="fas fa-file-word"></i> - png <i class="fas fa-file-pdf"></i></label>
                        <input type="file" class="form-control-file btn btn-outline-dark" id="imagen" name="imagen">
                    </div>
                    <div class="form-group col-6">
                        <span><?= abuelito ?></span><br>
                        <select class="custom-select mr-sm-2 mt-1" name="abuelito_idAbuelito" id="abuelito_idAbuelito">
                            <option><?= elija ?></option>
                            <?php $abuel = AbuelitoController::getAll(); ?>
                            <?php while ($a = $abuel->fetch_object()) : ?>
                                <option value="<?= $a->idAbuelito; ?>"><?= $a->nombreAbuelito; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group col-6">

                        <input type="submit" id="send2" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="<?= registrar ?>">
                    </div>
            </form>
        <?php endif; ?>
  
        <script src="<?= baseUrl ?>assets/js/validarAct.js"></script>
  <!-- Se llama el footer -->
  <?php require_once 'views/layout/footer.php'; ?>