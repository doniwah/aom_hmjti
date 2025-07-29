<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'order_id' => 'AOM-' . date('YmdHis') . '-' . $this->faker->randomNumber(4),
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'total_price' => $this->faker->numberBetween(50000, 500000),
            'status' => 'paid',
            'barcode' => \Illuminate\Support\Str::random(32),
            'user_id' => User::factory(),
            'ticket_id' => Ticket::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
