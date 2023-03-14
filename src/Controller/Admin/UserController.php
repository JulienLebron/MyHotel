<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    #[Route('/admin/users', name: 'admin_users')]
    public function adminUsers(UserRepository $repo, EntityManagerInterface $em)
    {
        // récupération des noms des colonnes SQL
        $colonnes = $em->getClassMetadata(User::class)->getFieldNames();
        // récupérations de tout les articles
        $users = $repo->findAll();
 
     return $this->render('admin/admin_users.html.twig', [
            'users' => $users,
            'colonnes' => $colonnes
        ]);
    }

    #[Route('/admin/{id}/delete-user', name: 'admin_delete_user')]
    public function deleteUser(User $user, EntityManagerInterface $manager)
    {
        $manager->remove($user);
        $manager->flush();
 
        // on envoi un message d'alerte vers la vue
        $this->addFlash('success', "✅ L'utilisateur à bien été supprimé !");
 
        return $this->redirectToRoute('admin_users');
    }
}
