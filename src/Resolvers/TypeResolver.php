<?php

namespace Envorra\TypeHandler\Resolvers;

use ReflectionClass;
use Envorra\TypeHandler\Maps\TypeMap;
use ReflectionException;
use Envorra\TypeHandler\Maps\PrimitiveMap;
use Envorra\TypeHandler\Contracts\Resolver;
use Envorra\TypeHandler\Contracts\Types\Type;
use Envorra\TypeHandler\Factories\TypeMapFactory;
use Envorra\TypeHandler\Exceptions\ResolverException;

/**
 * TypeResolver
 *
 * @package Envorra\TypeHandler\Resolvers
 *
 * @template T of Type
 *
 * @implements Resolver<T>
 */
class TypeResolver implements Resolver
{
    /**
     * @var T|null
     */
    protected mixed $concrete;

    /**
     * @var mixed
     */
    protected mixed $value;

    /**
     * @var TypeMap
     */
    protected TypeMap $map;

    /**
     * @var int
     */
    protected int $maxAttempts = 10;

    /**
     * @var int
     */
    private int $attempts = 0;

    /**
     * @inheritDoc
     */
    public function __construct(protected mixed $abstract = null)
    {
        $this->map = TypeMapFactory::create(static::typeSubClass());
        $this->attemptResolution();
    }

    /**
     * @return void
     */
    protected function attemptResolution(): void
    {
        $this->concrete = null;

        if(!$this->abstract || $this->attempts >= $this->maxAttempts) {
            return;
        }

        /** @var class-string<Type>|null $resolved */
        $resolved = $this->map->getClass($this->abstract);

        if($resolved) {
            $this->concrete = $resolved::make($this->value ?? '');
        }

        $this->attempts++;
    }

    /**
     * @inheritDoc
     */
    public function hasResolved(): bool
    {
        $type = static::typeSubClass();
        return isset($this->concrete) && $this->concrete instanceof $type;
    }

    /**
     * @inheritDoc
     */
    public function getConcrete(): mixed
    {
        if($this->attempts === 0) {
            $this->attemptResolution();
        }

        if($this->hasResolved()) {
            return $this->concrete;
        }

        throw new ResolverException('Could not resolve abstract '.$this->abstract.' to a valid concrete instance.');
    }

    /**
     * @inheritDoc
     */
    public function setAbstract(mixed $abstract): TypeResolver
    {
        if(is_string($abstract)) {
            $this->abstract = PrimitiveMap::get($abstract);
        }

        $this->abstract ??= $abstract;

        $this->attemptResolution();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getAbstract(): mixed
    {
        return $this->abstract;
    }

    /**
     * @param  mixed  $value
     * @return $this
     */
    public function withValue(mixed $value): TypeResolver
    {
        $this->value = $value;

        $this->attemptResolution();

        return $this;
    }

    /**
     * @param  mixed  $value
     * @return T|null
     */
    public function fromValue(mixed $value): mixed
    {
        $this->withValue($value);
        $type = gettype($value);

        if($type === 'object') {
            try {
                $reflection = new ReflectionClass($value);

                $this->setAbstract($reflection->getShortName());

                if($this->hasResolved()) {
                    return $this->concrete;
                }
            } catch (ReflectionException) {
                // skip trying to resolve object class
            }
        }

        $this->setAbstract($type);

        return $this->hasResolved() ? $this->concrete : null;
    }

    /**
     * @inheritDoc
     */
    public static function resolve(mixed $abstract): mixed
    {
        return static::resolver($abstract)->getConcrete();
    }

    /**
     * @inheritDoc
     */
    public static function tryResolve(mixed $abstract): mixed
    {
        try {
            return static::resolver($abstract)->getConcrete();
        } catch(ResolverException) {
            return null;
        }
    }

    /**
     * @param  mixed  $abstractType
     * @param  mixed  $value
     * @return T|null
     */
    public static function resolveWithValue(mixed $abstractType, mixed $value): mixed
    {
        try {
            return static::resolver($abstractType)->withValue($value)->getConcrete();
        } catch (ResolverException) {
            return null;
        }
    }

    /**
     * @param  string|Type|null  $type
     * @return T|null
     */
    public static function resolveType(string|Type|null $type): mixed
    {
        return static::tryResolve($type);
    }

    /**
     * @param  mixed  $value
     * @return T|null
     */
    public static function resolveValue(mixed $value): mixed
    {
        return static::resolver()->fromValue($value);
    }

    /**
     * @inheritDoc
     */
    public static function resolver(mixed $abstract = null): TypeResolver
    {
        return new TypeResolver($abstract);
    }

    /**
     * @return class-string
     */
    protected static function typeSubClass(): string
    {
        return Type::class;
    }
}
