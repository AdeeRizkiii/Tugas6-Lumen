<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $acceptHeader = $request->header('Accept');
        //validasi
        if ($acceptHeader == 'application/json' || $acceptHeader == 'application/xml') {
            $posts = Post::OrderBy("id","DESC")->paginate(10);

            if($acceptHeader == 'application/json') {
                //respon json
                return response()->json($posts->items('data'), 200);
            }else{
                //create xml post element
                $xml = new \SimpleXMLElement('<posts/>');
                foreach ($posts->items('data') as $item) {
                    //create xml post element
                    $xmlItem = $xml->addChild('post');

                    //mengubah setiap field post menjadi bentuk xml
                    $xmlItem->addChild('id',$item->id);
                    $xmlItem->addChild('title',$item->title);
                    $xmlItem->addChild('status',$item->status);
                    $xmlItem->addChild('content',$item->content);
                    $xmlItem->addChild('user_id',$item->user_id);
                    $xmlItem->addChild('created_at',$item->created_at);
                    $xmlItem->addChild('updated_at',$item->updated_at); 
            }
            return $xml->asXML();
            }
        }else{
            return response('Not Acceptable!',406);
        }
    }

    public function store(Request $request)
    {
        $acceptHeader = $request->header('Accept');

        if ($acceptHeader == 'application/json'){
            $contenTypeHeader = $request->header('Content-Type');

            //validasi : hanya application/json yg valid
            if($contenTypeHeader == 'application/json'){
                $input = $request->all();
                $post = Post::create($input);

                return response()->json($post,200);
            }else{
                return response('Unsupported Media Type',415);
            }
        }else{
            return response('Not Acceptable!',406);
        }
    }

    public function show(Request $request,$id)
    {
        $acceptHeader = $request->header('Accept');

        if ($acceptHeader == 'application/json' || $acceptHeader == 'application/xml'){
            $post = Post::find($id);

        if (!$post){
            abort(404);
        }

        if($acceptHeader == 'application/json' || $acceptHeader == 'application/xml'){
            return response()->json($post,200);
        }else{
            return response('Not Acceptable!',406);
        }
        }

    }

    public function update(Request $request, $id)
    {
        $acceptHeader = $request->header('Accept');

        if ($acceptHeader == 'application/json'){
        $contenTypeHeader = $request->header('Content-Type');

        if($contenTypeHeader == 'application/json'){
            $input =$request->all();

        $post = Post::find($id);

        if (!$post){
            abort(404);
        }

        $post->fill($input);
        $post->save();

        return response()->json($post,200);
        }else{
            return response('Unsupported Media Type',415);
        }
    }else{
        return response('Not Acceptable!',406);
    }
    }

    public function destroy(Request $request, $id)
    {
        $acceptHeader = $request->header('Accept');

        if ($acceptHeader == 'application/json' || $acceptHeader == 'application/xml'){
            $post = Post::find($id);

        if(!$post){
            abort(404);
        }

        $post->delete();
        $message = ['message' => 'Deleted successfully','post_id' => $id];

        if($acceptHeader == 'application/json' || $acceptHeader == 'application/xml'){
            return response()->json($message,200);
        }else{
            return response('Not Acceptable!',406);
        }
        }
    }
    
}