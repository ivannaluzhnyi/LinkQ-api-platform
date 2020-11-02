<?php

namespace App\DataFixtures;

use App\Entity\Media;
use DirectoryIterator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class MediaFixtures
 * @package App\DataFixtures
 */
class MediaFixtures extends Fixture
{
    /**
     * @var KernelInterface
     */
    private KernelInterface $kernel;
    /**
     * @var string
     */
    private string $uploadsDir;

    /**
     * MediaFixtures constructor.
     * @param KernelInterface $kernel
     */
    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
        $this->setUploadsDir($this->kernel->getProjectDir() . '/public/uploads');
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $uploads = new DirectoryIterator($this->getUploadsDir());
        foreach ($uploads as $upload) {
            $media = new Media();

            if (!$upload->isDot() && $upload->getExtension() === 'jpg') {
                $media->setFilename($upload->getFilename());
                $media->setExtension($upload->getExtension());
                $media->setUri('/uploads/' . $upload->getFilename());

                $manager->persist($media);
            }
        }
        $manager->flush();
    }

    /**
     * @return string
     */
    public function getUploadsDir(): string
    {
        return $this->uploadsDir;
    }

    /**
     * @param string $uploadsDir
     */
    public function setUploadsDir(string $uploadsDir): void
    {
        $this->uploadsDir = $uploadsDir;
    }
}
