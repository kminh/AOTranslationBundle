<?php

/**
 * This file is part of the AOTranslationBundle package.
 *
 * (c) 2015 Adrian Olek <adrianolek@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AO\TranslationBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Khang Minh <kminhlabs@gmail.com>
 */
class TranslatorPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('translator')) {
            $definition = $container->getDefinition('translator');
            $definition->addMethodCall('setDomains', '%ao_translation.persistence.domains%');
        }
    }
}
