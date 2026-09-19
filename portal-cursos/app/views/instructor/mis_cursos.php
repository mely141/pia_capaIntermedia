<h1>Mis cursos</h1>

<nav class="tabs">
    <a href="/instructor/dashboard" class="tab">Resumen</a>
    <a href="/instructor/cursos" class="tab active">Mis cursos</a>
    <a href="/instructor/ventas" class="tab">Ventas</a>
</nav>

<a class="btn btn-primary" href="/instructor/cursos/nuevo">+ Nuevo curso</a>

<table class="table">
    <thead>
        <tr><th>Título</th><th>Categoría</th><th>Niveles</th><th>Estado</th><th>Acciones</th></tr>
    </thead>
    <tbody>
        <?php if (empty($cursos)): ?>
            <tr><td colspan="5"><em>Aún no hay cursos (CRUD completo en 2da entrega).</em></td></tr>
        <?php else: foreach ($cursos as $c): ?>
            <tr>
                <td><?= htmlspecialchars($c['titulo']) ?></td>
                <td><?= htmlspecialchars($c['categoria']) ?></td>
                <td><?= (int)$c['niveles'] ?></td>
                <td><?= $c['activo'] ? 'Activo' : 'Dado de baja' ?></td>
                <td><a href="/curso/<?= (int)$c['id'] ?>">Ver</a></td>
            </tr>
        <?php endforeach; endif; ?>
    </tbody>
</table>
