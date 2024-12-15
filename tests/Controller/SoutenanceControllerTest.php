<?php

namespace App\Tests\Controller;

use App\Entity\Soutenance;
use App\Repository\SoutenanceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SoutenanceControllerTest extends WebTestCase{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/soutenance/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Soutenance::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Soutenance index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'soutenance[date_soutenance]' => 'Testing',
            'soutenance[Note]' => 'Testing',
            'soutenance[etudiants]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Soutenance();
        $fixture->setDate_soutenance('My Title');
        $fixture->setNote('My Title');
        $fixture->setEtudiants('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Soutenance');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Soutenance();
        $fixture->setDate_soutenance('Value');
        $fixture->setNote('Value');
        $fixture->setEtudiants('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'soutenance[date_soutenance]' => 'Something New',
            'soutenance[Note]' => 'Something New',
            'soutenance[etudiants]' => 'Something New',
        ]);

        self::assertResponseRedirects('/soutenance/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDate_soutenance());
        self::assertSame('Something New', $fixture[0]->getNote());
        self::assertSame('Something New', $fixture[0]->getEtudiants());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Soutenance();
        $fixture->setDate_soutenance('Value');
        $fixture->setNote('Value');
        $fixture->setEtudiants('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/soutenance/');
        self::assertSame(0, $this->repository->count([]));
    }
}
