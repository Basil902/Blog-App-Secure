<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BlogController extends AbstractController
{
    public function __construct(
        protected PostRepository $repository
    )
    {
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->redirectToRoute('app_posts');
    }

    #[Route('/posts', name: 'app_posts')]
    public function posts(): Response
    {
        $posts = $this->repository->findAll();

        return $this->render('index.html.twig', [
            'posts' => $posts
        ]);
    }

    #[Route('/posts/{id}', name: 'app_post')]
    public function post(int $id): Response
    {
        $post = $this->repository->find($id);

        return $this->render('show_post.html.twig', [
            'post' => $post
        ]);
    }

    #[Route('/search', name: 'app_search')]
    public function search(Request $request): Response
    {
        $query = $request->query->get('q', '');

        $posts = $this->repository->findByTitle($query);

        return $this->render('search_result.html.twig', [
            'posts' => $posts
        ]);

    }

}
