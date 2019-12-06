<!-- Se llama el Header -->
<?php require_once 'views/layout/header.php'; ?>
<script src="https://code.highcharts.com/highcharts.src.js"></script>
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
      <form action="<?= baseUrl ?>actividad/registrar" method="POST" enctype="multipart/form-data">
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
          <div class="form-group col-6">
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
            </select></div>
          <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="<?= registrar ?>" id="send2">
        </div>
      </form>

    <?php else : ?>
      <!-- Formulario para Editar -->
      <form action="<?= baseUrl ?>actividad/actualizar&id=<?= $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
          <div class="form-group col-6">
            <label for="fechaActividad"><?= fechaactividad ?></label>
            <input id="fechaActividad" name="fechaActividad" class="form-control" type="date" value="<?= $r->fechaActividad ?>">
          </div>
          <div class="form-group col-6">
            <label for="nombreActividad"><?= nombreactividad ?></label>
            <input id="nombreActividad" name="nombreActividad" class="form-control" type="text" value="<?= $r->nombreActividad ?>">
          </div>
          <div class="form-group col-6">
            <label for="horaActividad"><?= horaactividad ?></label>
            <input id="horaActividad" name="horaActividad" class="form-control" type="number" value="<?= $r->horaActividad ?>">
          </div>
          <div class="form-group col-6">
            <span><?= tipoactividad ?></span><br>
            <select class="custom-select mr-sm-2 mt-1" name="Tipo" id="tipo">
              <option><?= elija ?></option>
              <?php while ($t = $tipos->fetch_object()) : ?>
                <option value="<?= $t->idTipoActividad; ?>"><?= $t->tipoActividad; ?></option>
              <?php endwhile; ?>
            </select></div>
          <div class="col-6">
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
            <label for="imagen"></label>
            <br></label>
            <br>
            <?php if (isset($r) && is_object($r) && !empty($r->imagenActividad)) : ?>
              <img src="<?= baseUrl ?>uploads/img/<?= $r->imagenActividad ?>" class="thumb" style="width: 250px;height: 250px;" name="imagen" id="imagen" />
            <?php endif; ?>
            <input type="file" name="imagen" id="imagen" />
          </div>
          <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="<?= actualizar ?>" id="send2">
        </div>
      </form>
    <?php endif; ?>

    <!-- Tabla -->

    <table id="papitas" class="table table-responsive-lg table-bordered table-hover">
      <thead>
        <tr>
          <th scope="col"><?= fechaactividad ?></th>
          <th scope="col"><?= nombreactividad ?></th>
          <th scope="col"><?= horaactividad ?></th>
          <th scope="col"><?= tipoactividad ?></th>
          <th scope="col"><?= usuario ?></th>
          <th scope="col"><?= abuelito ?></th>
          <th scope="col"><?= Imagen ?></th>
          <th scope="col"><?= acciones ?></th>
        </tr>
      </thead>
      <tbody>
      <?php $o = ActividadController::GETALL(); ?>
        <?php while ($ac = $o->fetch_object()) : ?>
          <tr>
          <td><?= $ac->fechaActividad ?></td>
            <td><?= $ac->nombreActividad ?></td>
            <td><?= $ac->horaActividad ?></td>
            <td><?= $ac->tipoActividad ?></td>
            <td><?= $ac->nombre ?></td>
            <td><?= $ac->imagenActividad ?></td>
            <td><?= $ac->nombreAbuelito ?></td>
            <td>
            <a href="<?= baseUrl ?>actividad/gestion&id=<?= $ac->id ?>" class="btn btn-info"><?= editar ?></a>
              <a href="<?= baseUrl ?>uploads/img/<?= $ac->imagenActividad; ?>" class="btn btn-success" target="mostrar"><?= descargar ?></a>

              <button class="btn btn-danger btn-sm" data-toggle="modal" data-target=".modal<?= $ac->id ?>"> Eliminar </button>
              <!-- Modal Eliminar -->
              <div class="modal fade modal<?= $ac->id ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalCenterTitle">Advertencia</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Desea eliminar la actividad?
                    </div>
                    <div class="modal-footer p-2">
                      <button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal">Cancelar</button>
                      <a href="<?= baseUrl ?>actividad/eliminar&id=<?= $ac->id ?>" class="btn btn-danger"><?= eliminar ?></a>
                    </div>
                  </div>
                </div>
              </div>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>

    <div class="d-flex justify-content-center mb-2">
      <a href="<?= baseUrl; ?>actividad/pdf" target="blank" class="btn btn-danger">PDF</a>
    </div>
  </div>
  <div class="row">
      <div class="col-12 col-md-6">
        <span class="titulo">Porcentaje de tipos de actividades mas utlizadas</span>
        <hr>
        <h6>Jugar - <?= $porcentaje[0][0] ?>%</h6>
        <div class="progress mb-4">
          <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style=" width:<?= $porcentaje[0][0]; ?>%"></div>
        </div>
        <h6>Baile - <?= $porcentaje[1][0] ?>%</h6>
        <div class="progress mb-4">
          <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?= $porcentaje[1][0]; ?>%"></div>
        </div>
        <h6>Manualidades - <?= $porcentaje[2][0] ?>%</h6>
        <div class="progress mb-4">
          <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?= $porcentaje[2][0]; ?>%"></div>
        </div>
        <h6>Cuento - <?= $porcentaje[3][0] ?>%</h6>
        <div class="progress mb-4">
          <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?= $porcentaje[3][0]; ?>%"></div>
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div id="container" style="height: 250px" class="my-3"></div>
      </div>
    </div>
    
  
  <script src="<?= baseUrl ?>assets/js/validarAct.js"></script>
  <!-- Se llama el footer -->
  <?php require_once 'views/layout/footer.php'; ?>


