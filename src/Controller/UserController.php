<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/api/user/{id}", name="api_user_single", methods={"GET"})
     * @param User $data
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function __invoke(User $data, SerializerInterface $serializer)
    {
        $client = $this->tokenStorage->getToken()->getUser();
        if ($client->getRoles() === ['ROLE_ADMIN']) {
            if ($data->getClient()->getId() === $client->getId()) {
                return new JsonResponse($serializer->serialize($data, 'jsonld'), 201, [], true);
                //return $this->json($data, 200, [], []);
            }
            return new JsonResponse("403: Access Denied");
        }
        return new JsonResponse("403: Access Denied!");
    }
}
