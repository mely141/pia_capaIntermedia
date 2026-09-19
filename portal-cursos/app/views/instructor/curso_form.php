<h1>Nuevo curso</h1>

<nav class="tabs">
    <a href="/instructor/dashboard" class="tab">Resumen</a>
    <a href="/instructor/cursos" class="tab">Mis cursos</a>
    <a href="/instructor/ventas" class="tab">Ventas</a>
</nav>

<form method="post" action="/instructor/cursos" enctype="multipart/form-data" id="form-curso" novalidate>
    <label for="titulo">Título</label>
    <input type="text" id="titulo" name="titulo" required>

    <label for="descripcion">Descripción</label>
    <textarea id="descripcion" name="descripcion" required></textarea>

    <label for="categoria">Categoría</label>
    <select id="categoria" name="categoria" required>
        <option value="">Selecciona...</option>
    </select>

    <label for="imagen">Imagen del curso</label>
    <input type="file" id="imagen" name="imagen" accept="image/*" required>

    <label for="costo">Costo del curso completo</label>
    <input type="number" id="costo" name="costo" min="0" step="0.01">

    <label for="niveles">Cantidad de niveles</label>
    <input type="number" id="niveles" name="niveles" min="1" required>

    <button type="submit" class="btn btn-primary">Guardar curso</button>
</form>

<p><em>Nota: la carga de niveles, videos y contenido se implementa en la 2da entrega.</em></p>
