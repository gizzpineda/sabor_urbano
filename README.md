# Sabor Urbano

Sitio web de comida urbana hecho con Laravel. Los clientes ven el menú, arman su pedido y lo envían. El administrador gestiona productos, stock y pedidos.

## Funciones
- **Visitante:** ver el menú y armar el carrito.
- **Cliente:** registrarse, iniciar sesión y enviar pedidos.
- **Administrador:** crear y editar productos, controlar el stock y ver los pedidos.

## Usuarios de prueba
- Administrador: admin@saborurbano.com / password
- Cliente: cliente@saborurbano.com / password

## Tecnologías y diseño
- **Laravel 12** (PHP) para el sistema, el login, los roles y los pedidos.
- **MySQL** como base de datos.
- **Blade** para las vistas.
- **Tailwind CSS v4**, compilado con **Vite**, para todos los estilos. El diseño usa una paleta de negro, gris oscuro y dorado, con tarjetas, botones y animaciones suaves hechos con clases de Tailwind.
- **Iconos SVG propios** (hamburguesa, pizza, lomito, sandwich, empanada, gaseosa y cerveza), sin librerías externas.
- **JavaScript simple** para el carrito: se guarda en el navegador y se envía al servidor al confirmar el pedido.

