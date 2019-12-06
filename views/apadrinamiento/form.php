<?php require_once 'views/layout/header.php'; ?>
<title>Asitad - Apadrinamiento</title>
</head>

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
      <form action="<?= baseUrl ?>apadrinamiento/registrarPadrino" method="POST">
        <div class="row">
          <div class="form-group col-6">
        
            <label for="fechaInicial"><?= fechainicial ?></label>
            <input id="fechaInicial" name="fechaInicial" class="form-control" type="date">
          </div>
          <div class="form-group col-6">
            <span><?=abuelito?></span><br>
            <select class="custom-select mr-sm-2 mt-2" name="abuelito" id="abuelito">
              <option><?=elije?></option>
              <?php $abue = AbuelitoController::getAll(); ?>
              <?php while ($abu = $abue->fetch_object()) : ?>
                <option value="<?= $abu->idAbuelito; ?>"><?= $abu->nombreAbuelito; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-label-group col-6 py-2">
            <label for="motivo"><?= razon ?> <span class="maxN"></span></label>
            <textarea class="form-control" id="razon" name="razon"></textarea>
          </div>
          <div class="form-group col-12">
            <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3 mx-auto" value="<?= registrar ?>">
          </div>
      </form>
      </div>
              <?php endif;?>

<!-- Se llama el footer -->
<?php require_once 'views/layout/footer.php'; ?>