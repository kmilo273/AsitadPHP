<div class="d-flex justify-content-between align-items-center">
  <h2><?= $_SESSION['userLog']->nombre ?> <?= $_SESSION['userLog']->apellido ?> <?= $_SESSION['userLog']->tipoRol ?></h2>
  <a href="<?= baseUrl; ?>user/lang&l=<?= lang; ?>" class="btn btn-dark btn-sm" role="button">
    <span id="btnLang"><?= idioma; ?></span>
  </a>
</div>

<hr>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="menu">
    <ul class="navbar-nav mr-auto">
      <a class="nav-item nav-link active" href="<?= baseUrl ?>user/index"><?= inicio ?></a>
      <?php if($_SESSION['userLog']->rol == '1') : ?>
        <a class="nav-item nav-link" href="<?= baseUrl ?>medicamento/gestion"><?= medicamentos?></a>
        <a class="nav-item nav-link" href="<?= baseUrl ?>actividad/gestion"><?= actividad?></a>
        <a class="nav-item nav-link" href="<?= baseUrl ?>abuelito/gestion"><?= abuelito?></a>
        <a class="nav-item nav-link" href="<?= baseUrl ?>evento/correos"><?= eventos?></a>
        <a class="nav-item nav-link" href="<?= baseUrl ?>examenes/gestion"><?= examenes?></a>
        <a class="nav-item nav-link" href="<?= baseUrl ?>donacion/gestion"><?= donacion?></a>
        <a class="nav-item nav-link" href="<?= baseUrl ?>apadrinamiento/gestion"><?= apadrinamiento?></a>
        <a class="nav-item nav-link" href="<?= baseUrl ?>user/gestion"><?= usuario?></a>
        <a class="nav-item nav-link text-dark" href="<?= baseUrl ?>user/cert"><?= certificado?></a>
        <a class="nav-item nav-link text-dark" href="<?= baseUrl ?>user/visit"><?= visitas?></a>
        
      <?php elseif($_SESSION['userLog']->rol == '2') : ?>
        <a class="nav-item nav-link" href="<?= baseUrl ?>apadrinamiento/forApadrinamiento"><?= apadrinamiento?></a>
        <a class="nav-item nav-link" href="<?= baseUrl ?>abuelito/abuelitoTable"><?= abuelito?></a>
        
      <?php elseif($_SESSION['userLog']->rol == '3') : ?>
        <a class="nav-item nav-link" href="<?= baseUrl ?>examenes/gestion"><?= examenes?></a>
        <a class="nav-item nav-link" href="<?= baseUrl ?>abuelito/abuelitoTable"><?= abuelito?></a>
          
          <?php elseif($_SESSION['userLog']->tipoRol == 'practicante') : ?>
            <a class="nav-item nav-link" href="<?= baseUrl ?>actividad/fromPrac">Registrar Actividad</a>
          <?php endif; ?>
      <a class="nav-item nav-link text-danger" href="<?= baseUrl ?>user/logout"><?= salir ?></a>

    </ul>
  </div>
</nav>