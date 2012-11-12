<?php

namespace AHS\PersonaBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ahs_persona');

        $rootNode
            ->children()
                ->scalarNode('verifier_url')->defaultValue('https://verifier.login.persona.org/verify')->end()
                ->scalarNode('audience_url')->defaultNull()->end()
            ->end();

        return $treeBuilder;
    }
}
