<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    #[Route('/register/{id}/edit-user', name: 'app_register_edit')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, User $user = null): Response
    {
        $isCreating = false;
        if($user == null)
        {
            $user = new User();
            $user->setCreatedAt(new \DateTime());
            $isCreating = true;
        }
        
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            if($form->get('password')->getData())
            {
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('password')->getData()
                    )
                );
            }
            // dd($form->get('password')->getData());
            // encode the plain password

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('home');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'isCreating' => $isCreating
        ]);
    }
}
