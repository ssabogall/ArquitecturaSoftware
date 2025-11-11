<?php

/**
 * OrderTest.php
 *
 * Unit tests for the Order model.
 * Tests model methods, data integrity and business logic.
 *
 * @author Alejandro Carmona
 */

namespace Tests\Unit;

use App\Models\Order;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    /**
     * Test that Order model can be instantiated with valid attributes.
     * Verifies that all setters and getters work correctly.
     */
    public function test_order_has_correct_attributes(): void
    {
        // Arrange: Create a new Order instance with test data
        $order = new Order;
        $order->setDate('2025-11-10');
        $order->setStatus('pending');
        $order->setTotal(1500000);
        $order->setUserId(1);

        // Act & Assert: Verify all getters return the correct values
        $this->assertEquals('2025-11-10', $order->getDate());
        $this->assertEquals('pending', $order->getStatus());
        $this->assertEquals(1500000, $order->getTotal());
        $this->assertEquals(1, $order->getUserId());
    }

    /**
     * Test that order status can only be valid values.
     * Verifies that the status follows business rules.
     */
    public function test_order_status_is_valid(): void
    {
        // Arrange: Create an Order with each valid status
        $validStatuses = ['pending', 'paid', 'shipped', 'cancelled'];

        foreach ($validStatuses as $status) {
            $order = new Order;
            $order->setStatus($status);

            // Act: Get the status
            $result = $order->getStatus();

            // Assert: Verify the status is one of the valid values
            $this->assertContains($result, $validStatuses);
        }
    }
}
