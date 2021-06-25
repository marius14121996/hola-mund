<?php

/**
 * Devuelve todo el listado de posts
 */
function get_all_posts() {
    global $app_db;

    $result = mysqli_query( $app_db, 'SELECT * FROM posts' );
    if( !$result ) {
        die( mysqli_error( $app_db ) );
    }

    $all_posts = mysqli_fetch_all( $result, MYSQLI_ASSOC );

    return $all_posts;
}

/**
 * Busca y devuelve un solo post
 * Si no lo encuentra, devuelve NULL
 */
function get_post( $post_id ){
    global $app_db;

    //tambien saneo las variables que no son string, los numeros x ejemplo con la funcion intval()
    $post_id = intval( $post_id );

    $query = 'SELECT * FROM posts WHERE id = '. $post_id;
    $result = mysqli_query( $app_db, $query );

    if( !$result ){
        die( mysqli_error( $app_db ) );
    }

    $post_found = mysqli_fetch_assoc( $result ); //función que devuelve una fila de resultados como array asociativo
    return $post_found;
}

/**
 * Insertar nuevo post
 * 
 * @param $title
 * @param $excerpt
 * @param $content
 * 
 */
function insert_post ( $title, $excerpt, $content ){
    global $app_db;
            
    $published_on = date('Y-m-d H:i:s');

    //mysqli_real_scape_string: con esta funcion me aseguro de sanear lo que me llega de los inputs del formulario antes de meterlos en la tabla de mi bbdd 
    $title = mysqli_real_escape_string( $app_db, $title );
    $excerpt = mysqli_real_escape_string( $app_db, $excerpt );
    $content = mysqli_real_escape_string( $app_db, $content );

    $query = "INSERT INTO posts (title, excerpt, content, published_on) VALUES ('$title','$excerpt','$content','$published_on' )";

    //insertar la query
    $result = mysqli_query( $app_db, $query );
    if ( !$result ){
        die( mysqli_error( $app_db ) ); 
    }
}
/**
 * Eliminar un post
 * 
 * @param $id
 */
function delete_post( $id ){
    global $app_db;

    $id = intval( $id );
    
    $result = mysqli_query( $app_db, "DELETE FROM posts WHERE id = $id" );
    if( !$result ){
        die( mysqli_error( $app_db ) );
    }
}