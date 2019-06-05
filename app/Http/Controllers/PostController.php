<?php

namespace Notifidesktop\Http\Controllers;

use Notifidesktop\Post;
use Illuminate\Http\Request;
use Notifidesktop\Events\PostPublished;
class PostController extends Controller
{
    /**
       * Guarda una nueva publicación en la base de datos.
       */
    public function store(Request $request) 
    {
        /* La validación se puede hacer aquí antes de guardar con $ this-> validate ($ request, $ rules) 

        // obtener datos para guardar en una matriz asociativa 
        // usando $request-> only ()*/
        
        $data = $request->only(['title', 'description']);

        //  guardar publicación y asignar el valor de retorno de la publicación creada a $ post array
        $post = Post::create($data);

        //evento posterior a la publicación de Fire después de que la publicación se haya agregado correctamente a la base de datos
        event(new PostPublished($post));

        // devuelva la publicación como respuesta, Laravel serializa automáticamente esto a JSON
        return response($post, 201);
    }
}
