<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
	private $service;
	const POST_ROUTE = "posts.index";
 
    public function __construct(PostService $service)
    {
    	$this->service = $service;
    }

    public function store(PostRequest $request)
    {
        $form = [
            "title" => $request->title,
            "content" => $request->content, 
        ]
    	try {
            $response = $this->service->store($form);
            if($response)
            {
                return redirect()->route(self::POST_ROUTE)->with(['message' => 'Create successfully']);
            }
        } catch (Exception $e) {
             return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
