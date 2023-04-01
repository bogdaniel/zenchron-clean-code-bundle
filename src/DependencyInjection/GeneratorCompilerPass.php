<?php

// src/DependencyInjection/GeneratorPass.php

namespace Zenchron\CleanCodeBundle\DependencyInjection;

use Zenchron\CleanCodeBundle\Service\GeneratorLoader;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

class GeneratorCompilerPass implements CompilerPassInterface, ServiceSubscriberInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has(GeneratorLoader::class)) {
            return;
        }

        $definition = $container->findDefinition(GeneratorLoader::class);
        $classGeneratorServices = $container->findTaggedServiceIds('generator');
        foreach ($classGeneratorServices as $id => $tags) {
            $serviceDefinition = $container->getDefinition($id);
            $tags = array_keys($serviceDefinition->getTags());
            foreach($tags as $tag) {
                $definition->addMethodCall('addTaggedGenerator', [new Reference($id), $tag]);

            }
        }
    }

    public static function getSubscribedServices(): array
    {
        return [
            GeneratorLoader::class,
        ];
    }

}
