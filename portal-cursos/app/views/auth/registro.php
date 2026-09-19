<h1>Crear cuenta</h1>

<form method="post" action="/registro" enctype="multipart/form-data" id="form-registro" novalidate>
    <label for="nombre_completo">Nombre completo</label>
    <input type="text" id="nombre_completo" name="nombre_completo" required>

    <label for="genero">Género</label>
    <select id="genero" name="genero" required>
        <option value="">Selecciona...</option>
        <option value="F">Femenino</option>
        <option value="M">Masculino</option>
        <option value="O">Otro</option>
    </select>

    <label for="fecha_nacimiento">Fecha de nacimiento</label>
    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>

    <label for="email">Correo electrónico</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Contraseña</label>
    <input type="password" id="password" name="password" required
           minlength="8"
           title="Mínimo 8 caracteres, una mayúscula, un número y un carácter especial">
    <small id="password-hint">Mínimo 8 caracteres, con al menos una mayúscula, un número y un carácter especial.</small>

    <label for="rol">Quiero registrarme como</label>
    <select id="rol" name="rol" required>
        <option value="estudiante">Estudiante</option>
        <option value="instructor">Instructor</option>
    </select>

    <label for="avatar">Foto de perfil (avatar)</label>
    <input type="file" id="avatar" name="avatar" accept="image/*" required>

    <button type="submit" class="btn btn-primary">Crear cuenta</button>
</form>
