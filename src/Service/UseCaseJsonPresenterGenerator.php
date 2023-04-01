<?php

namespace Zenchron\CleanCodeBundle\Service;

use Zenchron\CleanCodeBundle\Service\Contract\ClassGeneratorContract;
use Symfony\Component\Filesystem\Filesystem;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class UseCaseJsonPresenterGenerator extends ClassGenerator implements ClassGeneratorContract
{
    protected string $fileLocation = 'Api';
    private string $templateName = '@ZenchronCleanCode/use_case_json_presenter';
    private string $classNameSuffix = 'JsonPresenter';

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
        $directory = $this->formatPath($boundedContext.'/Presentation/'.$useCase.'/'.$this->fileLocation);

        $this->filePath = $this->generateFilePath($directory);
        $this->generateFile($this->templateName, $variables);
    }
}
