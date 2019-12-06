<!-- Se llama el Header -->
<?php require_once 'views/layout/header.php'; ?>
<title>Asitad - Examenes Medicos</title>
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
      <form action="<?= baseUrl ?>examenes/registrar" method="POST" enctype="multipart/form-data">
        <div class="row">
          <div class="form-group col-6">
            <label for="fecha"><?= fechaExamenen ?></label>
            <input id="fecha" name="fecha" class="form-control" type="date">
          </div>

          <div class="form-group col-6">
            <label for="nombre"><?= nombreexamen ?></label>
            <input id="nombre" name="nombre" class="form-control" type="text">
          </div>

          <div class="form-group col-6">
            <label for="descripcion"><?= descripcion ?></label>
            <input id="descripcion" name="descripcion" class="form-control" type="text">
          </div>
          <div class="form-label-group col-12 col-lg-6 py-2">
            <label><?= SeleccionarArchivoWord?> <i class="fas fa-file-word"></i> - PDF <i class="fas fa-file-pdf"></i></label>
            <input type="file" class="form-control-file btn btn-outline-dark" id="archivo" name="archivo">
          </div>

          <input type="submit" id="Exacto" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="<?=registrar?>">
        </div>
      </form>

    <?php else : ?>
      <!-- Formulario para Editar -->
      <form action="<?= baseUrl ?>examenes/actualizar&id=<?= $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
          <div class="form-group col-6">
            <label for="fecha"><?= fechaExamenen?></label>
            <input id="fecha" name="fecha" class="form-control" type="date" value="<?= $r->fechaExamenesMedicos ?>">
          </div>
          <div class="form-group col-6">
            <label for="nombre"><?= nombreexamen ?></label>
            <input id="nombre" name="nombre" class="form-control" type="text" value="<?= $r->nombreExamenesMedico ?>">
          </div>
          <div class="form-group col-6">
            <label for="descripcion"><?= descripcion ?></label>
            <input id="descripcion" name="descripcion" class="form-control" type="text" value="<?= $r->descripcionExamenMedico?>">
          </div>
          <div class="form-label-group col-12 col-lg-6 py-2">
            <label for="imagen"><?= examenes?></label>
            
            <iframe src="<?= baseUrl?>uploads/public/<?= $r->documentos?>" width="0%" height="0%" name="documento" id="documento"></iframe>
            <h2 href="<?= baseUrl ?>examenes&id=<?php echo $r->idExamenesMedicos?> " name="documento" id="documento"><?php echo $r->documentos ?></h2>
            <input type="file" name="documento" id="documento"/>
          </div>
          <input type="submit" id="Exacto" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="<?=actualizar?>">
        </div>
      </form>
    <?php endif; ?>

    <!-- Tabla -->

    <table id="papitas" class="table table-responsive-lg table-bordered table-hover">
      <thead>
        <tr>
          <th scope="col">Fecha</th>
          <th scope="col">nombre de examen</th>
          <th scope="col">descripcion de examen</th>
          <th scope="col">Documento</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($exa = $examenes->fetch_object()) : ?>
          <tr>
            <td><?= $exa->fechaExamenesMedicos ?></td>
            <td><?= $exa->nombreExamenesMedico ?></td>
            <td><?= $exa->descripcionExamenMedico ?></td>
            <td><?= $exa->documentos ?></td>
            <td>
              <a href="<?= baseUrl ?>examenes/eliminar&id=<?= $exa->idExamenesMedicos ?>" class="btn btn-danger"><?=eliminar?></a>
              <a href="<?= baseUrl ?>examenes/gestion&id=<?= $exa->idExamenesMedicos ?>" class="btn btn-info"><?=editar?></a>
              <a href="<?= baseUrl ?>uploads/public/<?= $exa->documentos; ?>" class="btn btn-success" target="mostrar"><?=descargar?></a>
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>

  </div>

  <script src="<?= baseUrl ?>assets/js/validarExa.js"></script>
  <!-- Se llama el footer -->
  <?php require_once 'views/layout/footer.php'; ?>
  <?php require_once 'views/layouts/footer.php'; ?>