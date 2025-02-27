<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class UserRoleController extends AbstractController
{
    #[Route('/admin/users', name: 'admin_users')]
    public function listUsers(EntityManagerInterface $entityManager): Response
    {
        $users = $entityManager->getRepository(User::class)->findAll();
        
        return $this->render('user_role/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/admin/users/{id}/assign-role', name: 'assign_role')]
    public function assignRole(User $user, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $role = $request->request->get('role');

            if ($role) {
                $user->setRoles([$role]); // Assigning new role
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('success', 'Role assigned successfully.');
                return $this->redirectToRoute('admin_users');
            }
        }

        return $this->render('user_role/assign.html.twig', [
            'user' => $user,
        ]);
    }
}
