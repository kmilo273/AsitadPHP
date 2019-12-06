<!-- Se llama el Header -->
<?php require_once 'views/layout/header.php'; ?>
<title>Asitad - Usuario</title>
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
      <form action="<?= baseUrl ?>user/registrar" method="POST">
        <div class="row">
          <div class="form-group col-6">
            <label for="nombre"><?= nombreusuario ?></label>
            <input id="nombre" name="nombre" class="form-control" type="text">
          </div>
          <div class="form-group col-6">
            <label for="apellido"><?= apellido ?></label>
            <input id="apellido" name="apellido" class="form-control" type="text">
          </div>
          <div class="form-group col-6">
            <label for="correo"><?= correo ?></label>
            <input id="correo" name="correo" class="form-control" type="text">
          </div>
          <div class="form-group col-6">
            <label for="contrasena"><?= contraseña ?></label>
            <input id="contrasena" name="contrasena" class="form-control" type="text">
          </div>
          <div class="col-6">
            <span><?= rol ?></span><br>
            <select class="custom-select mr-sm-2 mt-1" name="rol" id="rol" required>
              <option><?= elija ?></option>
              <?php while ($r = $rol->fetch_object()) : ?>
                <option value="<?= $r->idRol; ?>"><?= $r->tipoRol; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-6">
            <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3s" value="<?= registrar ?>" id="user">
          </div>
      </form>

      <?php else : ?>
      <!-- Formulario para Editar -->
      <form action="<?= baseUrl ?>user/actualizar&id=<?= $_GET['id'] ?>" method="POST">
        <div class="row">
          <div class="form-group col-6">
            <label for="nombre"><?= nombreusuario ?></label>
            <input id="nombre" name="nombre" class="form-control" type="text" value="<?= $r->nombre ?>">
          </div>
          <div class="form-group col-6">
            <label for="apellido"><?= apellido ?></label>
            <input id="apellido" name="apellido" class="form-control" type="text" value="<?= $r->apellido ?>">
          </div>
          <div class="form-group col-6">
            <label for="correo"><?= correo ?></label>
            <input id="correo" name="correo" class="form-control" type="text" value="<?= $r->email ?>">
          </div>
          <div class="col-6">
            <span><?= rol ?></span><br>
            <select class="custom-select mr-sm-2 mt-1" name="rol" id="rol">
              <option><?= elija ?></option>
              <?php while ($r = $rol->fetch_object()) : ?>
                <option value="<?= $r->idRol; ?>"><?= $r->tipoRol; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-6">

            <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="<?= actualizar ?>">
          </div>

      </form>
      <?php endif; ?>

    <!-- Tabla -->

    <table id="papitas" class="table table-responsive-lg table-bordered table-hover">
      <thead>
        <tr>
          <th scope="col">Nombre Usuario</th>
          <th scope="col">Apellido Usuario</th>
          <th scope="col">Correo</th>
          <th scope="col">Rol</th>
          <th scope="col">Accion</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($u = $use->fetch_object()) : ?>
          <tr>
            <td><?= $u->nombre ?></td>
            <td><?= $u->apellido ?></td>
            <td><?= $u->email ?></td>
            <td><?= $u->tipoRol ?></td>

            <td>
              <a href="<?= baseUrl ?>user/gestion&id=<?= $u->idUsuario ?>" class="btn btn-info">Editar</a>
              <a href="<?= baseUrl ?>user/eliminar&id=<?= $u->idUsuario ?>" class="btn btn-danger btn-sm">Eliminar</a>
              
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>

  </div>
  <script src="<?= baseUrl ?>assets/js/validarUsuari.js"></script>
  <!-- Se llama el footer -->
  <?php require_once 'views/layout/footer.php'; ?>