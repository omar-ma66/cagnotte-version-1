<?php

namespace App\Controller;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Entity\Campagne;
use App\Form\CampagneType;
use App\Entity\Paiement;
use App\Entity\Participants;
use App\Form\PaiementType;
use App\Repository\PaiementRepository;
use App\Repository\CampagneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[Route('/paiement')]
final class PaiementController extends AbstractController
{   

// ################################################################################################################################################

   #[route('/paiement/produit/test',name:'app_payment_produit_test')] 
   public function paiement_test_start():Response
   {
    return $this->render("paiement/paiement_test.html.twig");
   }
   #[Route('/paiement/test', name: 'app_paiement_test')]
    public function checkout(): Response
    {
        // 1. Initialiser Stripe avec la clé secrète stockée dans les paramètres
        Stripe::setApiKey($this->getParameter('stripe_secret_key'));

        // 2. Créer la session Stripe Checkout
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Don pour la campagne collaborative',
                    ],
                    'unit_amount' => 2000, // Prix en centimes (ici 20,00 €)
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            // Génération des URLs absolues pour le retour sur votre site
            'success_url' => $this->generateUrl('app_paiement_success', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('app_paiement_cancel', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        // 3. Rediriger l'utilisateur vers la page hébergée par Stripe
        return $this->redirect($session->url, 303);
    }


    #[Route('/paiement/test/success',name:'app_paiement_success')]
    public function paiement_success():Response
    {

            return new Response(" Stripe OK ca marche");
    }
    
    #[Route('/paiement/test/cancel',name:'app_paiement_cancel')]
    public function paiement_cancel():Response
    {

            return new Response("Stripe Echec");
    }

// ################################################################################################################################################
    #[Route(name: 'app_paiement_index', methods: ['GET'])]
    public function index(PaiementRepository $paiementRepository): Response
    {
        return $this->render('paiement/index.html.twig', [
            'paiements' => $paiementRepository->findAll(),
        ]);
    }
// ################################################################################################################################################

    #[Route('/new', name: 'app_paiement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,CampagneRepository $campagneRepository): Response
    {
        $paiement = new Paiement();
        $id = $request->query->get('id');
        if($id){
            $campagne = $campagneRepository->find($id);
            if($campagne)
                {
                    $paiement->setCampagne($campagne);
                }
        }
       
        $form = $this->createForm(PaiementType::class, $paiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $now = new \DateTimeImmutable();
             $paiement->setCreeA($now);
            $paiement->setMiseAJour($now);
             $campagne =   $paiement->getCampagne();
             $participant = $paiement->getParticipant();
             if ( $participant)
                {
                    $participant->setCreeA($now);
                    $participant->setMiseAJour($now);
                    if (method_exists($participant,'setCampagne')){
                        $participant->setCampagne($campagne);
                    }
                }
            $entityManager->persist($paiement);
            $entityManager->flush();

            return $this->redirectToRoute('app_paiement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('paiement/new.html.twig', [
            'paiement' => $paiement,
            'form' => $form,
            'campagne'=> $id,
            'campagnes' => $campagneRepository->find($id)
         
        ]);
        
    }
// ################################################################################################################################################

    
    // #[Route('/new/{id}', name: 'app_paiement_new', methods: ['GET', 'POST'])]
    // public function new(Request $request,Campagne $campagne, EntityManagerInterface $entityManager): Response
    // {
    //     $paiement = new Paiement();

    //         if(!$paiement->getParticipant()){
    //             $paiement->setParticipant(new Participants());
    //         }

    //     $form = $this->createForm(PaiementType::class, $paiement);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $participant = $paiement->getParticipant() ;
    //         $participant->setCampagne($campagne);
    //         $now = new \DateTimeImmutable();
    //     $paiement->setCreeA($now);
    //     $paiement->setMiseAJour($now);
    //     $participant->setCreeA($now);
    //     $participant->setMiseAJour($now);
    //         $entityManager->persist($paiement);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_paiement_index', [], Response::HTTP_SEE_OTHER);
    //     }
    //     return $this->render('paiement/new.html.twig', [
    //         'paiement' => $paiement,
    //         'campagne'=>$campagne,
    //         'form' => $form,
    //     ]);
    // }
// ################################################################################################################################################

    #[Route('/{id}', name: 'app_paiement_show', methods: ['GET'])]
    public function show(Paiement $paiement): Response
    {
        return $this->render('paiement/show.html.twig', [
            'paiement' => $paiement,
        ]);
    }
// ################################################################################################################################################

    #[Route('/{id}/edit', name: 'app_paiement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Paiement $paiement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PaiementType::class, $paiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_paiement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('paiement/edit.html.twig', [
            'paiement' => $paiement,
            'form' => $form,
        ]);
    }
// ################################################################################################################################################

    #[Route('/{id}', name: 'app_paiement_delete', methods: ['POST'])]
    public function delete(Request $request, Paiement $paiement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$paiement->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($paiement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_paiement_index', [], Response::HTTP_SEE_OTHER);
    }
}
// ################################################################################################################################################

