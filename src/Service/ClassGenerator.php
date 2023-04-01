<?php

namespace Zenchron\CleanCodeBundle\Service;

// src/Service/ClassGenerator.php

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ClassGenerator
{
    protected string $filename;
    protected string $basePath;
    protected string $directory;

    protected string $fileLocation;
    protected string $boundedContext;
    protected string $useCaseName;
    protected string $filePath;
    private Filesystem $filesystem;
    private Environment $twig;

    public function __construct(Filesystem $filesystem, Environment $twig)
    {
        $this->filesystem = $filesystem;
        $this->twig = $twig;
    }

    /**
     * @return string
     */
    public function getBoundedContext(): string
    {
        return $this->boundedContext;
    }

    public function setBoundedContext(string $boundedContext): void
    {
        $this->boundedContext = $boundedContext;
    }

    /**
     * @return string
     */
    public function getUseCaseName(): string
    {
        return $this->useCaseName;
    }

    public function setUseCaseName(mixed $useCaseName)
    {
        $this->useCaseName = $useCaseName;
    }

    public function generateFilePath(string $directory, string|null $filename = ''): string
    {

        // Define the path to the src directory
        $srcDirectory = $this->getBasePath();


        // Create the full file path by concatenating the src directory, the cleaned directory argument, and the cleaned filename argument
        $filePath = $srcDirectory.$directory.$filename;

        // Return the file path
        return ltrim($this->formatPath($filePath), '/\\');
    }

    /**
     * @param string $path
     * @param bool $filename
     * @return string
     */
    public function formatPath(string|null $path, bool $filename = true): string
    {
        if(null === $path) {
            return '';
        }
        // Clean path argument to ensure correct path formatting
        $path = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);

        // Remove any double slashes
        $path = preg_replace('#'.preg_quote(DIRECTORY_SEPARATOR, '#').'{2,}#', DIRECTORY_SEPARATOR, $path);

        // Add directory separator to beginning or end of path argument if it's missing
        if (strpos($path, DIRECTORY_SEPARATOR) !== 0) {
            $path = DIRECTORY_SEPARATOR.$path;
        }
        if ($filename && strrpos($path, DIRECTORY_SEPARATOR) !== strlen($path) - 1) {
            $path .= DIRECTORY_SEPARATOR;
        }

        // Return the formatted path
        return $path;
    }

    /**
     * @return string
     */
    public function getBasePath(): string
    {
        return $this->basePath;
    }

    /**
     * @param string $basePath
     */
    public function setBasePath(string $basePath): void
    {
        $this->basePath = $basePath;
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    protected function generateFile(string $templateName, array $variables = []): void
    {
        // Check if the file already exists
        if (file_exists($this->filePath.$this->filename)) {
            return;
        }

        $template = $this->compileFileTemplate($templateName, $variables);
        $this->filesystem->dumpFile($this->filePath.$this->filename, $template);
    }

    /**
     * @param string $templateName
     * @param array $variables
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function compileFileTemplate(string $templateName, array $variables): string
    {
        return $this->twig->render(sprintf('%s.tpl', $templateName), $variables);
    }

    protected function getFilename(array $args): string
    {
        $slugger = new AsciiSlugger();

        return sprintf('%s.php', $slugger->slug($this->parseFileName($args)));
    }

    public function parseFileName(array $args): string
    {
        return implode('', $args);
    }

}
