<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait SoftDeleteTrait
{
    /**
     * @var \DateTimeImmutable|null
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeImmutable $deletedAt = null;

    /**
     * Marks the entity as deleted by setting the `deletedAt` field.
     */
    public function softDelete(): void
    {
        $this->deletedAt = new \DateTimeImmutable();
    }

    /**
     * Restores the entity (sets `deletedAt` to null).
     */
    public function restore(): void
    {
        $this->deletedAt = null;
    }

    /**
     * Returns whether the entity is deleted.
     *
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->deletedAt !== null;
    }

    /**
     * Get the value of deletedAt.
     *
     * @return \DateTimeImmutable|null
     */
    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }
}
