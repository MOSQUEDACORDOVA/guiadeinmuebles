<?php

namespace Database\Seeders;

use ArchiElite\Announcement\Models\Announcement;
use Botble\Base\Supports\BaseSeeder;
use Botble\Setting\Facades\Setting;
use Carbon\Carbon;

class AnnouncementSeeder extends BaseSeeder
{
    public function run(): void
    {
        Announcement::query()->truncate();

        $announcements = [
            'Explore Our Exciting New Property Listings Now Available in Prime Locations!',
            'Join Us for Exclusive Open House Events This Weekend and Find Your Perfect Home!',
            'Take Advantage of Limited-Time Offers on Luxury Homes with Stunning Features!',
            'Discover Your Dream Home with Our Latest Listings and Personalized Services!',
        ];

        $now = Carbon::now();

        foreach ($announcements as $key => $value) {
            Announcement::query()->create([
                'name' => sprintf('Announcement %s', $key + 1),
                'content' => $value,
                'start_date' => $now,
                'dismissible' => true,
            ]);
        }

        $settings = [
            'announcement_max_width' => '1495',
            'announcement_text_color' => '#00194C',
            'announcement_background_color' => '#f7f7f7',
            'announcement_text_alignment' => 'start',
            'announcement_dismissible' => '1',
        ];

        Setting::delete(array_keys($settings));

        Setting::set($settings)->save();
    }
}
