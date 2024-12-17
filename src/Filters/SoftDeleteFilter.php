<?php

namespace App\Filters;

use Psr\Log\LoggerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;

class SoftDeleteFilter extends SQLFilter
{
    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias): string
    {
        if (!$targetEntity->hasField('deletedAt')) {
            return '';
        }

        return $targetTableAlias . '.deleted_at IS NULL';
    }
}
