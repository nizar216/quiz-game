<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Science',
                'image' => 'https://images.unsplash.com/photo-1530134191268-63461648d5f3?w=500&h=500&fit=crop'
            ],
            [
                'name' => 'History',
                'image' => 'https://images.unsplash.com/photo-1507842217343-583f20270319?w=500&h=500&fit=crop'
            ],
            [
                'name' => 'Geography',
                'image' => 'https://images.unsplash.com/photo-1524661135-423995f22d0b?w=500&h=500&fit=crop'
            ],
            [
                'name' => 'Technology',
                'image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=500&h=500&fit=crop'
            ],
            [
                'name' => 'Literature',
                'image' => 'https://images.unsplash.com/photo-1507842722147-6ce40986c739?w=500&h=500&fit=crop'
            ],
            [
                'name' => 'Sports',
                'image' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=500&h=500&fit=crop'
            ],
            [
                'name' => 'Music',
                'image' => 'https://images.unsplash.com/photo-1511379938547-c1f69b13d835?w=500&h=500&fit=crop'
            ],
            [
                'name' => 'Movies',
                'image' => 'https://images.unsplash.com/photo-1485846234645-a62644f84728?w=500&h=500&fit=crop'
            ],
            [
                'name' => 'Mathematics',
                'image' => 'https://images.unsplash.com/photo-1509909756405-be1199881c23?w=500&h=500&fit=crop'
            ],
            [
                'name' => 'Art',
                'image' => 'https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?w=500&h=500&fit=crop'
            ],
            [
                'name' => 'الدوري التونسي',
                'image' => 'https://images.unsplash.com/photo-1592194996308-7b43878e84a1?w=500&h=500&fit=crop'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
