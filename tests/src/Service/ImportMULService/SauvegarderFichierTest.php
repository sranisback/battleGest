<?php

namespace src\Service\ImportMULService;

use App\Service\ImportMULService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SauvegarderFichierTest extends TestCase
{
    /**
     * @test
     */
    public function le_fichier_est_deplace()
    {
        $file = tempnam(sys_get_temp_dir(), 'upl');

        $fichierTest = new UploadedFile(
            $file,
            'test.mul',
            null,
            null,
            true
        );

        $importMULServiceTest = new ImportMULService($this->createMock(EntityManagerInterface::class));

        $fichierSaved = $importMULServiceTest->sauvegarderFichier($fichierTest, 'public/uploads/fichiers_mul');

        $this->assertTrue(file_exists('public/uploads/fichiers_mul/' . $fichierSaved));
    }

    public function tearDown()
    {
        parent::tearDown();

        $files = glob('public/uploads/fichiers_mul/' . '*', GLOB_MARK);

        foreach ($files as $file) {
            unlink($file);
        }
    }
}
