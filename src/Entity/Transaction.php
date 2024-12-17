<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Id;
use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use App\Repository\TransactionRepository;
use ApiPlatform\Metadata\ApiResource;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['transaction:read']],
    denormalizationContext: ['groups' => ['transaction:write']]
)]
#[ORM\Table(name: 'transaction')]
#[ORM\Entity(repositoryClass: TransactionRepository::class)]
class Transaction
{
    #[Id, GeneratedValue, Column(type: 'integer')]
    #[Groups(['transaction:read'])]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Trade::class, inversedBy: 'transactions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['transaction:read', 'transaction:write', ])]
    private Trade $trade;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: false)]
    #[Groups(['transaction:read', 'transaction:write', 'trade:read'])]
    private string $clientName;

    #[ORM\Column(type: Types::FLOAT, nullable: false)]
    #[Groups(['transaction:read', 'transaction:write', 'trade:read'])]
    private float $price;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: false)]
    #[Groups(['transaction:read', 'transaction:write', 'trade:read'])]
    private string $commodity;

    #[ORM\Column(type: Types::INTEGER, nullable: false)]
    #[Groups(['transaction:read', 'transaction:write', 'trade:read'])]
    private int $volume;

    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Groups(['transaction:read', 'transaction:write', 'trade:read'])]
    private string $type; // Can be only "sell" or "buy"

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: false)]
    #[Groups(['transaction:read', 'transaction:write', 'trade:read'])]
    private DateTimeInterface $createdAt;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: false)]
    #[Groups(['transaction:read', 'transaction:write', 'trade:read'])]
    private DateTimeInterface $updatedAt;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    #[Groups(['transaction:read', 'transaction:write', 'trade:read'])]
    private ?DateTimeInterface $deletedAt;

    public function getId(): int
    {
        return $this->id;
    }


    public function setTrade(Trade $trade): void
    {
        $this->trade = $trade;
    }

    public function getClientName(): string
    {
        return $this->clientName;
    }

    public function setClientName(string $clientName): void
    {
        $this->clientName = $clientName;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getCommodity(): string
    {
        return $this->commodity;
    }

    public function setCommodity(string $commodity): void
    {
        $this->commodity = $commodity;
    }

    public function getVolume(): int
    {
        return $this->volume;
    }

    public function setVolume(int $volume): void
    {
        $this->volume = $volume;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getTrade(): Trade
    {
        return $this->trade;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getDeletedAt(): ?DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?DateTimeInterface $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
}
