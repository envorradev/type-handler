<?php

namespace Envorra\TypeHandler\Types;

use Illuminate\Support\Collection;
use Envorra\TypeHandler\Types\AbstractTypes\NonPrimitiveType;

/**
 * CollectionType
 *
 * @package Envorra\TypeHandler\Types
 *
 * @extends NonPrimitiveType<Collection>
 */
class CollectionType extends NonPrimitiveType
{
    /**
     * @inheritDoc
     */
    public static function objectClass(): ?string
    {
        return Collection::class;
    }
}
