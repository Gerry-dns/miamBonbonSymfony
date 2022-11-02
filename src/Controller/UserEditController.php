<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserEditController extends AbstractController
{
    #[Route('/utlisateur/edition/{id}', name: 'user.edit')]
    public function edit(User $user): Response
    {
        if(!$this->getUser()) {
            return $this->redirectToRoute('security.login');
        }

        if($this->getUser() !== $user) {
            return $this->redirectToRoute('/index');
        }

        $form = $this->createForm(UserType::class, $user);



        return $this->render('pages/user_edit/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
