<?php

/**
 * MobilePhoneTest.php
 *
 * Unit tests for the MobilePhone model.
 * Tests model methods and data integrity.
 *
 * @author Alejandro Carmona
 */

namespace Tests\Unit;

use App\Models\MobilePhone;
use PHPUnit\Framework\TestCase;

class MobilePhoneTest extends TestCase
{
    /**
     * Test that MobilePhone model can be instantiated with valid attributes.
     * Verifies that all setters and getters work correctly.
     */
    public function test_mobile_phone_has_correct_attributes(): void
    {
        // Arrange: Create a new MobilePhone instance with test data
        $phone = new MobilePhone;
        $phone->setName('iPhone 15 Pro');
        $phone->setBrand('Apple');
        $phone->setPrice(129999);
        $phone->setStock(50);

        // Act & Assert: Verify all getters return the correct values
        $this->assertEquals('iPhone 15 Pro', $phone->getName());
        $this->assertEquals('Apple', $phone->getBrand());
        $this->assertEquals(129999, $phone->getPrice());
        $this->assertEquals(50, $phone->getStock());
    }

    /**
     * Test that the price formatting helper method works correctly.
     * Verifies that prices are formatted with thousand separators.
     */
    public function test_mobile_phone_price_is_formatted_correctly(): void
    {
        // Arrange: Create a MobilePhone with a price
        $phone = new MobilePhone;
        $phone->setPrice(1299999);

        // Act: Get the formatted price
        $formattedPrice = $phone->getPriceFormatted();

        // Assert: Verify the price is formatted correctly
        $this->assertEquals('1.299.999', $formattedPrice);
        $this->assertIsString($formattedPrice);
    }
}
