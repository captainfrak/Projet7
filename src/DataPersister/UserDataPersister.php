<?php


namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserDataPersister implements DataPersisterInterface
{
    private $entityManager;
    private $userPasswordEncoder;
    private $tokenStorage;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $userPasswordEncoder,TokenStorageInterface $tokenStorage)
    {
        $this->entityManager = $entityManager;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->tokenStorage = $tokenStorage;
    }

    public function supports($data): bool
    {
        return $data instanceof User;
    }

    public function persist($data)
    {

    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public function remove($data)
    {
        if ($data->getClient()->getId() === $this->tokenStorage->getToken()->getUser()->getId()) {
            $this->entityManager->remove($data);
            $this->entityManager->flush();
            return new JsonResponse('L\'utilisateur a bien été supprimé');
        }
        return new JsonResponse('Vous n\'avez pas le droit de supprimer cet utilisateur');
    }
}