<?php

namespace App\Controller;

use App\Form\UpdatePasswordType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UserAccountController extends AbstractController
{
    #[Route('/muj-ucet', name: 'app_user_account')]
    public function show(
        Request $request,
        UserRepository $userRepository,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $updatePasswordForm = $this->createForm(UpdatePasswordType::class);
        $updatePasswordForm->handleRequest($request);

        if ($updatePasswordForm->isSubmitted() && $updatePasswordForm->isValid()) {
            $user = $this->getUser();
            $newPassword = $updatePasswordForm->get('password')->getData();

            $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
            $userRepository->upgradePassword($user, $hashedPassword);

            $this->addFlash('success', 'Heslo bylo změněno.');
            return $this->redirectToRoute('app_user_account');
        }

        return $this->render('user_account/show.html.twig', [
            'update_password_form' => $updatePasswordForm,
        ]);
    }
}
