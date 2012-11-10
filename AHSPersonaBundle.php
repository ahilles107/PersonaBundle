<?php

namespace AHS\PersonaBundle;

use AHS\PersonaBundle\DependencyInjection\Security\Factory\PersonaFactory;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AHSPersonaBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new PersonaFactory());
    }
}