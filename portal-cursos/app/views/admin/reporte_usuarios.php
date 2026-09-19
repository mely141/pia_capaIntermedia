<h1>Reporte de usuarios</h1>

<nav class="tabs">
    <a href="/admin/dashboard" class="tab">Resumen</a>
    <a href="/admin/usuarios" class="tab">Usuarios</a>
    <a href="/admin/categorias" class="tab">Categorías</a>
    <a href="/admin/reportes/usuarios" class="tab active">Reportes</a>
</nav>

<form method="get" action="/admin/reportes/usuarios" class="form-inline">
    <select name="tipo">
        <option value="instructor" <?= $tipo === 'instructor' ? 'selected' : '' ?>>Instructores</option>
        <option value="estudiante" <?= $tipo === 'estudiante' ? 'selected' : '' ?>>Estudiantes</option>
    </select>
    <button type="submit" class="btn btn-primary">Ver reporte</button>
</form>

<table class="table">
    <thead>
        <?php if ($tipo === 'instructor'): ?>
            <tr><th>Usuario</th><th>Nombre</th><th>Fecha ingreso</th><th>Cursos ofrecidos</th><th>Total ganancias</th></tr>
        <?php else: ?>
            <tr><th>Usuario</th><th>Nombre</th><th>Fecha ingreso</th><th>Cursos inscritos</th><th>% terminados</th></tr>
        <?php endif; ?>
    </thead>
    <tbody>
        <?php if (empty($reporte)): ?>
            <tr><td colspan="5"><em>Reporte se conecta en la 3ra entrega.</em></td></tr>
        <?php endif; ?>
    </tbody>
</table>
