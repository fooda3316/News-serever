<?php

namespace App\Http\Controllers;

use App\Models\Source;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;

class SourceController extends Controller
{
    public function index(Request $request) {
        $client = new Client();
        $req = $client->request('GET','https://newsapi.org/v1/sources', [
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        ]);

        $stream   = $req->getBody();
        $contents = json_decode($stream->getContents());
        $sources = collect($contents->sources);

        $sources->each(function ($source) {
            $ng_source = Source::updateOrCreate(['id' => $source->id],
            [
                'category'       => $source->category,
                'description'    => $source->description,
                'url'            => $source->url,
                'language'       => $source->language,
                'country'        => $source->country,
                'NG_Description' => 'xxx',
                'NG_Review'      => 'yyy',
            ]);
        });

        return Source::all();

    }

    public function show(Request $request, Source $source) {
        return $source;
    }
    public function storeSource(Request $request){
        $request->validate([
            'name' => 'required',
            'url' => 'required',
            'category' => 'required',
            'language' => 'required',
            'country' => 'required'
        ]);

        $storedNews=Source::create($request->all());
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
