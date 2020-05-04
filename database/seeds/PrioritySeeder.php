<?php

use Illuminate\Database\Seeder;
use App\Priority;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $priorities = [
            ['name' => 'mica', 'code' => 1],
            ['name' => 'medie', 'code' => 2],
            ['name' => 'mare', 'code' => 3],
            ['name' => 'urgenta', 'code' => 4],
        ];

        foreach($priorities as $single_priority)
        {
            $check = Priority::where('code', $single_priority['code'])->first();

            if($check === null)
            {
                Priority::create([
                    'name' => $single_priority['name'],
                    'code' => $single_priority['code'],
                ]);
            }
        }
    }
}
