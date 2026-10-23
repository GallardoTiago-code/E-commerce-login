index.php
<img width="1514" height="606" alt="image" src="https://github.com/user-attachments/assets/ac33a83d-f3e8-4c10-8d0b-ffd0a2ac79f4" />

articulo_listado.php
-Con el sistema de modificar y eliminar articulos.
<img width="1666" height="939" alt="image" src="https://github.com/user-attachments/assets/74b670f5-562d-4c12-bd07-b85d28b99920" />

articulo_alta.php
<img width="1836" height="876" alt="image" src="https://github.com/user-attachments/assets/6a364257-aa9c-427e-b546-7b94a37abc7e" />

Mas info:
Arme  una aplicación web completa desde cero usando PHP y MySQL, pensada como un mercado virtual de productos. Lo bueno es que no es solo una página estática: tiene un sistema de login seguro con sesiones, y una sección de administración completa donde podés hacer de todo :  listar productos, filtrarlos por categoría o buscador de texto, darlos de alta con imágenes y modificar o eliminar lo que haga falta.
La conexión a la base (conexiones.php): Es el corazón que conecta PHP con MySQL, con un sistema defensivo de errores.
El acceso y login (index.php y logueo.php): Aquí entra el usuario con sus datos. Por seguridad, viajan por método POST y usamos sentencias preparadas para evitar que cualquiera te meta una inyección SQL fea.
El panel de control e inventario (articulo_listado.php): Es la pantalla principal donde ves la tabla con todos los productos. Le metí filtros combinados para que puedas buscar por nombre y categoría al mismo tiempo.
La modificación de los productos (articulo_alta.php, articulo_modificacion.php, articulo_eliminar.php)
-MODIFICACIÓN: Captura el ID que viaja por la URL ($_GET['id']) mediante una sentencia preparada con MySQLi, consulta la base de datos para traer los datos actuales de ese producto específico y los rellena automáticamente en los inputs para que el usuario pueda editarlos sin empezar de cero.
-ELIMINACION: Funciona como un paso de seguridad o confirmación visual, asegurando que no borres nada por error y preparando la sentencia SQL para dar de baja el registro de forma limpia.
-ALTA: Acá es donde subís los artículos nuevos. Maneja la subida de imágenes con la superglobal $_FILES, les cambia el nombre de forma inteligente para que no se pisen entre sí en la carpeta del servidor, y te muestra una tarjeta.
