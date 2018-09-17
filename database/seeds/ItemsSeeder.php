<?php

use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->clean();

        $faker = \Faker\Factory::create();

        $images = ['item1.jpeg', 'item2.jpeg', 'item3.jpeg', 'item4.jpeg'];

        foreach (range(1, 5) as $index => $item) {

            $rand = array_rand($images);
            $origImagePath = '/images/' . $images[$rand];
            $filename = uniqid() . '.jpeg';
            $imagePath = 'images/' . $filename;

            Storage::copy($origImagePath, $imagePath);

            \App\Item::create([
                'description' => $faker->sentence(8),
                'image_path' => 'app/' . $imagePath,
                'sort_order' => $index +1
            ]);
        }
    }

    /**
     * Clean the database and storage files before run again
     *
     * @return void
     */
    private function clean()
    {
        $items = \App\Item::all();
        foreach ($items as $item) {
            $imagePath = str_replace('app/', '', $item->image_path);
            Storage::delete($imagePath);
            $item->delete();
        }
    }
}
