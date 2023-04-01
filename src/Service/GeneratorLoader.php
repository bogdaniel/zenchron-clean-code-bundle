<?php

namespace Zenchron\CleanCodeBundle\Service;

// src/Service/GeneratorLoader.php


use Zenchron\CleanCodeBundle\Service\Contract\ClassGeneratorContract;

class GeneratorLoader
{
    /** @var ClassGeneratorContract[][] */
    private array $generators = [];

    /** @var ClassGeneratorContract[][] */
    private array $taggedGenerators = [];


    public function addGenerator(ClassGeneratorContract $generator): void
    {
        $this->generators[] = $generator;
    }

    public function getGenerator(string $name): ?array
    {
        return $this->generators[$name] ?? null;
    }


    public function addTaggedGenerator(ClassGeneratorContract $generator, string $tag): void
    {

        $this->taggedGenerators[$tag][] = $generator;
    }

    public function getTaggedGenerators(string $tag): array
    {
        return $this->taggedGenerators[$tag] ?? [];
    }


    public function getGenerators(): array
    {
        return $this->generators;
    }

}

