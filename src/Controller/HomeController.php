<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\RoomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'title' => 'Bienvenue sur notre Hotel',
        ]);
    }

    #[Route('/rooms', name: 'rooms')]
    public function rooms(RoomRepository $repo): Response
    {
        $rooms = $repo->findByCategory('Chambre');
        dump($rooms);
        return $this->render('room/rooms.html.twig', [
            'rooms' => $rooms
        ]);
    }

    #[Route('/suites', name: 'suites')]
    public function suites(RoomRepository $repo): Response
    {
        $suites = $repo->findByCategory('Suite');
        dump($suites);
        return $this->render('room/suites.html.twig', [
            'suites' => $suites
        ]);
    }

    #[Route('/rooms/show/{id}', name: 'rooms_show')]
    public function show(RoomRepository $repo, $id)
    {
        /*
        Pour sélectionner un produit dans la BDD, nous utilisons le principe de route paramétrée
        Dans la route, on définit un paramètre de type {id}
        Lorsque nous transmettons dans l'URL par exemple une route '/blog/9', on envoie un id conne en BDD dans l'URL
        Symfony va automatiquement récupérer ce paramètre et le transmettre en argument de la méthode show()
        */
        $room = $repo->find($id);
        return $this->render('room/show.html.twig', [
            'room' => $room
        ]);
    }

    #[Route('/admin', name: 'app_admin')]
    public function admin(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/apropos', name: 'apropos')]
    public function apropos(): Response
    {
        return $this->render('home/apropos.html.twig');
    }

    #[Route('/acces', name: 'acces')]
    public function acces(): Response
    {
        return $this->render('home/acces.html.twig');
    }

    #[Route('/restaurant', name: 'restaurant')]
    public function restaurant(): Response
    {
        return $this->render('home/restaurant.html.twig');
    }

    #[Route('/spa', name: 'spa')]
    public function spa(): Response
    {
        return $this->render('home/spa.html.twig');
    }

    #[Route('/order/new', name: 'new_order')]
    #[Route('/{id}/edit-order', name: 'edit_order')]
    public function editOrder(Request $request, EntityManagerInterface $manager, Order $order = null, Security $security)
    {
        // la classe Request contient les données véhiculées par les superglobales ($_POST, $_GET ...)
        // $vehicule = new Vehicule; // je crée un objet Vehicule vide prêt à être rempli
        if($order == null)
        {
           $order = new Order;
           $order->setCreatedAt(new \DateTime()); // ajout de la date à l'insertion de l'order
        }
        $form = $this->createForm(OrderType::class, $order);
        // createForm() permet de récupérer un formulaire
        // dump($request); // permet d'afficher les données de l'objet $request
        $form->handleRequest($request);
        // handleRequest() permet d'insérer les données du formulaire dans l'objet $order
        // Pour pouvoir insérer les données en BDD, on récupère le manager et on ajoute le code d'insertion
        if($form->isSubmitted() && $form->isValid())
        {
           $tarif = $order->getRooms()->getPrice();
            $debut = $order->getStartAt();
            $fin = $order->getEndAt();
            $interval = $debut->diff($fin);
            $nights = $interval->days;
            $order->setTotal($nights * $tarif);
           //  $total = $order->getTotal();
           //  dd($total);
            $manager->persist($order); // prépare l'insertion de l'order
            $manager->flush(); // on exécute la requête d'insertion 
            // cette méthode permet de nous rediriger vers la page de notre order nouvellement crée
            $this->addFlash('success', "✅ Votre réservation à été réalisé avec succès ! <br> Vous allez recevoir un mail récapitulatif de votre réservation. <br> Merci. <br><br>");
            return $this->redirectToRoute('home');
        }
        return $this->render('home/form_order.html.twig', [
            'formEdit' => $form->createView(),
            // createView() renvoie un objet représentant l'affichage du formulaire
            'editMode' => $order->getId() !== NULL 
            // si nous sommes sur la route /new : editMode = 0
            // sinon, editMode = 1
        ]);
    }

}
