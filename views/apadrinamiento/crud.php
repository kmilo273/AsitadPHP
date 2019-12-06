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
      <form action="<?= baseUrl ?>apadrinamiento/registrar" method="POST">
        <div class="row">
          <div class="form-group col-6">
            <label for="fechaInicial"><?= fechainicial ?></label>
            <input id="fechaInicial" name="fechaInicial" class="form-control" type="date">
          </div>
          <div class="form-group col-6">
            <span>Abuelito</span><br>
            <select class="custom-select mr-sm-2 mt-2" name="abuelito" id="abuelito">
              <option>Elije..</option>
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

    <?php else : ?>
      <!-- Formulario para Editar -->
      <form action="<?= baseUrl ?>apadrinamiento/actualizar&id=<?= $_GET['id'] ?>" method="POST">
        <div class="row">
          <div class="form-group col-6">
            <label for="fechaInicial"><?= fechainicial ?></label>
            <input id="fechaInicial" name="fechaInicial" class="form-control" type="date" value="<?= $r->fechaInicial ?>">
          </div>
          <div class="form-group col-6">
            <span><?= abuelito ?></span><br>
            <select class="custom-select mr-sm-2 mt-2" name="abuelito" id="abuelito">
              <option><?= elija ?></option>
              <?php $abue = AbuelitoController::getAll(); ?>
              <?php while ($abu = $abue->fetch_object()) : ?>
                <option value="<?= $abu->idAbuelito; ?>"><?= $abu->nombreAbuelito; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-label-group col-8 py-2">
            <label for="motivo"><?= razon ?> <span class="maxN"></span></label>
            <textarea class="form-control" id="razon" name="razon"><?= $r->razon ?></textarea>
          </div>
          <div class="form-group col-12">
            <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3 mx-auto" value="<?= actualizar ?>" </div> </div> </form> <?php endif; ?> <!-- Tabla -->

            <table id="papitas" class="table table-responsive-lg table-bordered table-hover col-12">
              <thead>
                <tr>
                  <th scope="col">Fecha Inicial</th>
                  <th scope="col">Abuelo</th>
                  <th scope="col">Usuario</th>
                  <th scope="col">Razon</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($ap = $apadrinamiento->fetch_object()) : ?>
                  <tr>
                    <td><?= $ap->fechaInicial ?></td>
                    <td><?= $ap->nombreAbuelito ?></td>
                    <td><?= $ap->nombre ?></td>
                    <td><?= $ap->razon ?></td>
                    <td>
                      <a href="<?= baseUrl ?>apadrinamiento/gestion&id=<?= $ap->id ?>" class="btn btn-info">Editar</a>
                      <a href="<?= baseUrl; ?>apadrinamiento/eliminar&id=<?=$ap->id ; ?>" class="btn btn-outline-danger btn-sm"> Eliminar </a>
                      
                     
                    </td>
                  </tr>
                <?php endwhile ?>
              </tbody>
            </table>

          </div>
          <div class="d-flex justify-content-center mb-2">
            <a href="<?= baseUrl; ?>apadrinamiento/pdf" target="blank" class="btn btn-danger">PDF</a>
          </div>

          <!-- Se llama el footer -->
          <?php require_once 'views/layout/footer.php'; ?>