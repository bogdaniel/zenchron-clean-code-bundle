<?php

namespace Zenchron\CleanCodeBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class ZenchronCleanCodeExtension extends Extension
{
    /**
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new PhpFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../../config')
        );
        $loader->load('services.php');


        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $templateDir = $container->getParameter('zenchron_clean_code.templates_dir');
//dd($templateDir, $config['template_dir']);
        // Set the custom template directory path in the Twig configuration
        $container->setParameter('twig.paths', [$config['template_dir']]);

    }

}
