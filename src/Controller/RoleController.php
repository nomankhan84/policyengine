<?php

namespace App\Controller;

use App\Entity\Role;
use App\Form\RoleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/roles')]
class RoleController extends AbstractController
{
    #[Route('/', name: 'Role_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $Roles = $entityManager->getRepository(Role::class)->findAll();

        return $this->render('admin/roles/index.html.twig', [
            'roles' => $Roles,
        ]);
    }

    #[Route('/new', name: 'Role_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $Role = new Role();
        $form = $this->createForm(RoleType::class, $Role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($Role);
            $entityManager->flush();

            return $this->redirectToRoute('Role_index');
        }

        return $this->render('admin/roles/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
