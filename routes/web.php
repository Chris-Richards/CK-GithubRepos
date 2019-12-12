<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Carbon\Carbon;

Route::get('/', function () {
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  	CURLOPT_URL => "https://api.github.com/users/culturekings/repos",
	  	CURLOPT_RETURNTRANSFER => true,
	  	CURLOPT_TIMEOUT => 30,
	  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  	CURLOPT_CUSTOMREQUEST => "GET",
	  	CURLOPT_HTTPHEADER => array(
	    	"cache-control: no-cache",
	    	"User-Agent: Awesome-Octocat-App"
	  	),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	$response = json_decode($response, true);
	$Data = array();
	$repoNames = array();

	foreach($response as $r) {
		$time = Carbon::create(date("Y/m/d"))->longRelativeDiffForHumans(Carbon::create($r['created_at']), 5);
		$fork = "❌";
		$stargazers = "⭐️".$r['stargazers_count']. "";

		if($r['fork'] == true) {
			$fork = "✅";
		}

		$temp = array(
			"id" => $r['id'],
			"name" => $r['name'],
			"url" => $r['url'],
			"stargazers" => $stargazers,
			"description" => $r['description'],
			"created_at" => "Created " . substr_replace($time ,"",-5) . "ago",
			"fork" => $fork
		);

		array_push($Data, $temp);
		array_push($repoNames, $r['name']);
	}

    return view('home', [
    	'repos' => $Data,
    	'repoNames' => $repoNames
    ]);
});



















