<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('admin/orders', name: 'admin_orders')]
    public function adminOrders(OrderRepository $repo, EntityManagerInterface $em): Response
    {
        // récupération des noms des colonnes SQL
         $colonnes = $em->getClassMetadata(Order::class)->getFieldNames();
         // récupérations de tout les articles
         $orders = $repo->findAll();

        return $this->render('admin/admin_orders.html.twig', [
            'orders' => $orders,
            'colonnes' => $colonnes
        ]);
    }

    #[Route('admin/order/new', name: 'admin_new_order')]
    #[Route('admin/{id}/edit-order', name: 'admin_edit_order')]
    public function editOrder(Request $request, EntityManagerInterface $manager, Order $order = null)
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
            $this->addFlash('success', "✅ La réservertion à été réalisé avec succès !");
            return $this->redirectToRoute('admin_orders');
        }
        return $this->render('home/form_order.html.twig', [
            'formEdit' => $form->createView(),
            // createView() renvoie un objet représentant l'affichage du formulaire
            'editMode' => $order->getId() !== NULL 
            // si nous sommes sur la route /new : editMode = 0
            // sinon, editMode = 1
        ]);
    }

    #[Route('/admin/{id}/delete-order', name: 'admin_delete_order')]
    public function deleteCommande(Order $order, EntityManagerInterface $manager)
    {
        $manager->remove($order);
        $manager->flush();

        // on envoi un message d'alerte vers la vue
        $this->addFlash('success', "✅ La réservation à bien été annulée !");

        return $this->redirectToRoute('admin_orders');
    }
}
