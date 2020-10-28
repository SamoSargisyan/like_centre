<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Service\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController
{
    private UserManager $userManager;

    public function __construct (UserManager $userManager)
    {
        $this->userManager = $userManager;
    }
    
}