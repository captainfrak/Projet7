<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhoneRepository")
 * @UniqueEntity(fields={"name"}, message="Ce téléphone existe déjà")
 * @ApiResource(
 *     normalizationContext={"groups"={"phone:read"}},
 *     denormalizationContext={"groups"={"phone:write"}},
 *     collectionOperations=
 *     {
 *          "get"={
 *              "method"="GET",
 *              "openapi_context"={"summary"="Récupére la liste des Phones."}
 *          }
 *     },
 *     itemOperations=
 *     {
 *          "get"={
 *              "method"="GET",
 *              "openapi_context"={"summary"="Récupére le détail d'un Phone grâce à son id."}
 *          }
 *      },
 *     attributes={
 *          "normalisation_context"={"groups"={"read"}}
 *     }
 * )
 */
class Phone
{
    /**
     * @var int the id of the Phone
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"phone:read"})
     */
    private $id;

    /**
     * name of the Phone
     *
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank
     * @Groups({"phone:read"})
     */
    private $name;

    /**
     * Specifications of the Phone
     *
     * @ORM\Column(type="string", length=1000)
     * @Assert\NotBlank
     * @Groups({"phone:read"})
     */
    private $specs;

    /**
     * the price of the Phone
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotNull
     * @Groups({"phone:read"})
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSpecs(): ?string
    {
        return $this->specs;
    }

    public function setSpecs(string $specs): self
    {
        $this->specs = $specs;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }
}
