<?php

namespace App\Controller;

use App\Entity\Livres;
use App\Repository\LivresRepository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivresController extends AbstractController
{
    #[Route('/admin/livres', name: 'app_livres')] //pour appelr un sevice get(nom de service)
    public function index( LivresRepository $rep): Response
    {
        
        $livres=$rep->findAll();
        dd($livres);
    }


    #[Route('/admin/livres/find/{id}', name: 'app_livres_find_id')] //pour appelr un sevice get(nom de service)
    public function chercher(Livres $livre):Response
    {
        
        dd($livre);
        
    }


    #[Route('/admin/livres/add', name: 'app_livres_add')] //pour appelr un sevice get(nom de service)
    public function add( ManagerRegistry $doctrine): Response
    {   
        $date=new \DateTime('2022-01-01');
       $livre =new Livres();
       $livre->setLibelle('reseauLocal')
       ->setImage('https://via.placeholder.com/300')
       ->setPrix(400)
       ->setResume('reseau')
        ->setDateEdition($date)
        ->setediteur($date);

        $en=$doctrine->getManager();
        $en->persist($livre);
        $en->flush();
        dd($livre);



    }


    #[Route('/admin/livres/update/{id}', name: 'app_livres_find_id')] //pour appelr un sevice get(nom de service)
    public function update_price($id, ManagerRegistry $doctrine): Response
    {

        
        $rep=$doctrine->getRepository(Livres::class);
        $livre=$rep->find($id);
        $livre->setPrix(100);
        $em=$doctrine->getManager();
        $em->flush();                  //dans ce cas on n'a pas besoin de persistance car cet objet déja existe
        dd($livre);
    }


    #[Route('/admin/livres/delete/{id}', name: 'app_livres_deltee_id')] //pour appelr un sevice get(nom de service)
    public function delete($id, ManagerRegistry $doctrine): Response
    {

        
        $rep=$doctrine->getRepository(Livres::class);
        $livre=$rep->find($id);
        $em=$doctrine->getManager();
        $em->remove($livre);
        $em->flush();                  
        dd($livre);
    }

}
