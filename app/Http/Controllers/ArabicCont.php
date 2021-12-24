<?php

namespace App\Http\Controllers;

use App\Models\Source;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArabicCont extends Controller{
    public function getArticlesByCategory($category){

        $sources =Source::where([
            ['category', '=', "{$category}"],
            ['language', '=', "ar"]
        ])->get();
        //$sources =  Source::where('category', '=', $category and'lang','=', $lang)->get()->all();
        if ($sources==null) {
            $responseData['error'] = true;
            $responseData['message'] = "the data is not  found!!!";
            return response()->json($responseData);
        }
        $count =0;
        $all_articles=array();
        $final_articles=array();
        foreach ($sources as $source ){
            $total_articles=$source->articles;
            array_push($all_articles,$total_articles);
            foreach ($total_articles as $article ){
                $count++;
                $source=$article->source;
                $id=$source->id;
                $name=$source->name;
                $temp['id'] = $id;
                $temp['name'] = $name;
                $articles=['source'=>['id'=> $id,'name'=>$name],
                    'author'         => $article->author,
                    'title'          => $article->title,
                    'description'    => $article->description,
                    'url'            => $article->url,
                    'urlToImage'     => $article->urlToImage,
                    'publishedAt'    => Carbon::parse($article->publishedAt),
                    'content'      => $article->content
                ];
                array_push($final_articles,$articles);

            }
        }

        $responseData['status'] = "ok";
        $responseData['totalResults'] = $count;
        $responseData['articles'] =$final_articles;
        return response()->json($responseData);

    }

}
