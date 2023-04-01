<?php

namespace Zenchron\CleanCodeBundle\Service;

use Zenchron\CleanCodeBundle\Service\Contract\ClassGeneratorContract;
use Symfony\Component\Filesystem\Filesystem;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class UseCaseDomainRequestClassGenerator extends ClassGenerator implements ClassGeneratorContract
{
    protected string $fileLocation = 'Domain\UseCases';
    private string $templateName = '@ZenchronCleanCode/use_case_domain_request';
    private string $classNameSuffix = 'Request';

    public function __construct(Filesystem $filesystem, Environment $twig)
    {
        parent::__construct($filesystem, $twig);
    }

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

        $this->filename = $this->getFilename([$useCase, $boundedContext, $this->classNameSuffix]);

        // Clean and format directory and filename arguments
        $directory = $this->formatPath($boundedContext . '/' . $this->fileLocation);
        $this->filePath = $this->generateFilePath($directory, $useCase);

        $this->generateFile($this->templateName, $variables);
    }
}
