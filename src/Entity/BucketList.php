<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use Carbon\Carbon;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ApiResource(
 *     collectionOperations={"get","post"},
 *     itemOperations={"get","put",
 *      "delete"={"access_control"="is_granted('ROLE_ADMIN')"}
 *     },
 *     normalizationContext={"groups"="bucket_listing:read", "swagger_definition_name"="Read"},
 *     denormalizationContext={"groups"="bucket_listing:write", "swagger_definition_name"="Write"},
 *     attributes={
 *       "pagination_items_per_page"=3
 *     }
 * )
 *
 * @ORM\Entity(repositoryClass="App\Repository\BucketListRepository")
 * @ApiFilter(BooleanFilter::class, properties={"isPublished"})
 * @ApiFilter(SearchFilter::class, properties={"name":"partial", "description":"partial"})
 * @ApiFilter(PropertyFilter::class)
 *
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
     * The wonderfull name of the bucketlist.
     *
     * @ORM\Column(nullable=true)
     * @Groups({"bucket_listing:read", "user:read"})
     * @Groups({"bucket_listing:write"})
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=2,
     *     max=50,
     *     maxMessage="Describe your bucket in 50 chars or less"
     * )
     */
    public $name;

    /**
     * The description of the bucketlist.
     *
     * @ORM\Column(type="text")
     * @Groups({"bucket_listing:read", "user:read"})
     *
     * @Assert\NotBlank()
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

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished = false;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="bucketLists")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"bucket_listing:read"})
     * @Groups({"bucket_listing:write"})
     *
     */
    private $owner;

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * Raw text description
     *
     * @Groups({"bucket_listing:write"})
     * @SerializedName("description")
     *
     */
    public function setTextDesciption(string $description): self
    {
        $this->description = nl2br($description);

        return $this;
    }

    /**
     * Time expressed in text
     *
     *
     * @Groups({"bucket_listing:read"})
     *
     */
    public function getCreatedAtAgo():string
    {
        return Carbon::instance($this->createdAt)->diffForHumans();
    }

    /**
     * @Groups("bucket_listing:read")
     */
    public function getShortDescription(): string
    {
        if (strlen($this->description) < 40) {
            return $this->description;
        }
        return substr($this->description, 0, 40).'...';
    }
}
