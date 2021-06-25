<?php require('init.php'); ?>
<?php
    //Borrar post de la base de datos
    if ( isset($_GET['delete-post']) ){
        $id = $_GET['delete-post'];

        //if ($_GET['hash'] == '1234'){

        if(!check_hash('delete-post-' . $id, $_GET['hash'] ) ){
            die('con que hackeandome eh?');
        }

        delete_post( $id );
        redirect_to('index.php?success-del=' . $id);
    }
    //llamo a la función get_all_posts() para recoger todos los posts de la bbdd
    $all_posts = get_all_posts();

    //Nueva Lógica para mostrar un post u otro individualmente a través del parámetro 'view' que le paso por la URL y cogiéndo el post de la bbdd
    $post_found = null;
    if ( isset( $_GET['view'] ) ) { 

       $post_found = get_post( $_GET['view'] );
       
       if ( $post_found ){
            $all_posts = [$post_found];
        }
    }

    
?>
<?php require('templates/header.php'); ?>

        <!--muestro un mensaje de éxito después de añadir un nuevo post a través del parámetro success que meto en la redirección de la cabecera en new-post.php-->
        <?php if( isset( $_GET['success'] ) ): ?>
            <div class="success">
                El post ha sido creado
            </div>
        <?php endif; ?>

        <!--muestro mensaje de éxito cuando el post ha sido eliminado-->
        <?php if (isset( $_GET['success-del'] ) ): ?>
            <div class="success">
                El post con id <?php echo $_GET['success-del']; ?>  ha sido eliminado correctamente
            </div>
        <?php endif; ?>
        

        <div class="posts">
            <?php foreach ( $all_posts as $post ) : ?>  
                <article class="post">
                    <header>
                        <h2 class="post-title">
                            <a href="?view=<?php echo $post['id']; ?>">
                                <?php echo $post['title']; ?>
                            </a>
                        </h2>
                    </header>
                    <div class="post-content">
                        <?php if ( $post_found ): ?>
                            <?php echo $post['content']; ?>
                        <?php else: ?>
                            <?php echo $post['excerpt']; ?>
                        <?php endif; ?>
                    </div>
                    <footer>
                        <span class="post-date">
                            Publicada en: 
                            <?php $timestamp = strtotime( $post['published_on'] ); ?>
                            <?php echo strftime('%d %B %Y %H:%M', $timestamp ); ?>
                        </span>
                        <div class="delete-post">
                            <a href="?delete-post=<?php echo $post['id']; ?>&hash=<?php echo generate_hash('delete-post-' . $post['id']); ?>">Eliminar post</a>
                        </div>
                    </footer>
                </article>
            <?php endforeach; ?>
        </div>
<?php require('templates/footer.php'); ?>