<?php

namespace App\Controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ClientController extends AbstractController
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/api/client/users", name="api_user_list", methods={"GET"})
     * @param UserRepository $data
     * @return JsonResponse
     */
    public function __invoke(UserRepository $data)
    {
        $client = $this->tokenStorage->getToken()->getUser();
        return $this->json($data->findby(['client' => $client->getId()]), 200, [], []);
    }
}
