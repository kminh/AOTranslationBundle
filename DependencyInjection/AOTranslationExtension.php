<?php

namespace AO\TranslationBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AOTranslationExtension extends Extension
{
    protected $config;

    protected $container;

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $this->config = $this->processConfiguration($configuration, $configs);
        $this->container = $container;

        $this->setupEntityManager();
        $this->setupLocales();
        $this->setupDomains();

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        if (class_exists('Sonata\AdminBundle\Admin\Admin')) {
            $loader->load('adminServices.xml');
        }
    }

    protected function setupEntityManager()
    {
        $this->container->setParameter('ao_translation.entity_manager', $this->config['entity_manager']);
    }

    protected function setupLocales()
    {
        $locales = array();

        foreach ($this->config['locales'] as $locale => $options) {
            $locales[$locale] = isset($options['label']) ? $options['label'] : $locale;
        }

        $this->container->setParameter('ao_translation.locales', $locales);
    }

    protected function setupDomains()
    {
        $domains = $this->config['persistence']['domains'];
        $this->container->setParameter('ao_translation.persistence.domains', $domains);
    }
}
