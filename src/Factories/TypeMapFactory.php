<?php

namespace Envorra\TypeHandler\Factories;

use Exception;
use Violet\ClassScanner\Scanner;
use Violet\ClassScanner\TypeDefinition;
use Envorra\TypeHandler\Providers\Package;
use Envorra\TypeHandler\Contracts\Types\Type;

/**
 * TypeMapFactory
 *
 * @package Envorra\TypeHandler\Factories
 *
 * @extends AbstractFactory<array>
 */
class TypeMapFactory extends AbstractFactory
{
    protected Scanner $scanner;

    protected array $notSettable = [
        'classes',
        'types',
        'scanner',
    ];

    protected array $types = [];

    protected ?string $subType = null;

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->scanner = ScannerFactory::make([
            'scanDirs' => [
                Package::path('Contracts/Types'),
                Package::path('Types'),
            ],
        ]);
    }

    /**
     * @inheritDoc
     */
    public function create(): array
    {
        if($this->subType) {
            $this->types = $this->scanner->getSubClasses($this->subType);
        } else {
            $this->types = $this->scanner->getClasses(TypeDefinition::TYPE_CLASS);
        }

        $map = [];

        /** @var Type $type */
        foreach($this->types as $type) {
            try {
                $map[$type::type()] = $type;
            } catch (Exception) {
                // skip
            }
        }

        return $map;
    }


}
