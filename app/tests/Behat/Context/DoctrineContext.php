<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context;

use Behat\Behat\Context\Context;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Component\HttpKernel\KernelInterface;

final class DoctrineContext implements Context
{
    public function __construct(private KernelInterface $kernel)
    {
    }

    /**
     * @Given /clean database/
     */
    public function clearDatabase(): void
    {
        $manager = $this->kernel->getContainer()->get('doctrine.orm.default_entity_manager');

        $metadata = $manager->getMetadataFactory()->getAllMetadata();

        $schema = new SchemaTool($manager);
        $schema->dropSchema($metadata);
        $schema->createSchema($metadata);
    }
}
