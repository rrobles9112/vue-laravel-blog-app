<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Tags;
use App\Http\Requests\CreateTagsRequest;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function all()
    {
        $tags = Tags::all();

        return response()->json([
            "tags" => $tags
        ], 200);
    }

    public function get($id)
    {
        $tag = Tags::findOrFail($id);


        return response()->json([
            "tag" => $tag
        ], 200);
    }

    public function new(CreateTagsRequest $request)
    {
        $tag = Tags::create($request->only(["name"]));

        return response()->json([
            "tag" => $tag
        ], 200);
    }


    public function edit(Request $request,$id)
    {   


        $input = $request->all();
        $tag = Tags::findOrFail($id);
        $tag->name=$input['name'];
        $tag->save();

        return response()->json([
            "tag"=>"Updated Sucessfully"
           ],200);

    }

    public function delete(Request $request,$id)
    {


        $input = $request->all();
        $tag = Tags::findOrFail($id);
        $tag->name=$input['name'];
        $tag->save();

        return response()->json([
            "tag"=>"Updated Sucessfully"
        ],200);

    }

}
