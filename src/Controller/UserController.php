<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserController extends AbstractController
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/api/user/{id}", name="api_user_single", methods={"GET"})
     * @param $data
     * @return JsonResponse
     */
    public function __invoke(User $data)
    {
        $client = $this->tokenStorage->getToken()->getUser();
        if ($client->getRoles() === ['ROLE_ADMIN']) {
            if ($data->getClient()->getId() === $client->getId()) {
                return $this->json($data, 200, [], []);
            }
            return new JsonResponse("403: Access Denied");
        }
        return new JsonResponse("403: Access Denied!");
    }
}
