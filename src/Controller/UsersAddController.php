<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;

class UsersAddController extends AbstractController
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/api/users", name="api_user_add", methods={"POST"})
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     * @return JsonResponse
     */
    public function addUser(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $json = $request->getContent();

        $client = $this->tokenStorage->getToken()->getUser();

        if (!$client) {
            return new JsonResponse("403: Access Denied");
        }
        if ($client->getRoles() === ['ROLE_ADMIN']) {
            try {
                $user = $serializer->deserialize($json, User::class, 'json');
                $checkDouble = $entityManager->getRepository(User::class)->findOneBy(['email' => $user->getEmail()]);

                if ($checkDouble) {
                    return $this->json([
                        'status' => 400,
                        'message' => "L'Email a déjà été renseigné'"
                    ], 400);
                }
                $user
                    ->setClient($client
                    )
                    ->setPassword(
                        $userPasswordEncoder->encodePassword($user, $user->getPassword())
                    );
                $entityManager->persist($user);
                $entityManager->flush();

                //return $this->json($user,201, [],[]);
                return new JsonResponse($serializer->serialize($user, 'jsonld'), 200, [], true);
            } catch (NotEncodableValueException $exception) {
                return $this->json([
                    'status' => 400,
                    'message' => $exception->getMessage()
                ], 400);
            }
        }
        return new JsonResponse("403: Access Denied");
    }
}
