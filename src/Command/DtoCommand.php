<?php

namespace Zenchron\CleanCodeBundle\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Zenchron\CleanCodeBundle\Service\Contract\ClassGeneratorContract;
use Zenchron\CleanCodeBundle\Service\GeneratorLoader;

#[AsCommand(
    name: 'app:make-dto',
    description: 'Add a short description for your command',
)]
class DtoCommand extends Command
{
    private GeneratorLoader $generatorLoader;

    public function __construct(GeneratorLoader $generatorLoader)
    {
        $this->generatorLoader = $generatorLoader;

        parent::__construct();
    }


    protected function configure(): void
    {
        $this
            ->setDescription('Creates a new use case in the specified bounded context')
            ->addArgument('boundedContext', InputArgument::REQUIRED, 'The name of the bounded context')
            ->addArgument('useCaseName', InputArgument::REQUIRED, 'The name of the use case')
            ->addArgument('basePath', InputArgument::OPTIONAL, 'path where it should be created', 'src/');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $boundedContext = $input->getArgument('boundedContext');
        $useCaseName = $input->getArgument('useCaseName');
        $basePath = $input->getArgument('basePath');
        $generators = $this->generatorLoader->getTaggedGenerators('dto-class-generator');
        /** @var ClassGeneratorContract $generator */
        foreach ($generators as $generator) {
            $generator->setBasePath($basePath);
            $generator->generate($boundedContext, $useCaseName);
        }

        $output->writeln(sprintf('Use case "%s" created in bounded context "%s"', $useCaseName, $boundedContext));

        return Command::SUCCESS;

    }

}
