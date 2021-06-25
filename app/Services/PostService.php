<?php

namespace App\Services;

use App\Repositories\PostRepository;
use App\Repositories\UserRepository;

class AuthService
{
  private $postRepo;
  private $userRepo;

  public function __construct(
    PostRepository $postRepo, 
    UserRepository $userRepo
  ) {
    $this->postRepo = $postRepo;
    $this->userRepo = $userRepo;
  }

  public function fetchAll()
  {
    return $this->postRepo->fetchAll();
  }

  public function store($form)
  {
    return $this->postRepo->store($form);
  }
}
