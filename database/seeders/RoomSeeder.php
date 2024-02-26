<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 30; ++$i) {
            Room::updateOrcreate([
                'code' => 'RO_' . $i,
            ], [
                'code' => 'RO_' . $i,
                'name' => 'room ' . $i,
                'desc' => 'Phòng sạch sẽ ' . $i,
                'price' => $i + 2 * $i,
                'type' => $this->getTypeRoom($i),
                'status' => $i % 2 == 0 ? Room::STATUS_OPEN : Room::STATUS_MAINTAIN,
            ]);
        }
    }

    private function getTypeRoom($i)
    {
        if (($i % 2 === 0) && ($i % 3 === 0)) {
            return Room::TYPE_LUXURY;
        } else if ($i % 2 === 0) {
            return Room::TYPE_COUPLE;
        }
        return Room::TYPE_SINGLE;
    }
}
