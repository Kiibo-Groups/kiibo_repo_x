<?php
namespace App\Http\Controllers\Api;

use App\Http\Requests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Elastic\Elasticsearch\ClientBuilder;

use DB;
use Validator;
use Redirect;

class ApiController extends Controller
{

    

    public function welcome()
	{
        $client = ClientBuilder::create()
            ->setHosts(['https://a62f6b59830b4256961df3ea5d7fbe1f.us-central1.gcp.cloud.es.io:443'])
            ->setApiKey('OWgxdTNwQUI0dmJMNUlXQktUMVI6dHJvSzBpUUlSMHVYUmstTkRxZmM4UQ==')
            ->build();
            

        $params = [
            'pipeline' => 'ent-search-generic-ingestion',
            'body' => [
                [
                    'index' => [
                        '_index' => 'nl1',
                        '_id' => '1',
                    ],
                ],
                [
                    'name'  => "adrian quezada",
                    'cv'    => "QZFGAD92061108H000",
                    'curp'  => "QUFA920611HCHZGD05"
                ],
                [
                    'index' => [
                        '_index' => 'nl1',
                        '_id' => '2',
                    ],
                ],
                [
                    'name'  => "morayma vargas bencomo",
                    'cv'    => "QZFGAD92061108H000",
                    'curp'  => "QUFA920611HCHZGD05"
                ]
            ],
        ];
              
        $response = $client->bulk($params); 
        
		return response()->json([
            'StatusCode' => $response->getStatusCode(),
            'body' => (string) $response->getBody()
        ]);
	}

    public function addData(Request $request) 
    {
        return response()->json([
            'data' =>  $request->all()
        ]);
    }

}