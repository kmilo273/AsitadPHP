<!-- Se llama el Header -->
<?php require_once 'views/layout/header.php'; ?>
<script src="https://code.highcharts.com/highcharts.src.js"></script>
<title>Asitad - Donacion</title>
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
      <form action="<?= baseUrl ?>donacion/registrar" method="POST">
        <div class="row">
          <div class="form-group col-6">
            <label for="valor"><?= valordonacion ?></label>
            <input id="valor" name="valor" class="form-control" type="number">
          </div>
          <div class="form-group col-6">
            <label for="fecha"><?= fechadonacion ?></label>
            <input id="fecha" name="fecha" class="form-control" type="date">
          </div>
          <div class="col-6">
            <span><?= tipodonacion ?></span><br>
            <select class="custom-select mr-sm-2 mt-1" name="tipo" id="tipo">
              <option><?= elija ?></option>
              <option><?= dinero ?></option>
              <option><?= ropa ?></option>
              <option><?= alimentos ?></option>
              <option><?= aseopersonal ?></option>
            </select>
          </div>
          <div class="col-6">
            <span><?= usuarios ?></span><br>
            <select class="custom-select mr-sm-2 mt-1" name="usuario_idUsuario" id="usuario_idUsuario">
              <option><?= elija ?></option>
              <?php $users = UserController::getAll(); ?>
              <?php while ($u = $users->fetch_object()) : ?>
                <option value="<?= $u->idUsuario; ?>"><?= $u->nombre; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-6">
            <span><?= abuelito ?></span><br>
            <select class="custom-select mr-sm-2 mt-1" name="abuelito_idAbuelito" id="abuelito_idAbuelito">
              <option><?= elija ?></option>
              <?php $abue = AbuelitoController::getAll(); ?>
              <?php while ($abu = $abue->fetch_object()) : ?>
                <option value="<?= $abu->idAbuelito; ?>"><?= $abu->nombreAbuelito; ?></option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="form-group col-6">
            <label for="descripcion"><?= descripcion ?></label>
            <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
          </div>
          </select>
        </div>

        <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="<?= registrar ?>">
  </div>
  </form>

<?php else : ?>
  <!-- Formulario para Editar -->
  <form action="<?= baseUrl ?>donacion/actualizar&id=<?= $_GET['id'] ?>" method="POST">
    <div class="row">
      <div class="form-group col-6">
        <label for="valor"><?= valordonacion ?></label>
        <input id="valor" name="valor" class="form-control" type="number" value="<?= $r->valorDonacion ?>">
      </div>

      <div class="form-group col-6">
        <label for="fecha"><?= fechadonacion ?></label>
        <input id="fecha" name="fecha" class="form-control" type="date">
      </div>
      <div class="col-6">
        <span><?= tipodonacion ?></span><br>
        <select class="custom-select mr-sm-2 mt-1" name="tipo" id="tipo">
          <option><?= elija ?></option>
          <option><?= dinero ?></option>
          <option><?= ropa ?></option>
          <option><?= alimentos ?></option>
          <option><?= aseopersonal ?></option>
        </select>
      </div>
      <div class="col-6">
        <span><?= usuarios ?></span><br>
        <select class="custom-select mr-sm-2 mt-1" name="usuario_idUsuario" id="usuario_idUsuario">
          <option><?= elija ?></option>
          <?php $users = UserController::getAll(); ?>
          <?php while ($u = $users->fetch_object()) : ?>
            <option value="<?= $u->idUsuario; ?>"><?= $u->nombre; ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="form-group col-6">
        <span><?= abuelito ?></span><br>
        <select class="custom-select mr-sm-2 mt-1" name="abuelito_idAbuelito" id="abuelito_idAbuelito">
          <option><?= elija ?></option>
          <?php $abue = AbuelitoController::getAll(); ?>
          <?php while ($abu = $abue->fetch_object()) : ?>
            <option value="<?= $abu->idAbuelito; ?>"><?= $abu->nombreAbuelito; ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="form-group col-6">
        <label for="descripcion"><?= descripcion ?></label>
        <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
      </div>

      <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="<?= actualizar ?>">
    </div>
  </form>
<?php endif; ?>

<!-- Tabla -->

<table id="papitas" class="table table-responsive-lg table-bordered table-hover">
  <thead>
    <tr>
      <th scope="col"><?= valordonacion ?></th>
      <th scope="col"><?= fechadonacion ?></th>
      <th scope="col"><?= tipodonacion ?></th>
      <th scope="col"><?= usuario ?></th>
      <th scope="col"><?= abuelito ?></th>
      <th scope="col"><?= descripcion ?></th>
      <th scope="col"><?= acciones ?></th>
    </tr>
  </thead>
  <tbody>
    <?php $d = DonacionController::GETALL(); ?>
    <?php while ($don = $d->fetch_object()) : ?>
      <tr>
        <td><?= $don->valorDonacion ?></td>
        <td><?= $don->fecha ?></td>
        <td><?= $don->tipoDonacion ?></td>
        <td><?= $don->usuario_idUsuario ?></td>
        <td><?= $don->nombreAbuelito ?></td>
        <td><?= $don->descripcionDonacion ?></td>
        <td>
          <a href="<?= baseUrl ?>donacion/eliminar&id=<?= $don->idDonacion ?>" class="btn btn-danger"><?= eliminar ?></a>
          <a href="<?= baseUrl ?>donacion/gestion&id=<?= $don->idDonacion ?>" class="btn btn-info"><?= editar ?></a>
        </td>
      </tr>
    <?php endwhile ?>
  </tbody>
</table>

<div class="d-flex justify-content-center mb-2">
  <a href="<?= baseUrl; ?>donacion/pdf" target="blank" class="btn btn-danger">PDF</a>
</div>

<hr>

</div>

<!-- Se llama el footer -->
<?php require_once 'views/layout/footer.php'; ?>

<script src="<?= baseUrl ?>assets/Highcharts-4.1.5/js/highcharts.js"></script>
<script src="<?= baseUrl ?>assets/Highcharts-4.1.5/js/highcharts-3d.js"></script>
<script src="<?= baseUrl ?>assets/Highcharts-4.1.5/js/modules/exporting.js"></script>

</body>

</html>