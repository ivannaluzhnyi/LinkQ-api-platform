<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Feature;
use App\Entity\Property;
use App\Repository\MediaRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

/**
 * Class PropertyFixtures
 * @package App\DataFixtures
 */
class PropertyFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var int
     */
    private int $mediaCursor;

    /**
     * @var MediaRepository
     */
    private MediaRepository $mediaRepository;

    public function __construct(MediaRepository $mediaRepository)
    {
        $this->mediaRepository = $mediaRepository;
        $this->mediaCursor = 0;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($i = 0; $i < 60; ++$i) {
            $property = new Property();
            $property->setTitle($faker->sentence(5));
            $property->setDescription($faker->paragraph);
            $property->setPrice($faker->numberBetween(50000, 1500000));
            $property->setAddress(
                (new Address())
                    ->setStreet($faker->streetAddress)
                    ->setZipcode($faker->postcode)
                    ->setCity($faker->city)
                    ->setCountry($faker->country)
            );
            $property->setFeatures(
                (new Feature())
                    ->setSize($faker->numberBetween(9, 250))
                    ->setRooms($faker->numberBetween(1, 10))
                    ->setBathrooms($faker->numberBetween(1, 4))
                    ->setBedrooms($faker->numberBetween(1, 5))
                    ->setGarages($faker->numberBetween(1, 3))
            );
            $property->setUserRelated(null);

            $nbOfMedias = rand(1, 5);

            $medium = $this->mediaRepository->findBy([], [], $nbOfMedias, $this->mediaCursor);
            foreach ($medium as $media) {
                $property->addMedium($media);
            }
            $this->mediaCursor += $nbOfMedias;

            $manager->persist($property);
        }
        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            MediaFixtures::class
        ];
    }
}
