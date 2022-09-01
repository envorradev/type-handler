<?php

namespace Envorra\TypeHandler\Factories;

use Violet\ClassScanner\Scanner;
use Violet\ClassScanner\TypeDefinition;
use Envorra\TypeHandler\Contracts\Factory;
use Violet\ClassScanner\Exception\ParsingException;

/**
 * ScannerFactory
 *
 * @package Envorra\TypeHandler\Factories
 *
 * @extends AbstractFactory<Scanner>
 */
class ScannerFactory extends AbstractFactory
{
    protected array $scanDirs = [];

    protected bool $recursive = true;

    protected int $maxRecurseLevels = -1;

    protected Scanner $scanner;

    protected array $notSettable = [
        'scanner',
    ];

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->scanner = new Scanner();
    }

    /**
     * @inheritDoc
     * @throws ParsingException
     */
    public function create(): Scanner
    {
        if(!empty($this->scanDirs)) {
            $this->scanner->scanDirectories($this->scanDirs, $this->recursive, $this->maxRecurseLevels);
        }

        return $this->scanner;
    }

    /**
     * @return Scanner
     */
    public function getScanner(): Scanner
    {
        return $this->get('scanner');
    }

    /**
     * @return array
     */
    public function getScanDirs(): array
    {
        return $this->get('scanDirs');
    }

    /**
     * @param  array  $dirs
     * @return Factory
     */
    public function setScanDirs(array $dirs): Factory
    {
        return $this->set('scanDirs', $dirs);
    }

    /**
     * @param  array  $dirs
     * @return Factory
     */
    public function addScanDirs(array $dirs): Factory
    {
        return $this->setScanDirs(array_merge($this->getScanDirs(), $dirs));
    }

    /**
     * @param  string  $dir
     * @return Factory
     */
    public function addScanDir(string $dir): Factory
    {
        return $this->addScanDirs([$dir]);
    }
}
