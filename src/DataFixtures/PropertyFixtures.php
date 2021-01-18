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
 * Class PropertyFixtures.
 */
class PropertyFixtures extends Fixture implements DependentFixtureInterface
{
    private int $mediaCursor;

    private MediaRepository $mediaRepository;

    public function __construct(MediaRepository $mediaRepository)
    {
        $this->mediaRepository = $mediaRepository;
        $this->mediaCursor = 0;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($i = 0; $i < 60; ++$i) {
            $feature = (new Feature())
                    ->setSize($faker->numberBetween(9, 250))
                    ->setRooms($faker->numberBetween(1, 10))
                    ->setBathrooms($faker->numberBetween(1, 4))
                    ->setBedrooms($faker->numberBetween(1, 5))
                    ->setGarages($faker->numberBetween(1, 3));

            $address = (new Address())
                ->setStreet($faker->streetAddress)
                ->setZipcode($faker->postcode)
                ->setCity($faker->city)
                ->setCountry($faker->country);

            $manager->persist($address);
            $manager->persist($feature);
            $property = new Property();
            $property->setTitle($faker->sentence(5));
            $property->setDescription($faker->paragraph);
            $property->setPrice($faker->numberBetween(50000, 1500000));
            $property->setAddress($address);
            $property->setFeatures($feature);
            $property->setUserRelated(null);

            $nbOfMedias = rand(1, 5);

            $medium = $this->mediaRepository->findBy([], [], $nbOfMedias, $this->mediaCursor);
            foreach ($medium as $media) {
                $property->addMedium($media);
            }
            $this->mediaCursor += $nbOfMedias;

            $manager->persist($property);
            $feature->setProperty($property);
            $address->setProperty($property);
            $manager->persist($feature);
            $manager->persist($address);
        }
        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            MediaFixtures::class,
        ];
    }
}
