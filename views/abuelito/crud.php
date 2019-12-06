<!-- Se llama el Header -->
<?php require_once 'views/layout/header.php'; ?>
<title>Asitad - Abuelitos</title>
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
    <?php if (!isset($_GET['idAbuelito'])) : ?>
      <form action="<?= baseUrl ?>abuelito/registrar" method="POST"enctype="multipart/form-data">
        <div class="row">
          <div class="form-group col-6">
            <label for="nombre"><?= nombre ?></label>
            <input id="nombre" name="nombre" class="form-control" type="text">
          </div>
          <div class="form-group col-6">
            <label for="apellido"><?= apellido ?></label>
            <input id="apellido" name="apellido" class="form-control" type="text">
          </div>
          <div class="form-group col-6">
            <label for="fechaNacimiento"><?= fechanacimiento ?></label>
            <input id="fechaNacimiento" name="fechaNacimiento" class="form-control" type="date">
          </div>
          <div class="form-group col-6">
            <label for="nececidades"><?= necesidades ?></label>
            <select class="custom-select mr-sm-2 mt-1" name="necesidades" id="necesidades">
            <option><?= elija ?></option>
              <option><?= dinero ?></option>
              <option><?= ropa ?></option>
              <option><?= alimentos ?></option>
              <option><?= aseopersonal ?></option>
            </select>
          </div>


          <div class="form-group col-6">
            <label for="examenesMedicos"><?= examenesmedicos ?></label>
            <select class="custom-select mr-sm-2 mt-1" name="examenesMedicos" id="examenesMedicos">
              <option><?= elija ?></option>
              <?php while ($t = $examenes->fetch_object()) : ?>
                <option value="<?= $t->idExamenesMedicos; ?>"><?= $t->nombreExamenesMedico; ?>-<?= $t->fechaExamenesMedicos; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-6">
            <label for="estadoSalud"><?= estadosalud ?></label>
            <select class="custom-select mr-sm-2 mt-1" name="estadoSalud" id="estadoSalud">
              <option>Elija...</option>  
              <option>cuidado grave</option>
              <option>cuidado medio</option>
              <option>cuidado bajo</option>
            </select>
          </div>
          <div class="form-label-group col-12 col-lg-6 py-2">
            <label for="imagen"><?= Imagen ?></label>
            <br>
            <?php if (isset($r) && is_object($r) && !empty($r->imagen)) : ?>
              <img src="<?= baseUrl ?>uploads/img/<?= $r->imagen ?>" class="thumb" style="width: 250px;height: 250px;" name="imagen" id="imagen" />
            <?php endif; ?>
            <input type="file" name="imagen" id="imagen" />
          </div>

          <input type="submit" id="send3" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="<?=registrar?>">
        </div>
      </form>

    <?php else : ?>
      <!-- Formulario para Editar -->
      <form action="<?= baseUrl ?>abuelito/editar&idAbuelito=<?= $_GET['idAbuelito'] ?>" method="POST">
        <div class="row">
          <div class="form-group col-6">
            <label for="nombre"><?= nombre ?></label>
            <input id="nombre" name="nombre" class="form-control" type="text" value="<?= $r->nombreAbuelito ?>">
          </div>
          <div class="form-group col-6">
            <label for="apellido"><?= apellido ?></label>
            <input id="apellido" name="apellido" class="form-control" type="text" value="<?= $r->apellido ?>">
          </div>
          <div class="form-group col-6">
            <label for="fechaNacimiento"><?= fechanacimiento ?></label>
            <input id="fechaNacimiento" name="fechaNacimiento" class="form-control" type="date" value="<?= $r->fechaNacimiento ?>">
          </div>
          <div class="form-group col-6">
            <label for="necesidades"><?= necesidades ?></label>
            <select class="custom-select mr-sm-2 mt-1" name="necesidades" id="necesidades" <?= $r->necesidades ?>>
            <option><?= elija ?></option>
              <option><?= dinero ?></option>
              <option><?= ropa ?></option>
              <option><?= alimentos ?></option>
              <option><?= aseopersonal ?></option>
            </select>
          </div>
          <div class="form-group col-6">
            <label for="examenesMedicos"><?= examenesmedicos ?></label>
            <select class="custom-select mr-sm-2 mt-1" name="examenesMedicos" id="examenesMedicos" <?= $t->examenesMedicos ?>>
              <option><?= elija ?></option>
              <?php while ($t = $examenes->fetch_object()) : ?>
                <option value="<?= $t->idExamenesMedicos; ?>"><?= $t->nombreExamenesMedico; ?>-<?= $t->fechaExamenesMedicos; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-6">
            <label for="estadoSalud"><?= estadosalud ?></label>
            <select class="custom-select mr-sm-2 mt-1" name="estadoSalud" id="estadoSalud" <?= $r->estadoSalud ?>>
            <option><?= cuidadograve ?></option>
              <option><?= cuidadomedio ?></option>
              <option><?= cuidadobajo ?></option>
            </select>
          </div>
          <div class="form-label-group col-12 col-lg-6 py-2">
            <label for="imagen"><?= Imagen ?></label>
            <br>
            <?php if (isset($r) && is_object($r) && !empty($r->imagen)) : ?>
              <img src="<?= baseUrl ?>uploads/img/<?= $r->imagen ?>" class="thumb" style="width: 250px;height: 250px;" name="imagen" id="imagen" />
            <?php endif; ?>
            <input type="file" name="imagen" id="imagen" />
          </div>
          <input type="submit" id="send3" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="<?=actualizar?>">
        </div>
      </form>
    <?php endif; ?>

    <!-- Tabla -->

    <table id="papitas" class="table table-responsive-lg table-bordered table-hover">
      <thead>
        <tr>
        <th scope="col"><?= nombre ?></th>
          <th scope="col"><?= apellido ?></th>
          <th scope="col"><?= fechanacimiento ?></th>
          <th scope="col"><?= examenesmedicos ?></th>
          <th scope="col"><?= estado ?></th>
          <th scope="col"><?= necesidades ?></th>
          <th scope="col"><?= foto ?></th>
          <th scope="col"><?= acciones ?></th>
        </tr>
      </thead>
      <tbody>
        <?php while ($a = $abuelito->fetch_object()) : ?>
          <tr class="table-<?= $a->estado == 'Inactivo' ? 'secondary' : ''; ?>">
          <td><?= $a->nombreAbuelito ?></td>
            <td><?= $a->apellido ?></td>
            <td><?= $a->fechaNacimiento ?></td>
            <td><?= $a->nombreExamenesMedico ?></td>
            <td><?= $a->estadoSalud ?></td>
            <td><?= $a->necesidades ?></td>
            <td><?= $a->imagen ?></td>
            <td>
            <a href="<?= baseUrl ?>abuelito/actualizar&idAbuelito=<?= $a->idAbuelito ?>" class="btn btn-danger"><?= $a->estadoAB == 'Inactiva' ? 'Activar' : 'Inactivar' ?></a>
            <a href="<?= baseUrl ?>abuelito/gestion&idAbuelito=<?= $a->idAbuelito ?>" class="btn btn-warning btn-sm"><?= editar ?> <i class="fas fa-pencil-alt"></i></a>
              
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>

  </div>


  <script src="<?= baseUrl ?>assets/js/validarAbu.js"></script>
  <!-- Se llama el footer -->
  <?php require_once 'views/layout/footer.php'; ?>
  <?php require_once 'views/layouts/footer.php'; ?>