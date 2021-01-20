<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class FeaturedPropertiesController
 * @package App\Controller
 */
class FeaturedPropertiesController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private PropertyRepository $propertyRepository;

    /**
     * FeaturedPropertiesController constructor.
     * @param PropertyRepository $propertyRepository
     */
    public function __construct(PropertyRepository $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }

    /**
     * @return array
     */
    public function __invoke(): array
    {
        return $this->propertyRepository->getFeaturedProperties();
    }
}
