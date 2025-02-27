<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\Permission;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\RolePermission;

#[Route('/admin/role-permissions')]
class RolePermissionController extends AbstractController
{
    #[Route('/', name: 'role_permission_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $roles = $entityManager->getRepository(Role::class)->findAll();
        return $this->render('role_permissions/index.html.twig', [
            'roles' => $roles
        ]);
    }

    #[Route('/edit/{id}', name: 'role_permission_edit')]
    public function edit(Role $role, EntityManagerInterface $entityManager, Request $request): Response
    {
        $permissions = $entityManager->getRepository(Permission::class)->findAll();
    
        if ($request->isMethod('POST')) {
            $selectedPermissions = $request->request->all('selectedPermission');
            $role->getPermissions()->clear(); // Remove existing permissions
    
            foreach ($selectedPermissions as $permissionId) {
                $permission = $entityManager->getRepository(Permission::class)->find($permissionId);
                if ($permission) {
                    $rolePermission = new RolePermission();
                    $rolePermission->setRole($role);
                    $rolePermission->setPermission($permission);
                    $role->addPermission($rolePermission);
                }
            }
    
            $entityManager->flush();
            $this->addFlash('success', 'Permissions updated successfully!');
            return $this->redirectToRoute('role_permission_index');
        }
    
        return $this->render('role_permissions/edit.html.twig', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

}

