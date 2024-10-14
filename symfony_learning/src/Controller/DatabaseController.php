<?php
// src/Controller/DatabaseController.php

namespace App\Controller;

use App\Entity\Users;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DatabaseController
{
    private $connection;

    public function setConnection(Connection $connection): void
    {
        $this->connection = $connection;
    }

    /**
     * @Route("/user-info", name="user_info", methods={"GET"})
     */
    // public function showUserInfo(): Response
    // {
    //     // Example query to fetch user information from the "users" table
    //     $query = 'SELECT * FROM users';
    //     $users = $this->connection->executeQuery($query)->fetchAllAssociative();

    //     // Display user information
    //     $response = '<h1>User Information</h1>';
    //     foreach ($users as $user) {
    //         $response .= '<p>ID: '.$user['id'].'</p>';
    //         $response .= '<p>Name: '.$user['name'].'</p>';
    //         $response .= '<p>Email: '.$user['email'].'</p>';
    //         $response .= '<hr>';
    //     }

    //     return new Response($response);
    // }
    
    #[Route('/Test/{id}', name: 'product_show')]
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $product = $doctrine->getRepository(Users::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return new Response('Check out this great product: '.$product->getNom());

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }
}