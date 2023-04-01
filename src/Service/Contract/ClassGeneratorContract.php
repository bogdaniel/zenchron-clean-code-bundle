<?php

namespace Zenchron\CleanCodeBundle\Service\Contract;

interface ClassGeneratorContract
{
    public function generate(string $boundedContext, string $useCase): void;

}
