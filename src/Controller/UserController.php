<?php

namespace App\Controller;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @Route("/user/register", name="user.register")
     */
    public function register(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: index(EntityManagerInterface $em)
        $em = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setEmail('xxx@gmail.com');
        $user->setPassword('xxxx');

        $em->persist($user);
        $em->flush();

        return new Response('Saved new User with id '.$user->getId());
    }
}
