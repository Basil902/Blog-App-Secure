<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        $users = [];
        $userData = [
            ['name' => 'Alice Müller',  'email' => 'alice@example.com',  'password' => 'password123'],
            ['name' => 'Bob Schmidt',   'email' => 'bob@example.com',    'password' => 'securepass'],
            ['name' => 'Clara Weber',   'email' => 'clara@example.com',  'password' => 'mypassword'],
            ['name' => 'David Koch',    'email' => 'david@example.com',  'password' => 'test1234'],
            ['name' => 'Admin', 'email' => 'admin@example.com', 'password' => 'admin123'],
            ];

        foreach ($userData as $data) {
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = password_hash($data['password'], PASSWORD_BCRYPT);
            $user->createdAt = new \DateTimeImmutable();
            $manager->persist($user);
            $users[] = $user;
        }

        $posts = [];
        $postData = [
            ['title' => 'Einführung in Symfony',         'content' => 'Symfony ist ein PHP-Framework für moderne Webanwendungen.'],
            ['title' => 'Doctrine ORM Grundlagen',       'content' => 'Doctrine erleichtert den Datenbankzugriff in PHP erheblich.'],
            ['title' => 'Twig Templates verstehen',      'content' => 'Twig ist die Standard-Template-Engine in Symfony.'],
            ['title' => 'MySQL Performance Tipps',       'content' => 'Indizes und Query-Optimierung sind entscheidend für Performance.'],
            ['title' => 'REST APIs mit Symfony',         'content' => 'Symfony eignet sich hervorragend zur Entwicklung von REST APIs.'],
            ['title' => 'Sicherheit in Webanwendungen', 'content' => 'SQL-Injection gehört zu den häufigsten Angriffsvektoren.'],
            ['title' => 'PHP 8 neue Features',           'content' => 'PHP 8 bringt viele Verbesserungen wie Named Arguments.'],
            ['title' => 'Composer Basics',               'content' => 'Composer ist der Paketmanager für PHP-Projekte.'],
            ['title' => 'Git Workflows',                 'content' => 'Feature-Branches und Pull Requests sind bewährte Praktiken.'],
            ['title' => 'Testing mit PHPUnit',           'content' => 'Unit Tests erhöhen die Codequalität und Wartbarkeit.'],
        ];

        foreach ($postData as $i => $data) {
            $post = new Post();
            $post->title = $data['title'];
            $post->content = $data['content'];
            $post->setAuthorId($users[$i % count($users)]);
            $post->createdAt = new \DateTimeImmutable();
            $manager->persist($post);
            $posts[] = $post;
        }

        $commentData = [
            'Sehr hilfreicher Beitrag, danke!',
            'Interessante Perspektive.',
            'Ich habe dabei viel gelernt.',
            'Kannst du das genauer erklären?',
            'Super erklärt, weiter so!',
            'Guter Überblick über das Thema.',
            'Das hat mir bei meinem Projekt geholfen.',
            'Sehr gut geschrieben.',
            'Ich stimme vollkommen zu.',
            'Danke für die ausführliche Erklärung.',
            'Hast du weitere Ressourcen dazu?',
            'Das ist genau was ich gesucht habe.',
            'Klasse Artikel!',
            'Wann kommt der nächste Teil?',
            'Sehr informativ, vielen Dank.',
        ];

        foreach ($commentData as $i => $content) {
            $comment = new Comment();
            $comment->content = $content;
            $comment->setPostId($posts[$i % count($posts)]);
            $comment->setUserId($users[$i % count($users)]);
            $comment->createdAt = new \DateTimeImmutable();
            $manager->persist($comment);
        }

        $manager->flush();
    }
}
