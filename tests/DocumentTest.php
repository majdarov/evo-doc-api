<?php

namespace App\Tests;

use App\Entity\{Contragent, Document, Product};
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DocumentTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager;
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testCreatingDocument(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        //$routerService = self::$container->get('router');
        //$myCustomService = self::$container->get(CustomService::class);
        $manager = $this->entityManager;

    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }
}
