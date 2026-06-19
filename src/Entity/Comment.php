<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(inversedBy: 'comment')]
    #[ORM\JoinColumn(nullable: false)]
    private post $post_id;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private user $user_id;

    #[ORM\Column(length: 255)]
    public string $content;

    #[ORM\Column]
    public \DateTimeImmutable $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostId(): ?post
    {
        return $this->post_id;
    }

    public function setPostId(?post $post_id): static
    {
        $this->post_id = $post_id;

        return $this;
    }

    public function getUserId(): ?user
    {
        return $this->user_id;
    }

    public function setUserId(?user $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }
}
