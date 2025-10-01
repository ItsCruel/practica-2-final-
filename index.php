<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Muebleria RobleClaro</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f4f4f4; margin:0; color:#333; }
    header { background:#4CAF50; color:white; padding:20px; text-align:center; }
    nav { background:#333; padding:10px; text-align:center; }
    nav a { color:white; text-decoration:none; margin:0 15px; font-weight:bold; }
    nav a:hover { text-decoration:underline; }
    section { padding:20px; max-width:800px; margin:auto; }
    footer { background:#222; color:#ccc; text-align:center; padding:15px; margin-top:30px; }
  </style>
</head>
<body>
  <header>
    <h1>Muebleria RobleClaro</h1>
    <p>Diseño y fabricacion de muebles a la medida</p>
  </header>
  <nav>
    <a href="index.php">Inicio</a>
    <a href="clientes.php">Clientes</a>
    <a href="productos.php">Productos</a>
    <a href="servicios.php">Servicios</a>
  </nav>
  <section>
    <h2>Bienvenido</h2>
    <p>Esta es la pagina principal de la Muebleria RobleClaro. Desde aqui puedes navegar para ver nuestros clientes, productos y servicios.</p>
    <h3>Mision</h3>
    <p>Crear muebles duraderos y funcionales que combinen diseño, calidad y respeto por el medio ambiente.</p>
    <h3>Vision</h3>
    <p>Ser reconocidos como la muebleria de confianza, destacando por innovacion, servicio y compromiso con la sostenibilidad.</p>
    <h3>Meta</h3>
    <p>Crecer de forma responsable, ampliando nuestro catalogo y alcanzando mas hogares con productos de excelencia.</p>
  </section>
  <footer>
    &copy; <?php echo date("Y"); ?> Muebleria RobleClaro
  </footer>
</body>
</html>
