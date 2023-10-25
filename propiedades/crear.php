<?php


//base de datos
require '../includes/config/database.php';
$db = conectarDB();

//consultar para obtener los vendedores
$consulta= "SELECT * FROM vendedores";
$resultado_consulta= mysqli_query($db,$consulta);


//arreglo con mensaje de errores
$errores = [];

// vacios de datos

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$vendedor_id = '';
$estacionamiento = '';


if ($_SERVER["REQUEST_METHOD"] === 'POST') {


    $titulo = $_POST["titulo"];
    $precio = $_POST["precio"];
    $descripcion = $_POST["descripcion"];
    $habitaciones = $_POST["habitaciones"];
    $wc = $_POST["wc"];
    $vendedor_id = $_POST["vendedor_id"];
    $estacionamiento = $_POST["estacionamiento"];


    if (!$titulo) {
        $errores[] = "debes anadir un titulo";
    }
    if (!$precio) {
        $errores[] = "debes anadir un precio";
    }
    if (strlen($descripcion) < 50) {
        $errores[] = "debes anadir una descripcion y debe tener almenos 50 caracteres";
    }
    if (!$habitaciones) {
        $errores[] = "debes anadir habitaciones";
    }
    if (!$wc) {
        $errores[] = "debes anadir banos";
    }

    if (!$vendedor_id) {
        $errores[] = "debes elegir un vendedor";
    }
    if (!$estacionamiento) {
        $errores[] = "debes anadir un estacionamiento";
    }


    //validar u el arreglo de errores este vacio
    if (empty($errores)) {

         //insertar en la base de datos


    $query = "INSERT INTO propiedades  (titulo,precio,descripcion,habitaciones,wc,estacionamiento,vendedores_id ) 
    VALUES ('$titulo',$precio,'$descripcion',$habitaciones,$wc,$estacionamiento,$vendedor_id)";

    $resultado = mysqli_query($db, $query);
    if ($resultado) {
        echo "insertado correctamente";
    }
        
    }



   
}


require '../includes/funciones.php';

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Crear</h1>

    <a href="/bienesraices1/admin/index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error): ?>

        <div  class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
            <?php echo $error; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    <?php  endforeach;  ?>





    <form action="" class="formulario" method="POST">
        <fieldset>
            <legend>Infomacion general</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo" id="titulo" placeholder="Titulo Propiedad" value=" <?php  echo $titulo;  ?>">

            <label for="precio">Precio:</label>
            <input type="number" name="precio" id="precio" placeholder="Precio Propiedad" value=" <?php  echo $precio;  ?>">

            <label for="imagen">Titulo:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png">


            <label for="descripcion">Descripcion:</label>
            <textarea name="descripcion" id="descripcion" cols="30" rows="10"><?php  echo $descripcion;  ?></textarea>

        </fieldset>

        <fieldset>
            <legend> Informacion Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" name="habitaciones" id="habitaciones" placeholder="Numero De Habitaciones" min='1' max='9' value=" <?php  echo $habitaciones;  ?>">

            <label for="wc">Banos:</label>
            <input type="number"
             id="wc" 
             name="wc"
              placeholder="Numero De Banos" 
              min='1' 
              max='9'
            value=" <?php  echo $wc;  ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" name="estacionamiento" id="estacionamiento" placeholder="Numero De Estacionamiento" min='1' max='9' value=" <?php  echo $estacionamiento;  ?>">


        </fieldset>


        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedor_id" id="vendedor_id" required>
                <option value="">--Seleccione--</option>

                <?php  while($vendedor= mysqli_fetch_assoc($resultado_consulta)) : ?>
                    <option value="1"><?php $vendedor['nombre']. " " . $vendedor['apellidos']; ?></option>
                <?php endwhile;  ?>
            </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">


    </form>
</main>

<?php
incluirTemplate('footer');
?>