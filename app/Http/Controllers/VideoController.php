<?php

namespace App\Http\Controllers;

use File;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mostar el formulario de captura
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // mostrar el formulario de captura
        return view('videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //guarda un nuevo registro apartir de un formulario de nuevo registro
        //validacion del formulario
        $validateData = $this->validate($request, [
            'title' => 'required|min:5',
            'description' => 'required',
            'video' => 'mimes:mp4'
        ]);
        $video = new Video();
        $user = Auth::user();
        $video->user_id = $user->id;
        $video->title = $request->input(key:'title');
        $video->description = $request->input(key:'description');
        //subida de la miniatura
        $image =$request->file(key:'image');
        if($image){
            $image_path = time().$image->getClientOriginalName();
            Storage::disk('images')
            ->put($image_path, File:: get($image));
            $video->image = $image_path;
        }
        //subida de video
        $video_file = $request-> file(key:'videos');
        if ($video) {
            $video = time().$image->getClientOriginalName();
            Storage::disk('videos')
                ->put($video, File::get($video));
            $video->video = $video_path;
        }
        $video->save();
        return redirect()->route(route:'home')->with(array(
            'message' => 'El video se ha subido correctamente'
        ));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //muestra un registro solamente
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //abri el formulario de edicion 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //guarda la modificacion de una edicion 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Borrado
    }
}
