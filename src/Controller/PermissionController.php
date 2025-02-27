<?php

namespace App\Controller;

use App\Entity\Permission;
use App\Form\PermissionType;
use App\Repository\PermissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/Permissions')]
class PermissionController extends AbstractController
{
    #[Route('/', name: 'Permission_index', methods: ['GET'])]
    public function index(PermissionRepository $PermissionRepository): Response
    {
        return $this->render('Permission/index.html.twig', [
            'Permissions' => $PermissionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'Permission_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $Permission = new Permission();
        $form = $this->createForm(PermissionType::class, $Permission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($Permission);
            $entityManager->flush();

            return $this->redirectToRoute('Permission_index');
        }

        return $this->render('Permission/new.html.twig', [
            'Permission' => $Permission,
            'form' => $form->createView(),
        ]);
    }
}
