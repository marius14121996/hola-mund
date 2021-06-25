<?php require('init.php'); ?>
<?php

    $error = false;
    $title = '';
    $excerpt = '';
    $content = '';

    if ( isset($_POST['submit-new-post']) ){

        //saneo los inputs del formulario a traves de la funcion filter_input() que recibecomo argumentos: una cte(constantes) de PHP para decirle de donde viene ( si post o get). El 2º argunmentose le dice el nombre del input del form. Y el 3º argumento le decimos como queremos que lo sanee con el tipo de filtro (son ctes de PHP ya definidas)
        //$title = $_POST['title']; 
        $title = filter_input( INPUT_POST, 'title', FILTER_SANITIZE_STRING );
        //$excerpt = $_POST['excerpt'];
        $excerpt = filter_input( INPUT_POST, 'excerpt', FILTER_SANITIZE_STRING );
        //$content = $_POST['content'];
        //con la funcion strip_tags me permite indicar qu etiquetas html estan permitidas. el primer argumento es el strin de la entrada
        $content = strip_tags( $_POST['content'], '<br><p><a><img><div><h2><h3><h4><h5><h6>');

        if( empty( $title ) || empty( $content )  ){
            $error = true;
        }else{
            insert_post( $title, $excerpt, $content );
            redirect_to('index.php?success=true');
        }   
    }

    //$title = '"onclick="alert()""';
   
?>
<!--pongo el require del header después de la cabecera con la redirección, xq no puedo insertar una cabecera después de haber pintado un trozo de HTML-->
<?php require('templates/header.php'); ?>

    <h2>Crear nuevo post</h2>

    <?php if ($error): ?>
        <div class="error">
            Error en el formulario.
        </div>
    <?php endif; ?>

    <form action="" method="post">
        <label for="title">Título (requerido)</label>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars( $title, ENT_QUOTES); ?>">

        <label for="excerpt">Extracto</label>
        <input type="text" name="excerpt" id="excerpt" value="<?php echo htmlspecialchars( $excerpt, ENT_QUOTES); ?>">

        <label for="content">Contenido (requerido)</label>
        <textarea name="content" id="content" cols="30" rows="30"><?php echo htmlspecialchars( $content, ENT_QUOTES); ?></textarea>

        <p>
            <input type="submit" name="submit-new-post" value="Nuevo post">
        </p>
    </form>

<?php require('templates/footer.php'); ?>
    