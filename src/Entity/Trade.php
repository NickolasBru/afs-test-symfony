<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use App\Interfaces\TradeInterface;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\Repository\TradeRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


#[ApiResource(
    normalizationContext: ['groups' => ['trade:read']],
    denormalizationContext: ['groups' => ['trade:write']]
)]
#[ORM\Table(name: 'trade')]
#[ORM\Entity(repositoryClass: TradeRepository::class)]
#[UniqueEntity('number')]
class Trade
{
    use SoftDeleteTrait;
    #[Id, GeneratedValue, Column(type: 'integer')]
    #[Groups(['trade:read', 'trade:write', 'transaction:read'])]
    private int $id;

    #[ORM\Column(type: Types::STRING, length: 10, unique: true, nullable: false)]
    #[Groups(['trade:read', 'trade:write', 'transaction:read'])]
    private string $number;

    #[ORM\Column(type: Types::DATE_MUTABLE, length: 255, nullable: false)]
    #[Groups(['trade:read', 'trade:write', 'transaction:read'])]
    private DateTimeInterface $date;

    #[ORM\OneToMany(targetEntity: Transaction::class, mappedBy: 'trade')]
    #[Groups(['trade:read', 'trade:write'])]
    private Collection $transactions;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    #[Groups(['trade:read', 'trade:write', 'transaction:read'])]
    private string $note;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: false)]
    #[Groups(['trade:read', 'trade:write', 'transaction:read'])]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: false)]
    #[Groups(['trade:read', 'trade:write', 'transaction:read'])]
    private DateTimeImmutable $updatedAt;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    #[Groups(['trade:read', 'trade:write', 'transaction:read'])]
    private ?DateTimeImmutable $deletedAt = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function getDate(): string
    {
        return $this->date->format('Y-m-d');
    }

    public function setDate(DateTimeInterface $date): void
    {
        $this->date = $date;
    }

    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function setNote(string $note): void
    {
        $this->note = $note;
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
