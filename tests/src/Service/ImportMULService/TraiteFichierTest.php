<?php


namespace src\Service\ImportMULService;

use App\Entity\Joueur;
use App\Entity\ListeMecha;
use App\Entity\Mecha;
use App\Entity\Pilot;
use App\Service\ImportMULService;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class TraiteFichierTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    public function setUp()
    {
        parent::setUp();

        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $schemaTool = new SchemaTool($this->entityManager);
        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool->dropSchema($metadata);
        $schemaTool->createSchema($metadata);
    }

    /**
     * @test
     */
    public function le_fichier_est_bien_lu()
    {
        $texte = '<?xml version="1.0" encoding="UTF-8"?>

<unit version="0.46.1" >

		<entity chassis="Falcon Hawk" model="FNHK-9K1A" type="Biped" commander="false" offboard="false" hidden="false" deployment="0" deploymentZone="-1" neverDeployed="true" externalId="64207cba-66d2-4423-bb25-daa140f031e3" camoCategory="-- No Camo --">
			<pilot size="1" name="Brahmapri Sughavanam" nick="" gunnery="4" piloting="5" externalId="6e8be86b-105b-4aa9-ae1f-1f63619f77c1" ejected="false" autoeject="true"/>
		</entity>

</unit>';

        file_put_contents('public/uploads/fichiers_mul/test.mul1515', $texte);

        $importMULServiceTest = new ImportMULService($this->entityManager);

        $importMULServiceTest->traiteFichier('public/uploads/fichiers_mul/test.mul1515');

        $mechaEnregistre = $this->entityManager->getRepository(Mecha::class)->findAll();
        $piloteEnregistre = $this->entityManager->getRepository(Pilot::class)->findAll();
        $joueurEnregistre = $this->entityManager->getRepository(Joueur::class)->findAll();
        $listeMechaEnregistre = $this->entityManager->getRepository(ListeMecha::class)->findAll();

        $this->assertInstanceOf(Mecha::class, current($mechaEnregistre));
        $this->assertEquals('Falcon Hawk', current($mechaEnregistre)->getChassis());
        $this->assertEquals('FNHK-9K1A', current($mechaEnregistre)->getModele());
        $this->assertInstanceOf(Joueur::class, current($joueurEnregistre));
        $this->assertEquals('test', current($joueurEnregistre)->getNom());
        $this->assertInstanceOf(Pilot::class, current($piloteEnregistre));
        $this->assertEquals('Brahmapri Sughavanam', current($piloteEnregistre)->getNom());
        $this->assertEquals(4, current($piloteEnregistre)->getGunnery());
        $this->assertEquals(5, current($piloteEnregistre)->getPiloting());
        $this->assertInstanceOf(Mecha::class, current($piloteEnregistre)->getMecha());
        $this->assertInstanceOf(ListeMecha::class, current($listeMechaEnregistre));
        $this->assertEquals(current($joueurEnregistre), current($listeMechaEnregistre)->getJoueur());
        $this->assertEquals(current($mechaEnregistre), current($listeMechaEnregistre)->getMech()->first());
    }

    public function tearDown() :void
    {
        parent::tearDown();

        $files = glob('public/uploads/fichiers_mul/' . '*', GLOB_MARK);

        foreach ($files as $file) {
            unlink($file);
        }

        $schemaTool = new SchemaTool($this->entityManager);
        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool->dropSchema($metadata);
        $schemaTool->createSchema($metadata);
    }
}