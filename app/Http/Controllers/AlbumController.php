<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums=Album::all();
        return view('index')->with('albums',$albums);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            $album =new Album([
                "name" =>$request->name,
                
            ]);
           $album->save();
       

            if($request->hasFile("pictures")){
                $files=$request->file("pictures");
                foreach($files as $file){
                    $pictureName=time().'_'.$file->getClientOriginalName();
                    $request['album_id']=$album->id;
                    $request['picture']=$pictureName;
                    $file->move(\public_path("/pictures"),$pictureName);
                    Picture::create($request->all());

                }
            }

            return redirect("/");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $albums=Album::findOrFail($id);
      
        return view('edit')->with('albums',$albums);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
     $album=Album::findOrFail($id);
    

        $album->update([
            "name" =>$request->name,
           
        ]);

        if($request->hasFile("pictures")){
            $files=$request->file("pictures");
            foreach($files as $file){
                $pictureName=time().'_'.$file->getClientOriginalName();
                $request["album_id"]=$id;
                $request["picture"]=$pictureName;
                $file->move(\public_path("pictures"),$pictureName);
                Picture::create($request->all());

            }
        }

        return redirect("/");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $posts=Album::findOrFail($id);

     
         $images=Picture::where("album_id",$posts->id)->get();
         foreach($images as $image){
            $image->delete();
         if (File::exists("pictures/".$image->picture)) {
            File::delete("pictures/".$image->picture);
        }
         }
         $posts->delete();
       
         return back();


    }

    public function deletepictures($id){
        $albums=Album::findOrFail($id);
         $album=Album::where("id","!=",$albums->id)->first();
         $pictures=Picture::where("album_id",$albums->id)->get();
       
         foreach($pictures as $picture){
            $picture->update([
                'album_id' =>$album->id,
                
            ]);
    
        
         }
         $albums->delete();
         return back();
   }
   public function deletepicture($id){
    $pictures=Picture::findOrFail($id);
    if (File::exists("pictures/".$pictures->picture)) {
       File::delete("pictures/".$pictures->picture);
   }

   Picture::find($id)->delete();
   return back();
}


  


}