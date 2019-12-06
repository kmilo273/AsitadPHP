<!-- Se llama el Header -->
<?php require_once 'views/layout/header.php'; ?>
<title>Asitad - Usuario</title>
</head>

<!-- El <body> solo se abre, el </body> esta en el FOOTER -->

<body>

    <!-- Aqui va el Contenido de la Pagina -->
    <div class="container mt-4">
        <?php require_once 'views/layout/banner.php'; ?>
        <?php if (isset($_SESSION['visita'])) : ?>
            <h5 class="text-success text-center">enviado</h5>

        <?php elseif (isset($_SESSION['noda'])) : ?>
            <h5 class="text-success text-center">noda</h5>
        <?php else : ?>
            <hr class="border-dark">
        <?php endif ?>
        <?= Utils::deleteSession('registrado') ?>
        <?= Utils::deleteSession('actualizado') ?>
        <?= Utils::deleteSession('eliminado') ?>
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <span><?= usuarios ?></span><br>
                <?php $us = UserController::getPadri(); ?>
                <select class="custom-select my-1 mr-sm-2" name="correo" id="correo">
                    <option><?= elija ?></option>
                    <?php while ($u = $us->fetch_object()) : ?>
                        <option value="<?= $u->idUsuario; ?>"><?= $u->nombre; ?>-<?= $u->email ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <form action="<?= baseUrl ?>user/visitasPro" method="POST" class="col-md-6 col-sm-12">
                <h1 class="text-center">Recuperar</h1>
                <hr class="border-primary">
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input id="correo" name="correo" class="form-control" type="email">
                </div>
                <div class="col-md-12">
                    <label>Mensaje</label>
                    <textarea name="asunto" id="asunto" placeholder="asunto" class="form-control form-control-sm"></textarea>
                </div>

                <div class="text-center">
                    <input type="submit" class="btn btn-outline-info col-6" value="Recuperar">
                </div>
            </form>
        </div>

    </div>

    <!-- Se llama el footer -->
    <?php require_once 'views/layout/footer.php'; ?>