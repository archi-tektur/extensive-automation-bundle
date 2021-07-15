<?php

declare(strict_types=1);

namespace Tests\ArchTools\Bundle\ExtensiveAutomationBundle\Utilities;

use ArchTools\Bundle\ExtensiveAutomationBundle\ExtensiveAutomationBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class BundleTestKernel extends Kernel
{
    public function registerBundles(): array
    {
        return [new ExtensiveAutomationBundle()];
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
    }
}