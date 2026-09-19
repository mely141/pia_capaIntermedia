<h1>Detalle del curso #<?= htmlspecialchars($id) ?></h1>

<?php if (!$curso): ?>
    <p><em>Este curso se cargará con datos reales en la 2da entrega.</em></p>
<?php else: ?>
    <h2><?= htmlspecialchars($curso['titulo']) ?></h2>
    <p><?= htmlspecialchars($curso['descripcion']) ?></p>
<?php endif; ?>

<a class="btn btn-primary" href="/login">Comprar / Inscribirme</a>
