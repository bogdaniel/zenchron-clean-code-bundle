<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Zenchron\CleanCodeBundle\Command\CreateUseCaseCommand;
use Zenchron\CleanCodeBundle\DependencyInjection\GeneratorCompilerPass;
use Zenchron\CleanCodeBundle\Service\GeneratorLoader;
use Zenchron\CleanCodeBundle\Service\UseCaseClassGenerator;
use Zenchron\CleanCodeBundle\Service\UseCaseInfrastructureApiControllerClassGenerator;
use Zenchron\CleanCodeBundle\Service\UseCaseInfrastructureHttpControllerClassGenerator;
use Zenchron\CleanCodeBundle\Service\UseCaseDomainClassRepositoryGenerator;
use Zenchron\CleanCodeBundle\Service\UseCaseDomainContractGenerator;
use Zenchron\CleanCodeBundle\Service\UseCaseDomainEntity;
use Zenchron\CleanCodeBundle\Service\UseCaseDomainPresenterContractGenerator;
use Zenchron\CleanCodeBundle\Service\UseCaseDomainRequestClassGenerator;
use Zenchron\CleanCodeBundle\Service\UseCaseDomainResponseClassGenerator;
use Zenchron\CleanCodeBundle\Service\UseCaseHtmlPresenterGenerator;
use Zenchron\CleanCodeBundle\Service\UseCaseHtmlViewModelPresenterGenerator;
use Zenchron\CleanCodeBundle\Service\UseCaseInfrastructureViewHtmlGenerator;
use Zenchron\CleanCodeBundle\Service\UseCaseInfrastructureViewJsonGenerator;
use Zenchron\CleanCodeBundle\Service\UseCaseJsonPresenterGenerator;
use Zenchron\CleanCodeBundle\Service\UseCaseJsonViewModelPresenterGenerator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    $services->load('Zenchron\CleanCodeBundle\\', __DIR__.'/../src/')
        ->exclude([
            __DIR__ . '/../src/DependencyInjection/',
            __DIR__ . '/../src/Entity/',
            __DIR__ . '/../src/Kernel.php',
        ]);

    // Generators
    $services->set(UseCaseDomainRequestClassGenerator::class)
        ->tag('generator')
        ->tag('class-generator');

    $services->set(UseCaseDomainClassRepositoryGenerator::class)
        ->tag('generator')
        ->tag('class-generator');

    $services->set(UseCaseDomainEntity::class)
        ->tag('generator')
        ->tag('dto-class-generator');

    $services->set(UseCaseDomainResponseClassGenerator::class)
        ->tag('generator')
        ->tag('class-generator');

    $services->set(UseCaseClassGenerator::class)
        ->tag('generator')
        ->tag('class-generator');

    $services->set(UseCaseDomainContractGenerator::class)
        ->tag('generator')
        ->tag('class-generator');

    $services->set(UseCaseDomainPresenterContractGenerator::class)
        ->tag('generator')
        ->tag('class-generator');

    $services->set(UseCaseJsonViewModelPresenterGenerator::class)
        ->tag('generator')
        ->tag('presenter-generator')
        ->tag('class-generator');

    $services->set(UseCaseJsonPresenterGenerator::class)
        ->tag('generator')
        ->tag('presenter-generator')
        ->tag('class-generator');

    $services->set(UseCaseHtmlViewModelPresenterGenerator::class)
        ->tag('generator')
        ->tag('presenter-generator')
        ->tag('class-generator');

    $services->set(UseCaseHtmlPresenterGenerator::class)
        ->tag('generator')
        ->tag('presenter-generator')
        ->tag('class-generator');

    $services->set(UseCaseInfrastructureViewHtmlGenerator::class)
        ->tag('generator')
        ->tag('framework-generator')
        ->tag('class-generator');

    $services->set(UseCaseInfrastructureViewJsonGenerator::class)
        ->tag('generator')
        ->tag('framework-generator')
        ->tag('class-generator');

    $services->set(UseCaseInfrastructureHttpControllerClassGenerator::class)
        ->tag('generator')
        ->tag('framework-generator')
        ->tag('class-generator');
    $services->set(UseCaseInfrastructureApiControllerClassGenerator::class)
        ->tag('generator')
        ->tag('framework-generator')
        ->tag('class-generator');


    $services->set(GeneratorCompilerPass::class)
        ->tag('container.service_subscriber');

    $services->set(GeneratorLoader::class)
        ->args([service('service_container')]);

    $services->set(CreateUseCaseCommand::class)
        ->args([service(GeneratorLoader::class)])
        ->tag('console.command')
    ;
};
