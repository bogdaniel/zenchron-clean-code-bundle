<?php
// src/Command/CreateCleanArchitectureFoldersCommand.php

namespace Zenchron\CleanCodeBundle\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

#[AsCommand(
    name: 'app:create-clean-architecture-folders',
    description: 'Create a clean code / clean architecture folder structure.'
)]
class CreateCleanArchitectureFoldersCommand extends Command
{
    private array $folders = [
        'Domain' => [
            'Contract',
            'Entity',
            'Service',
            'Repository',
            'EventSubscriber',
            'UseCases',
            'Exception',
        ],
        'Framework' => [
            'Symfony' => [
                'Controller' => [
                    'Console',
                    'Http',
                    'Api',
                ],
                'Form',
                'Collector',
                'Repository',
                'Contract',
                'Entity',
                'View',
                'ArgumentResolver',
                'EventSubscriber',
                'Service',
                'Persistence',
            ],
        ],
        'Presentation' => [
//            'Console',
//            'Http',
//            'Api',
//            'Ui',
        ],
    ];

    protected function configure(): void
    {
        $this
            ->addArgument('boundedContext', InputArgument::REQUIRED, 'The bounded context name.')
            ->addArgument('path', InputArgument::OPTIONAL, 'The path where to generate the folder structure.', 'src');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $boundedContext = $input->getArgument('boundedContext');
        $path = $input->getArgument('path');

        $filesystem = new Filesystem();

        $boundedContextDir = sprintf('%s/%s', $path, $boundedContext);
        if ($filesystem->exists($boundedContextDir)) {
            $output->writeln(sprintf('Directory <comment>%s</comment> already exists. Aborting.', $boundedContextDir));

            return Command::FAILURE;
        }

        $filesystem->mkdir($boundedContextDir);
        $output->writeln(sprintf('Created directory <comment>%s</comment>', $boundedContextDir));

        foreach ($this->folders as $folder => $subFolders) {
            $directory = sprintf('%s/%s', $boundedContextDir, $folder);
            $filesystem->mkdir($directory);
            $output->writeln(sprintf('Created directory <comment>%s</comment>', $directory));

            $this->createSubFolders($filesystem, $output, $directory, $subFolders);
        }

        return Command::SUCCESS;
    }

    private function createSubFolders(
        Filesystem $filesystem,
        OutputInterface $output,
        string $directory,
        array $subFolders
    ): void {
        foreach ($subFolders as $subFolder) {
            if (is_array($subFolder)) {
                $this->createSubFolders($filesystem, $output, $directory, $subFolder);
                continue;
            }

            $subDirectory = sprintf('%s/%s', $directory, $subFolder);
            $filesystem->mkdir($subDirectory);
            $output->writeln(sprintf('Created directory <comment>%s</comment>', $subDirectory));
        }
    }
}
