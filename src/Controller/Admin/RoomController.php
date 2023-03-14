<?php

namespace App\Controller\Admin;

use App\Entity\Room;
use App\Form\RoomType;
use App\Repository\RoomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoomController extends AbstractController
{
    #[Route('/admin/rooms', name: 'admin_rooms')]
    public function adminRooms(RoomRepository $repo, EntityManagerInterface $em): Response
    {
        $colonnes = $em->getClassMetadata(Room::class)->getFieldNames();
        $rooms = $repo->findAll();
        return $this->render('admin/admin_rooms.html.twig', [
            'colonnes' => $colonnes,
            'rooms' => $rooms
        ]);
    }

    #[Route('/admin/rooms/new', name: 'admin_new_room')]
    #[Route('/admin/{id}/edit-room', name: 'admin_edit_room')]
    public function editRoom(Request $request, EntityManagerInterface $manager, Room $room = null)
    {
        // la classe Request contient les données véhiculées par les superglobales ($_POST, $_GET ...)
        // $produit = new Product; // je crée un objet Vehicule vide prêt à être rempli
        if($room == null)
        {
            $room = new Room;
            $room->setCreatedAt(new \DateTime()); // ajout de la date à l'insertion de l'room
        }
        $form = $this->createForm(RoomType::class, $room);
        // createForm() permet de récupérer un formulaire
        dump($request); // permet d'afficher les données de l'objet $request
        $form->handleRequest($request);
        // handleRequest() permet d'insérer les données du formulaire dans l'objet $room
        // Pour pouvoir insérer les données en BDD, on récupère le manager et on ajoute le code d'insertion
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($room); // prépare l'insertion de l'room
            $manager->flush(); // on exécute la requête d'insertion 
            // cette méthode permet de nous rediriger vers la page de notre room nouvellement crée
            $this->addFlash('success', "✅ L'action sur la chambre à été réalisé avec succès !");
            return $this->redirectToRoute('admin_rooms');
        }
        return $this->render('admin/form_room.html.twig', [
            'formEdit' => $form->createView(),
            // createView() renvoie un objet représentant l'affichage du formulaire
            'editMode' => $room->getId() !== NULL 
            // si nous sommes sur la route /new : editMode = 0
            // sinon, editMode = 1
        ]);
    }

    #[Route('/admin/{id}/delete-room', name: 'admin_delete_room')]
    public function deleteRoom(Room $room, EntityManagerInterface $manager)
    {
        $manager->remove($room);
        $manager->flush();

        // on envoi un message d'alerte vers la vue
        $this->addFlash('success', "✅ La chambre à bien été supprimé !");

        return $this->redirectToRoute('admin_rooms');
    }
}
