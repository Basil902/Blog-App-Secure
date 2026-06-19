<?php

namespace App\Entity;

use App\Repository\CommentsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentsRepository::class)]
class Comments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private posts $post_id;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private users $user_id;

    #[ORM\Column(length: 255)]
    public string $content;

    #[ORM\Column]
    public \DateTimeImmutable $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostId(): ?posts
    {
        return $this->post_id;
    }

    public function setPostId(?posts $post_id): static
    {
        $this->post_id = $post_id;

        return $this;
    }

    public function getUserId(): ?users
    {
        return $this->user_id;
    }

    public function setUserId(?users $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }
}
