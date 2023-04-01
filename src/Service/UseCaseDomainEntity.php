<?php

namespace Zenchron\CleanCodeBundle\Service;

use Zenchron\CleanCodeBundle\Service\Contract\ClassGeneratorContract;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class UseCaseDomainEntity extends ClassGenerator implements ClassGeneratorContract
{
    protected string $fileLocation = 'Domain\Entity';
    private string $templateName = '@ZenchronCleanCode/use_case_domain_entity';
    private string $classNameSuffix = '';

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function generate(string $boundedContext, string $useCase): void
    {
        $variables = [
            'useCaseName' => $useCase,
            'boundedContext' => $boundedContext,
        ];

        $this->filename = $this->getFilename([$useCase]);

        // Clean and format directory and filename arguments
        // Clean and format directory and filename arguments
        $directory = $this->formatPath($boundedContext.'/'.$this->fileLocation.'/');
        $this->filePath = $this->generateFilePath($directory);

        $this->generateFile($this->templateName, $variables);
    }
}
