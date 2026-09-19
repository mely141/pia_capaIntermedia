<section class="hero">
    <h1>Aprende algo nuevo hoy</h1>
    <p>Cursos autodidactas creados por instructores de todo el mundo.</p>
    <a class="btn btn-primary" href="/buscador">Explorar cursos</a>
</section>

<section>
    <h2>Categorías</h2>
    <ul class="chips">
        <?php if (empty($categorias)): ?>
            <li class="chip">IT &amp; Software</li>
            <li class="chip">Marketing</li>
            <li class="chip">Design</li>
        <?php else: foreach ($categorias as $cat): ?>
            <li class="chip"><?= htmlspecialchars($cat['nombre']) ?></li>
        <?php endforeach; endif; ?>
    </ul>
</section>

<section>
    <h2>Cursos destacados</h2>
    <div class="grid-cards">
        <?php if (empty($cursosDestacados)): ?>
            <p><em>(Se llenará con datos reales en la 2da entrega)</em></p>
        <?php else: foreach ($cursosDestacados as $curso): ?>
            <a class="card" href="/curso/<?= (int)$curso['id'] ?>">
                <h3><?= htmlspecialchars($curso['titulo']) ?></h3>
            </a>
        <?php endforeach; endif; ?>
    </div>
</section>
