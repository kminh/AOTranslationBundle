<?php

namespace AO\TranslationBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('ao_translation');

        $rootNode
            ->children()
                ->scalarNode('entity_manager')
                    ->defaultValue('default')
                ->end()
                ->arrayNode('locales')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('label')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('persistence')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('domains')
                        ->info('A list of domain patterns to match')
                            ->prototype('scalar')
                            ->end()
                            /* ->addDefaultsIfNotSet() */
                            /* ->beforeNormalization() */
                            /*     ->ifTrue(function($v) { */
                            /*         return is_null($v) || (is_array($v) && !array_key_exists('blacklist', $v) && !array_key_exists('whitelist', $v)); */
                            /*     }) */
                            /*     ->then(function($v) { */
                            /*         $domains = (array) $v; */

                            /*         $v = []; */
                            /*         $v['whitelist'] = $domains; */

                            /*         return $v; */
                            /*     }) */
                            /* ->end() */
                            /* ->children() */
                            /*     ->arrayNode('blacklist') */
                            /*         ->prototype('scalar') */
                            /*         ->end() */
                            /*     ->end() */
                            /*     ->arrayNode('whitelist') */
                            /*         ->prototype('scalar') */
                            /*         ->end() */
                            /*     ->end() */
                            /* ->end() */
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
