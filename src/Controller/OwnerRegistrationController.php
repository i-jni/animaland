<?php
// src/Controller/OwnerRegistrationController.php
namespace App\Controller;

use App\Entity\Owner;
use App\Form\OwnerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class OwnerRegistrationController extends AbstractController
{
    #[Route('/registration', name: 'owner_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager
    ): Response {
        $owner = new Owner();
        $form = $this->createForm(OwnerType::class, $owner);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hachage du mot de passe
            $plaintextPassword = $owner->getPassword();
            $hashedPassword = $passwordHasher->hashPassword($owner, $plaintextPassword);
            $owner->setPassword($hashedPassword);

            // Sauvegarder en base de données
            $entityManager->persist($owner);
            $entityManager->flush();

            return $this->redirectToRoute('owner_register'); // Redirection après succès
        }

        return $this->render('owner_registration/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
