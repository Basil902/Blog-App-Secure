<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;

final class ProfileController extends AbstractController
{
    public function __construct(
        protected UserRepository $repository,
        protected EntityManagerInterface $em
    )
    {
    }


    #[Route('/profile', name: 'app_profile', methods: ['GET', 'POST'])]
    public function index(Request $request, UserRepository $repository): Response
    {
        /** @var User $curUser */
        $curUser = $this->getUser();
        $newName = null;

        if ($request->isMethod('POST')) {
            
            $name = $request->request->get('name');
            $this->changeName($name, $curUser);
            $newName = $curUser->name;
        }

        return $this->render('profile.html.twig', [
            'newName' => $newName
        ]);
    }

    protected function changeName(string $newName, User $user): void
    {
        if (!$this->repository->isNameAvailable($newName)) {
            throw new \RuntimeException("The name {$newName} is already in use. Pick a new one.");
        }

        $user->name = $newName;
        $this->em->flush();
    }
}
