<!-- Se llama el Header -->
<?php require_once 'views/layout/header.php'; ?>
<script src="https://code.highcharts.com/highcharts.src.js"></script>
<title>Asitad - Donacion</title>
</head>

<body>

	<!-- Aqui va el Contenido de la Pagina -->
	<div class="container mt-4">
		<?php require_once 'views/layout/banner.php'; ?>

		<?php if (isset($_SESSION['registrado'])) : ?>
			<h5 class="text-success text-center">correo enviado</h5>
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

		<div class="modal-body">
			<form action="<?= baseUrl; ?>evento/cor " method="post" enctype="multipart/form-data">
				<div class="form-row">
					<div style="width: 100%; height: 20px;"></div>
					<div class="col-md-12">
						<label><?=asunto?></label>
						<input type="text" name="asunto" id="asunto" placeholder="Asunto" class="form-control form-control-sm" required="">
					</div>
					<div class="col-md-12">
						<label><?=mensaje?></label>
						<textarea name="mensaje" id="mensaje" placeholder="Mensaje" class="form-control form-control-sm"></textarea>
					</div>
					<br>
					<input type="file" name="archivo" id="archivo" class="card">
					<br>
					<input type="submit" value="<?=invitacionaeventos?>" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
	
</body>

</html>
