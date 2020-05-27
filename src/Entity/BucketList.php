<?php

namespace App\Entity;

use Carbon\Carbon;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 *
 * @ApiResource(
 *     collectionOperations={"get","post"},
 *     itemOperations={"get","put"},
 *     normalizationContext={"groups"="bucket_listing:read"}
 * )
 *
 * @ORM\Entity(repositoryClass="App\Repository\BucketListRepository")
 */
class BucketList
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The name of the bucketlist.
     *
     * @ORM\Column(nullable=true)
     * @Groups({"bucket_listing:read"})
     */
    public $name;

    /**
     * @var string The description of the bucketlist.
     *
     * @ORM\Column(type="text")
     * @Groups({"bucket_listing:read"})
     *
     */
    public $description;

    /**
     * @var \DateTimeInterface When the bucketlist was updated.
     *
     * @ORM\Column(nullable=true)
     */
    public $updatedAt;

    /**
     * @var \DateTimeInterface When the bucketlist was created.
     *
     * @ORM\Column(type="datetime")
     */
    public $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setTextDesciption(string $description): self
    {
        $this->description = nl2br($description);

        return $this;
    }

    public function getCreatedAtAgo():string
    {
        return Carbon::instance($this->createdAt)->diffForHumans();
    }
}
