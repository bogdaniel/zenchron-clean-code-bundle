<?php

namespace Zenchron\CleanCodeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('zenchron_clean_code');

        $treeBuilder->getRootNode()
            ->children()
            ->scalarNode('template_dir')->defaultValue('%kernel.project_dir%/templates')->end()
            ->end();

        return $treeBuilder;
    }

}
