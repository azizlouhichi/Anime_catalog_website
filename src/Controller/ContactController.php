<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\ValueResolver;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Contact;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $name= $request-> get('user_name');
        $email= $request-> get('user_email');
        $sujet= $request-> get('user_sujet');
        $message= $request-> get('user_message');
        $contact = new Contact();
        $contact-> setName($name);
        $contact-> setEmail($email);
        $contact-> setSujet($sujet);
        $contact-> setMessage($message);
        $contact-> setCreatedAt(new \DateTime());

        $em-> persist($contact);
        $em-> flush();
        if ($request->getMethod()==='POST') {
            if($request->get('user_name'==='')){
                $this -> addFlash('error','votre page est ca');
            }
            else{
                $contact=['user_name'=>$request->get('user_name'),
                'user_email'=>$request->get('user_email')];
                $this->addFlash('success','votre message est envoyer avec sucess');
                
            }}
            return $this->render('contact/index.html.twig', [
           
            ]);
        }
        #[Route('/admin/contact', name: 'admin-contact')]
        public function listing(ContactRepository $cR){
            $contacts=$cR->findAll();
            return $this-> render('admin/contact/index.html.twing',
            ['contacts'=>$contacts]);
        }


}