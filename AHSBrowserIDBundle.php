<?php

namespace AHS\BrowserIDBundle;

use AHS\BrowserIDBundle\DependencyInjection\Security\Factory\BrowserIDFactory;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AHSBrowserIDBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new BrowserIDFactory());
    }
}