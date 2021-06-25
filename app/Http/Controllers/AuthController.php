<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
	private $service;
	const USER_ROUTE = "users.index";
 
    public function __construct(AuthService $service)
    {
    	$this->service = $service;
    }

    public function loginView()
    {
    	return view("pages.auth.login");
    }

    public function login(LoginRequest $request)
    {
    	$email = $request->email;
    	$password = $request->password;

    	try {
    		$response = $this->service->login($email, $password);
    		if($response == true)
    		{
    			return redirect()->route(self::USER_ROUTE);
    		}else{
    			 return redirect()->back()->withErrors("メールまたはパスワードが間違っています。");
    		}
    	} catch (Exception $e) {
    		 return redirect()->back()->withErrors($e->getMessage());
    	}
    }
}
