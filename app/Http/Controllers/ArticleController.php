<?php

namespace App\Http\Controllers;


use App\Models\Article;
use App\Models\Source;
use GuzzleHttp\Client;
use Illuminate\Http\Request;


class ArticleController extends Controller{

    public function storeNews(Request $request){
        $request->validate([
            'source_id' => 'required',
            'author' => 'required',
            'title' => 'required',
            'description' => 'required',
            'url' => 'required',
            'urlToImage' => 'required',
            'content' => 'required'

        ]);

        $storedNews=Article::create($request->all());
        if ($storedNews==null){
            $responseData['error'] = true;
            $responseData['message'] = "Data has not been storied!";
            return response()->json($responseData);
        }
        $responseData['error'] = false;
        $responseData['storedNews'] = $storedNews;
        $responseData['message'] = "Data has been storied...";

        return response()->json($responseData);

    }
}
