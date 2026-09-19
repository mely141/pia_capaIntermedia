<h1>Buscar cursos</h1>

<form method="get" action="/buscador" class="form-inline" id="form-buscador">
    <input type="text" name="q" placeholder="Título del curso" value="<?= htmlspecialchars($q) ?>">
    <select name="categoria">
        <option value="">Todas las categorías</option>
        <option value="it" <?= $categoria === 'it' ? 'selected' : '' ?>>IT & Software</option>
        <option value="marketing" <?= $categoria === 'marketing' ? 'selected' : '' ?>>Marketing</option>
        <option value="design" <?= $categoria === 'design' ? 'selected' : '' ?>>Design</option>
    </select>
    <button type="submit" class="btn btn-primary">Buscar</button>
</form>

<div class="grid-cards">
    <?php if (empty($resultados)): ?>
        <p><em>Sin resultados (la búsqueda real se conecta en la 2da entrega).</em></p>
    <?php else: foreach ($resultados as $curso): ?>
        <a class="card" href="/curso/<?= (int)$curso['id'] ?>"><?= htmlspecialchars($curso['titulo']) ?></a>
    <?php endforeach; endif; ?>
</div>
