<?php

namespace Envorra\TypeHandler\Factories;

use Envorra\TypeHandler\Contracts\Types\Type;

/**
 * TypeFactory
 *
 * @package Envorra\TypeHandler\Factories
 *
 * @template TType of Type
 *
 * @extends AbstractFactory<Type>
 */
class TypeFactory extends AbstractFactory
{
    protected mixed $value = null;

    protected ?string $type = null;

    /**
     * @return class-string<Type>
     */
    protected function classSubType(): string
    {
        return Type::class;
    }

    /**
     * @param  string  $type
     * @return $this
     */
    public function setType(string $type): static
    {
        $type = strtolower($type);

        $this->type = match($type) {
            'int' => 'integer',
            'bool' => 'boolean',
            'str' => 'string',
            'obj' => 'object',
            'arr' => 'array',
            'float','real' => 'double',
            default => $type,
        };

        return $this;
    }

    /**
     * @param  mixed  $value
     * @return $this
     */
    public function setValue(mixed $value): static
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param  mixed|null   $value
     * @param  string|null  $type
     * @return Type|null
     */
    public function create(mixed $value = null, ?string $type = null): ?Type
    {
        if($value) {
            $this->setValue($value);
        }

        if($type) {
            $this->setType($type);
        }

        $typeMap = TypeMapFactory::make([
            'subClass' => $this->classSubType()
        ]);

        /** @var class-string<Type>|null $class */
        $class = null;

        if(array_key_exists($this->getType(), $typeMap)) {
            $class = $typeMap[$this->getType()];
        } elseif(in_array($this->getType(), $typeMap)) {
            $class = $typeMap[array_search($this->getType(), $typeMap)];
        }

        return $class ? $class::make($this->getValue()) : null;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type ?? gettype($this->getValue());
    }

    /**
     * @return mixed
     */
    public function getValue(): mixed
    {
        return $this->value ?? '';
    }
}