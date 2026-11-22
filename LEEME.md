# Papas a la Francesa La Floresta

Sitio web con catálogo dinámico, pedidos y panel administrativo.
Stack: PHP nativo (PDO) · MySQL · HTML · CSS · JavaScript · XAMPP.

## Puesta en marcha local (XAMPP en Windows)

1. Copia esta carpeta a `C:\xampp\htdocs\papas-la-floresta`.
2. Abre XAMPP e inicia **Apache** y **MySQL**.
3. Entra a http://localhost/phpmyadmin → pestaña **Importar**:
   1. Importa `base_de_datos/estructura.sql`
   2. Importa `base_de_datos/datos_iniciales.sql`
4. Copia `.env.example` como `.env` y ajusta los valores (en XAMPP por defecto: usuario `root`, sin contraseña).
5. Abre http://localhost/papas-la-floresta/publico/inicio.php
   Debes ver "Conexión a MySQL correcta" y la lista de 5 productos.

## Administrador inicial

- Usuario: `admin`
- Contraseña: `Floresta2026!`

Cámbiala antes de publicar el sitio.

## Estructura

- `aplicacion/` lógica PHP (configuración, controladores, modelos, funciones)
- `vistas/` HTML/PHP de las páginas y del panel
- `publico/` lo que ve el navegador (CSS, JS, imágenes)
- `base_de_datos/` scripts SQL
- `rutas/` enrutamiento

## Seguridad

- No subas `.env` a GitHub (ya está en `.gitignore`).
- Consultas siempre preparadas (PDO) y salida escapada con `e()`.
