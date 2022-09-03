<?php

namespace Envorra\TypeHandler\Factories;

use Violet\ClassScanner\Scanner;
use Envorra\TypeHandler\Contracts\Factory;
use Envorra\TypeHandler\Providers\Package;
use Violet\ClassScanner\Contracts\Scanner as ScannerContract;

/**
 * ScannerFactory
 *
 * @package Envorra\TypeHandler\Factories
 *
 * @implements Factory<ScannerContract>
 */
class ScannerFactory implements Factory
{
    protected ScannerContract $scanner;

    /**
     * @param  string[]  $scanDirs
     * @param  bool   $recursive
     * @param  int    $maxRecurseLevels
     */
    protected function __construct(array $scanDirs = [], bool $recursive = true, int $maxRecurseLevels = -1)
    {
        $class = static::scannerClass();
        $this->scanner = new $class();

        $this->scanner->scanDirectoriesRecursive([
            Package::path('Contracts/Types'),
            Package::path('Types'),
        ]);

        if(!empty($scanDirs)) {
            $this->scanner->scanDirectories($scanDirs, $recursive, $maxRecurseLevels);
        }
    }

    /**
     * @param  string[]  $scanDirs
     * @param  bool   $recursive
     * @param  int    $maxRecurseLevels
     * @return ScannerContract
     */
    public static function create(array $scanDirs = [], bool $recursive = true, int $maxRecurseLevels = -1): ScannerContract
    {
        return (new self($scanDirs, $recursive, $maxRecurseLevels))->scanner;
    }

    /**
     * @return class-string
     */
    public static function scannerClass(): string
    {
        return Scanner::class;
    }
}
