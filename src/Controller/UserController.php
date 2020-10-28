<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Service\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private UserManager $userManager;

    public function __construct (UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @Route("/user/update/{id<\d+>}", name="update_user")
     *
     * @param $id
     * @param Request $request
     *
     * @return Response
     */
    public function update ($id, Request $request): Response
    {

        $user = $this->userManager->get($id);
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $this->userManager->update($user);

            return $this->redirectToRoute('show_user', ['id' => $user->getId()]);
        }

        return $this->render('user/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/create", name="create_user")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create (Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $this->userManager->store($user);

            return $this->redirectToRoute('show_user', ['id' => $user->getId()]);
        }

        return $this->render('user/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/show/{id<\d+>}", name="show_user")
     *
     * @param $id
     *
     * @return Response
     */
    public function show ($id): Response
    {
        $user = $this->userManager->get($id);

        return $this->render('user/show.html.twig', compact('user'));
    }
}