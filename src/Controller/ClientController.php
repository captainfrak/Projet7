<?php

namespace App\Controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\SerializerInterface;

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
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function __invoke(UserRepository $data, SerializerInterface $serializer)
    {
        $client = $this->tokenStorage->getToken()->getUser();
        if ($client->getRoles() === ['ROLE_ADMIN']) {
            return new JsonResponse($serializer->serialize($data->findby(['client' => $client->getId()]), 'jsonld'), 200, [], true);
            //return $this->json($data->findby(['client' => $client->getId()]), 200, [], []);
        }
        return new JsonResponse("403: Access Denied");
    }
}
