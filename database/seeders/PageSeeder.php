<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $homePage = Page::create([
            'ar' => [
                'title' => 'الرئيسية',
                'content' => 'الرئيسية',
            ],
            'en' => [
                'title' => 'Home',
                'content' => 'Home',
            ],
        ]);

        $aboutPage = Page::create([
            'ar' => [
                'title' => 'من نحن',
                'content' => 'من نحن',
            ],
            'en' => [
                'title' => 'About Us',
                'content' => 'About Us',
            ],
        ]);
        $servicesPage = Page::create([
            'ar' => [
                'title' => 'الخدمات المقدمة',
                'content' => 'الخدمات المقدمة',
            ],
            'en' => [
                'title' => 'Services',
                'content' => 'Services',
            ],
        ]);
        $contactPage = Page::create([
            'ar' => [
                'title' => 'اتصل بنا',
                'content' => 'اتصل بنا',
            ],
            'en' => [
                'title' => 'Contact Us',
                'content' => 'Contact Us',
            ],
        ]);
    }
}
