<?php

namespace Zenchron\CleanCodeBundle\Service;

use Symfony\Component\Filesystem\Filesystem;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Zenchron\CleanCodeBundle\Service\Contract\ClassGeneratorContract;

class UseCaseControllerClassGenerator extends ClassGenerator implements ClassGeneratorContract
{
    protected string $fileLocation = 'Framework\Controller\Http';
    private string $templateName = '@ZenchronCleanCode/use_case_framework_controller';
    private string $classNameSuffix = 'Controller';

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

        $this->filename = $this->getFilename([$boundedContext, $this->classNameSuffix]);

        // Clean and format directory and filename arguments
        $directory = $this->formatPath($boundedContext.'/'.$this->fileLocation);
        $this->filePath = $this->generateFilePath($directory);
        $this->generateFile($this->templateName, $variables);
    }
}
