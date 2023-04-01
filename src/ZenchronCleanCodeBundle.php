<?php

namespace Zenchron\CleanCodeBundle;

use Zenchron\CleanCodeBundle\DependencyInjection\GeneratorCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ZenchronCleanCodeBundle extends Bundle
{
    public function build(ContainerBuilder $containerBuilder): void
    {
        parent::build($containerBuilder);
        $containerBuilder->setParameter('zenchron_clean_code.templates_dir', $this->getPath());
        $containerBuilder->addCompilerPass(new GeneratorCompilerPass());
    }
}
