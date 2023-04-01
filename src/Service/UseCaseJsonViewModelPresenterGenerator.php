<?php

namespace Zenchron\CleanCodeBundle\Service;

use Zenchron\CleanCodeBundle\Service\Contract\ClassGeneratorContract;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class UseCaseJsonViewModelPresenterGenerator extends ClassGenerator implements ClassGeneratorContract
{
    protected string $fileLocation = 'Api';
    private string $templateName = '@ZenchronCleanCode/use_case_json_view_model';
    private string $classNameSuffix = 'JsonViewModel';

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
