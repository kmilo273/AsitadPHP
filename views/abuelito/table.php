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

    <table id="papitas" class="table table-responsive-lg table-bordered table-hover">
      <thead>
        <tr>
        <th scope="col"><?= nombre ?></th>
          <th scope="col"><?= apellido ?></th>
          <th scope="col"><?= necesidades ?></th>
          <th scope="col"><?= foto ?></th>
        </tr>
      </thead>
      <tbody>
        <?php while ($a = $abuelito->fetch_object()) : ?>
          <tr class="table">
          <td><?= $a->nombreAbuelito ?></td>
            <td><?= $a->apellido ?></td>
            <td><?= $a->necesidades ?></td>
            <td><?php if(isset($a) && is_object($a) && !empty($a->imagen)): ?>
                <img src="<?= baseUrl ?>uploads/img/<?= $a->imagen ?>" class="thumb" style="width: 200px;height: 150px;" name="imagen" id="imagen" />
                <?php endif ;?>
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