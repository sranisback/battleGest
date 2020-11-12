<?php
namespace App\Service;

use App\Entity\Joueur;
use App\Entity\ListeMecha;
use App\Entity\Mecha;
use App\Entity\Pilot;
use Doctrine\ORM\EntityManagerInterface;
use JoueurFactory;
use MechaFactory;
use PiloteFactory;
use SimpleXMLElement;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImportMULService
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $doctrineEntityManager;

    public function __construct(EntityManagerInterface $doctrineEntityManager)
    {
        $this->doctrineEntityManager = $doctrineEntityManager;
    }

    /**
     * @param UploadedFile $fichierMul
     * @param $repertoireFichiersMul
     */
    public function sauvegarderFichier(UploadedFile $fichierMul, $repertoireFichiersMul)
    {
        $nom = $fichierMul->getClientOriginalName() . date('hms');
        $fichierMul->move($repertoireFichiersMul, $nom);

        return $nom;
    }

    /**
     * @param string $nom
     * @return mixed
     */
    public function traiteFichier(string $nom)
    {
        $xml = file_get_contents($nom);

        $fichier = pathinfo($nom);
        $NomDuJoueur = $fichier['filename'];

        $listeMecha = $this->recupDonneesJoueur($NomDuJoueur);

        $contenuFichierMul = new SimpleXMLElement($xml);

        foreach ($contenuFichierMul->entity as $entite) {
            $this->saveData($entite, $listeMecha);
        }

        $this->doctrineEntityManager->persist($listeMecha);
        $this->doctrineEntityManager->flush();
    }

    /**
     * @param SimpleXMLElement $entite
     * @param ListeMecha $listeMecha
     */
    private function saveData(SimpleXMLElement $entite, ListeMecha $listeMecha): void
    {
        $mecha = $this->doctrineEntityManager
            ->getRepository(Mecha::class)
            ->findOneBy(['modele' => (string)$entite['model']]);

        if (!$mecha) {
            $mecha = MechaFactory::creerMecha((string)$entite['chassis'], (string)$entite['model']);
        }

        $piloteDuXml = $entite->pilot;

        $pilote = $this->doctrineEntityManager
            ->getRepository(Pilot::class)
            ->findOneBy(['nom' => (string)$piloteDuXml['name']]);

        if(!$pilote) {
            $pilote = PiloteFactory::creerPilote(
                (string)$piloteDuXml['name'],
                (int)$piloteDuXml['gunnery'],
                (int)$piloteDuXml['piloting'],
                $mecha
            );
        }

        $ancienneListe = $listeMecha->getMech()->toArray();

        if (!in_array($mecha,$ancienneListe)) {
            $listeMecha->addMech($mecha);
        }

        $this->doctrineEntityManager->persist($mecha);
        $this->doctrineEntityManager->persist($pilote);

        $this->doctrineEntityManager->flush();
    }

    /**
     * @param string $NomDuJoueur
     * @return ListeMecha
     */
    private function recupDonneesJoueur(string $NomDuJoueur): ListeMecha
    {
        $joueur = $this->doctrineEntityManager
            ->getRepository(Joueur::class)
            ->findOneBy(['nom' => $NomDuJoueur]);

        if (!$joueur) {
            $joueur = JoueurFactory::creerJoueur($NomDuJoueur);
            $this->doctrineEntityManager->persist($joueur);
        };

        $listeMecha = new ListeMecha();
        $listeMecha->setJoueur($joueur);
        return $listeMecha;
    }
}