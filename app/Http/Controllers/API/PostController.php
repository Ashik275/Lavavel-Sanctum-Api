<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['posts'] = Post::all();
        return $this->sendResponse($data,"All post data");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'description' => 'required',
                'image' => 'required|mimes:png,jpg,jpeg,gif',
            ]
        );

        if ($validateUser->fails()) {

            return $this->sendError("Validation error",$validateUser->errors()->all(),401);
        } else {
            $img =  $request->image;
            $ext = $img->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;

            $img->move(public_path() . '/uploads', $imageName);

            $post = Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $imageName,
            ]);

            return $this->sendResponse($post,"Post Created");

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['post'] = Post::select(
            'id',
            'title',
            'description',
            'image'
        )->where(['id' => $id])->get();

   
        return $this->sendResponse($data,"Your single post");

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'description' => 'required'
            ]
        );

        if ($validateUser->fails()) {
            return $this->sendError("Validation error",$validateUser->errors()->all(),401);

        } else {

            $postImage = Post::select('id','image')->where(['id' => $id])->get();
            if($request->image != ''){
                $path = public_path() . '/uploads/';
                if($postImage[0]->image !='' && $postImage[0]->image != null ){
                    $old_file = $path.$postImage[0]->image;
                    if(file_exists($old_file)){
                        unlink($old_file);
                    }
                }
                $img =  $request->image;
                $ext = $img->getClientOriginalExtension();
                $imageName = time() . '.' . $ext;
    
                $img->move(public_path() . '/uploads', $imageName);
            }else{
                $imageName = $postImage[0]->image;
            }
        

            $post = Post::where(['id'=>$id])->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $imageName,
            ]);

      
            return $this->sendResponse($post,"Post Updated");

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {    
        $imagePath = Post::select('image')->where('id',$id)->get();
        $path = public_path() . '/uploads/'.$imagePath[0]['image'];
        unlink($path);
        $post = Post::where('id',$id)->delete();
      
        return $this->sendResponse($post,"Post Deleted");

    }
}
