<?php

// src/Controller/DashboardController.php
namespace App\Controller;

use App\Entity\User;
use App\Entity\Application;
use App\Entity\RolePermissions;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dashboard')]
class DashboardController extends AbstractController
{
    #[Route('/', name: 'app_dashboard')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Get the currently logged-in user
        $user = $this->getUser();

        // If the user is not logged in, redirect to login page
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Get user role
        $role = $user->getRoles()[0]; // Assuming Symfony stores roles as an array
        $applicationName = null;
        $accessType = null;
        $permissions = [];

        // Get application details
        if ($user->getApplicationId()) {
            $application = $entityManager->getRepository(Application::class)->find($user->getApplicationId());
            if ($application) {
                $applicationName = $application->getName();
                $accessType = $application->getType();
            }
        }

        // Get role permissions (if role is not "user")
        if ($role !== "user") {
            $permissions = $entityManager->getRepository(RolePermissions::class)->findBy(['role' => $role]);
        }

        // Pass data to the view
        return $this->render('dashboard/index.html.twig', [
            'user' => $user,
            'role' => $role,
            'applicationName' => $applicationName,
            'accessType' => $accessType,
            'permissions' => $permissions
        ]);
    }
}
