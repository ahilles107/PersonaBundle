<?php

namespace FWM\BrowserIDBundle;

use FWM\BrowserIDBundle\DependencyInjection\Security\Factory\BrowserIDFactory;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FWMBrowserIDBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new BrowserIDFactory());
    }
}