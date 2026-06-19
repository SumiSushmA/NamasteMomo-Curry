<?php

namespace Database\Seeders;

use App\Data\SeedData;
use App\Models\GiftCardDesign;
use App\Models\GiftCardOccasion;
use Illuminate\Database\Seeder;

class GiftOccasionSeeder extends Seeder
{
    public function run(): void
    {
        if (GiftCardOccasion::query()->exists()) {
            return;
        }

        $designsBySlug = GiftCardDesign::all()->keyBy('slug');

        foreach (SeedData::giftOccasions() as $index => $occasion) {
            GiftCardOccasion::create([
                'slug' => $occasion['slug'],
                'name' => $occasion['name'],
                'headline' => $occasion['headline'],
                'emoji' => $occasion['emoji'],
                'bg_start' => $occasion['bg_start'],
                'bg_mid' => $occasion['bg_mid'],
                'bg_end' => $occasion['bg_end'],
                'text_color' => $occasion['text_color'],
                'gift_card_design_id' => $designsBySlug->get($occasion['design'])?->id,
                'sort_order' => $index,
                'is_active' => true,
            ]);
        }
    }
}
