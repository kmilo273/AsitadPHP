<!-- Se llama el Header -->
<?php require_once 'views/layout/header.php'; ?>
<script src="https://code.highcharts.com/highcharts.src.js"></script>
<title>Asitad - Medicamentos</title>
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
      <form action="<?= baseUrl ?>medicamento/registrar" method="POST">
        <div class="row">
          <div class="form-group col-6">
            <label for="nombre"><?= nombremedicamento ?></label>
            <input id="nombre" name="nombre" class="form-control" type="text">
          </div>
          <div class="form-group col-6">
            <label for="descripcion"><?= descripcion ?></label>
            <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
          </div>
          <div class="form-group col-6">
            <label for="unidades"><?= unidades ?></label>
            <input id="unidades" name="unidades" class="form-control" type="number">
          </div>
          <div class="col-6">
            <span><?= tipo ?></span><br>
            <select class="custom-select mr-sm-2 mt-1" name="tipo" id="tipo">
              <option><?= elija ?></option>
              <?php while ($t = $tipos->fetch_object()) : ?>
                <option value="<?= $t->idTipoMedicamento; ?>"><?= $t->tipoMedicamento; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-6">
            <label for="laboratorio"><?= laboratorio ?></label>
            <input id="laboratorio" name="laboratorio" class="form-control" type="text">
          </div>
          <div class="form-group col-6">
            <label for="fecha"><?= fecha ?></label>
            <input id="fecha" name="fecha" class="form-control" type="date">
          </div>
          <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="<?= registrar ?>" id="send">
        </div>
      </form>

    <?php else : ?>
      <!-- Formulario para Editar -->
      <form action="<?= baseUrl ?>medicamento/actualizar&id=<?= $_GET['id'] ?>" method="POST">
        <div class="row">
          <div class="form-group col-6">
            <label for="nombre"><?= nombremedicamento ?></label>
            <input id="nombre" name="nombre" class="form-control" type="text" value="<?= $r->nombreMedicamento ?>">
          </div>
          <div class="form-group col-6">
            <label for="estado"><?= estado ?></label>
            <input id="estado" name="estado" class="form-control" type="text" value="<?= $r->estado ?>">
          </div>
          <div class="form-group col-6">
            <label for="descripcion"><?= descripcion ?></label>
            <textarea class="form-control" id="descripcion" name="descripcion"><?= $r->descripcionMedicamento ?></textarea>
          </div>
          <div class="form-group col-6">
            <label for="unidades"><?= unidades ?></label>
            <input id="unidades" name="unidades" class="form-control" type="number" value="<?= $r->unidades ?>">
          </div>
          <div class="col-6">
            <span><?= tipo ?></span><br>
            <select class="custom-select mr-sm-2 mt-1" name="tipo" id="tipo">
              <option><?= elija ?></option>
              <?php while ($t = $tipos->fetch_object()) : ?>
                <option value="<?= $t->idTipoMedicamento; ?>"><?= $t->tipoMedicamento; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-6">
            <label for="laboratorio"><?= laboratorio ?></label>
            <input id="laboratorio" name="laboratorio" class="form-control" type="text" value="<?= $r->laboratorio ?>">
          </div>
          <div class="form-group col-6">
            <label for="fecha"><?= fecha ?></label>
            <input id="fecha" name="fecha" class="form-control" type="date" value="<?= $r->fechaVencimiento ?>">
          </div>
          <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="<?= actualizar ?>" id="send">
        </div>
      </form>
    <?php endif; ?>

    <!-- Tabla -->

    <table id="papitas" class="table table-responsive-lg table-bordered table-hover">
      <thead>
        <tr>
          <th scope="col"><?= nombre ?></th>
          <th scope="col"><?= descripcion ?></th>
          <th scope="col"><?= unidades ?></th>
          <th scope="col"><?= estado ?></th>
          <th scope="col"><?= tipo ?></th>
          <th scope="col"><?= laboratorio ?></th>
          <th scope="col"><?= fecha ?></th>
          <th scope="col"><?= acciones ?></th>
        </tr>
      </thead>
      <tbody>
        <?php $o = MedicamentoController::GETALL(); ?>
        <?php while ($med = $o->fetch_object()) : ?>
          <tr>
            <td><?= $med->nombreMedicamento ?></td>
            <td><?= $med->descripcionMedicamento ?></td>
            <td><?= $med->unidades ?></td>
            <td><?= $med->estado ?></td>
            <td><?= $med->tipoMedicamento ?></td>
            <td><?= $med->nombreMedicamento ?></td>
            <td><?= $med->fechaVencimiento ?></td>
            <td>
              <a href="<?= baseUrl ?>medicamento/gestion&id=<?= $med->idMedicamentos ?>" class="btn btn-info"><?= editar ?></a>
              <button class="btn btn-danger btn-sm" data-toggle="modal" data-target=".modal<?= $med->idMedicamentos ?>"> Eliminar </button>
              <!-- Modal Eliminar -->
              <div class="modal fade modal<?= $med->idMedicamentos ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalCenterTitle">Advertencia</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Desea eliminar el medicamento?
                    </div>
                    <div class="modal-footer p-2">
                      <button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal">Cancelar</button>
                      <a href="<?= baseUrl; ?>medicamento/eliminar&id=<?= $med->idMedicamentos; ?>" class="btn btn-outline-danger btn-sm"> Eliminar </a>
                    </div>
                  </div>
                </div>
              </div>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>

    <div class="d-flex justify-content-center mb-2">
      <a href="<?= baseUrl; ?>medicamento/pdf" target="blank" class="btn btn-danger">PDF</a>
    </div>

    <hr>

    <div id="container2" style="height: 400px" class="my-3"></div>

    <script type="text/javascript">
      $(function() {
        $('#container2').highcharts({
          chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
          },
          title: {
            text: 'Stock de Medicamentos'
          },
          tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
          },
          plotOptions: {
            pie: {
              allowPointSelect: true,
              cursor: 'pointer',
              dataLabels: {
                enabled: true,
                style: {
                  color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
              }
            }
          },
          series: [{
            type: 'pie',
            name: 'Cantidad',
            data: [
              <?php $o = MedicamentoController::GETALL(); ?>
              <?php
              foreach ($o as $medicamentos) {
                ?>['<?= $medicamentos['nombreMedicamento'] ?>', <?= $medicamentos['unidades'] ?>],
              <?php
              }
              ?>
            ]
          }]
        });
      });
    </script>

  </div>

  <script src="<?= baseUrl ?>assets/js/validarMed.js"></script>
  <!-- Se llama el footer -->
  <?php require_once 'views/layout/footer.php'; ?>


</body>

</html>