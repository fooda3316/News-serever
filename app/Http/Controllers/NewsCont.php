<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NewsCont extends Controller{

    public function displayNewsByLang($lang){
        $news =  News::where('lang', '=', "{$lang}");
        if ($news==null){
            $responseData['error'] = true;
            $responseData['message'] = "the data is not  found!!!";
            return response()->json($responseData);
        }
        //for ($news and)
        $responseData['error'] = false;
        $responseData['sellHistories'] = $news;
        $articles['articles'] = $responseData;

        return response()->json($articles);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeNews(Request $request){
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'url' => 'required',
            'urlToImage' => 'required',
            'publishedAt' => 'required',
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
