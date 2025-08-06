
⸻

✅ README.md

# 🧪 Prueba Técnica - Sistema de Gestión de Empleados

Este proyecto Laravel permite registrar, listar, editar y eliminar empleados, incluyendo asignación de roles, gestión de áreas y suscripciones a boletines informativos.

---

## 📦 Requisitos del sistema

- PHP 8.4.11
- Composer 2.8.10
- Node.js y npm (no utilizados)
- MySQL 9.4.0
- Laravel 12.21.0

---

## 🚀 Instrucciones de instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/hectorfabiopv/prueba_nexura prueba_nexura
cd prueba_nexura

2. Instalar dependencias PHP

composer install

3. Instalar dependencias de frontend

npm install


⸻

⚙️ Configuración del entorno

4. Copiar el archivo .env

5. Generar la clave de la app

php artisan key:generate

6. Configurar la base de datos

Edita el archivo .env y configura estos campos:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=prueba_nexura
DB_USERNAME=root
DB_PASSWORD=tu_contraseña


⸻

🛠 Migraciones y Seeders

7. Crear la base de datos manualmente

Usa tu cliente de base de datos (ej: DBeaver, MySQL Workbench o consola) y crea una base llamada:

prueba_nexura

Con los siguientes parámetros recomendados:
	•	Charset: utf8mb4
	•	Collation: utf8mb4_general_ci

8. Ejecutar las migraciones

php artisan migrate

9. Poblar datos iniciales (áreas y roles)

php artisan db:seed


⸻

🧪 Probar la aplicación

10. Ejecutar el servidor local

php artisan serve

La app estará disponible en:

http://localhost:8000

11. Crear empleados

Haz clic en “+ Nuevo Empleado” y llena el formulario para registrar un nuevo empleado con:
	•	Nombre
	•	Email
	•	Sexo
	•	Área
	•	Descripción
	•	Roles

📝 Los campos marcados con asterisco (*) son obligatorios.

⸻

📤 Funcionalidades implementadas
	•	CRUD de empleados
	•	Relación muchos a muchos con roles
	•	Validaciones completas en frontend y backend
	•	Soft delete con bandera alive
	•	Diseño responsive con Bootstrap
	•	Seeders de áreas y roles incluidos
	•	Vistas con Blade (sin usar Inertia o React para interfaz principal)

⸻

🧰 Tecnologías utilizadas
	•	Laravel 12.21.0
	•	Bootstrap 5
	•	PHP 8.4.11
	•	MySQL 9.4.0
	•	JavaScript Vanilla para validaciones frontend

⸻

Autor

Desarrollado por Hector Fabio Padilla Vasco
Contacto: hectorfabiopv@gmail.com

⸻

✅ Notas adicionales
	•	Se usó arquitectura basada en controladores y vistas Blade para facilitar mantenimiento.
	•	Se puede escalar fácilmente a Inertia o React en el futuro.
	•	La validación se puede probar desactivando el JS (desde DevTools o quitando el script).