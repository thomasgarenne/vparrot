<?php

namespace App\Tests;

use App\Entity\Brands;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BrandTest extends KernelTestCase
{
    public function testBrandEntityIsValid(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $brand = new Brands();
        $brand->setName('Brand #1');

        $errors = $container->get('validator')->validate($brand);

        $this->assertCount(0, $errors);
    }

    public function testBrandEntityInvalidName(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $brand = new Brands();
        $brand->setName('');

        $errors = $container->get('validator')->validate($brand);

        $this->assertCount(2, $errors);
    }
}
