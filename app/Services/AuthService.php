<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Exception;
use Auth;

class AuthService
{
  private $userRepo;
  const ADMIN = 0;

  public function __construct(UserRepository $userRepo)
  {
    $this->userRepo = $userRepo;
  }

  public function login($email, $password)
  {
    if(Auth::attempt(['email' => $email, 'password' => $password]))
    {
      return true;
    }
    return false;
  }
}
