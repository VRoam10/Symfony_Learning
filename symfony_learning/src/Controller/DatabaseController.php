<?php
// src/Controller/DatabaseController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Connection;

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
    public function showUserInfo(): Response
    {
        // Example query to fetch user information from the "users" table
        $query = 'SELECT * FROM users';
        $users = $this->connection->executeQuery($query)->fetchAllAssociative();

        // Display user information
        $response = '<h1>User Information</h1>';
        foreach ($users as $user) {
            $response .= '<p>ID: '.$user['id'].'</p>';
            $response .= '<p>Name: '.$user['name'].'</p>';
            $response .= '<p>Email: '.$user['email'].'</p>';
            $response .= '<hr>';
        }

        return new Response($response);
    }
}