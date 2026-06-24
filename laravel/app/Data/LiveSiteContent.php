<?php

namespace App\Data;

/**
 * Default site content for Namaste MoMo & curry house.
 * Menu structure and items sourced from the restaurant's online ordering catalog.
 */
class LiveSiteContent
{
    public static function settings(): array
    {
        return [
            'restaurant_name' => 'Namaste MoMo & curry house',
            'address' => '6211 Evergreen Way',
            'city' => 'Everett, WA 98203',
            'phone' => '(253) 420-5566',
            'email' => 'Namastemomo6211@gmail.com',
            'hours' => 'Tue–Sun · 11:00 AM – 9:00 PM',
            'closed_days' => 'Closed Mondays',
            'tax_rate' => '0.1025',
            'delivery_fee' => '6.98',
            'free_delivery_min' => '999',
            'footer_tagline' => 'Hand-folded momo, tandoor favorites, and homestyle curries at Namaste MoMo & curry house — 6211 Evergreen Way, Everett.',
            'online_ordering_enabled' => 'true',
            'delivery_enabled' => 'true',
            'tips_enabled' => 'true',
            'sms_alerts_enabled' => 'true',
            'toast_location' => '6211 Evergreen Way · Everett',
            'toast_connected' => 'true',
            'instagram_url' => 'https://www.instagram.com/indiannepalikitchen',
            'facebook_url' => 'https://www.facebook.com/indiannepalikitchen',
            'whatsapp_url' => 'https://wa.me/12534205566',
            'map_embed_url' => 'https://maps.google.com/maps?q=6211+Evergreen+Way,+Everett,+WA+98203&hl=en&z=16&output=embed',
        ];
    }

    public static function contentBlocks(): array
    {
        return [
            'Hero headline' => 'A full menu built around momo — and everything worth pairing with it.',
            'Hero subtext' => 'Everett\'s home for hand-folded momo, homestyle curry, and tandoor-roasted favorites. Dine in at 6211 Evergreen Way, pick up on your way home, or order delivery — open Tuesday through Sunday, 11 AM to 9 PM.',
            'Footer tagline' => 'Hand-folded momo, tandoor favorites, and homestyle curries at Namaste MoMo & curry house — 6211 Evergreen Way, Everett.',
            'Hours banner' => 'Tue–Sun · 11:00 AM – 9:00 PM · Closed Mondays',
            'About story' => 'About us',
            'Home story title' => 'Where every basket starts by hand.',
            'Home story text' => 'Namaste MoMo & curry house opened on Evergreen Way with one goal: serve momo the way families make them at home — fresh fillings, soft wrappers, and sauces worth dipping into again and again. From combo platters to slow-simmered curries and naan from the clay oven, this is comfort food made with real care.',
            'Home momo title' => 'The momo menu',
            'Home momo text' => 'Steamed, fried, jhol, sandheko, chili, butter masala, and tandoori — plus our four-style Combo Momo Feast.',
            'Home tandoori title' => 'Crispy golden samosa',
            'Home curry title' => 'Homestyle curries & plates',
            'Home signatures title' => 'Dishes our guests order first',
            'Home delivery title' => 'Pickup & delivery',
            'Home reserve title' => 'Come see us on Evergreen Way',
            'Home reserve text' => 'Walk in or reserve a table in our Everett dining room — cozy booths, friendly service, and momo steaming from the kitchen.',
            'Home catering title' => 'Feed your group',
            'Home gallery eyebrow' => 'Take a look inside',
            'Home gallery title' => 'The food, the flavors & our dining room',
            'Home reviews eyebrow' => 'Kind words',
            'Home reviews title' => 'What Everett is saying',
            'Home footer headline' => 'Hungry for momo? We\'re on Evergreen Way.',
            'Delivery blurb' => 'Order online for pickup or delivery from 6211 Evergreen Way, Everett. Most orders are ready in 30–60 minutes. Closed Mondays.',
            'Catering blurb' => 'Office lunches, birthday parties, and family gatherings — we cater groups of 20 or more with momo trays, curry spreads, biryani, and fresh naan.',
        ];
    }

    public static function about(): array
    {
        return [
            'story' => [
                'Namaste means welcome — and that\'s exactly how we want you to feel when you walk through our door at 6211 Evergreen Way in Everett.',
                'Our kitchen is built around momo: steamed, fried, jhol, sandheko, and chili styles, plus combo platters when you want to try them all. Every basket is hand-folded and cooked to order — never pulled from a warmer.',
                'Beyond momo, you\'ll find tandoori from our clay oven, homestyle curries with rice, biryanis, Nepali classics, vegetarian plates, and fresh naan. Dine in, pick up, or order delivery — we make it fresh when you ask for it.',
            ],
            'values' => [
                ['icon' => 'flame', 'title' => 'Cooked when you order', 'text' => 'No steam tables. Your momo and curry are made fresh, fired to order, and served hot.'],
                ['icon' => 'leaf', 'title' => 'Something for everyone', 'text' => 'Vegetarian, vegan-friendly, and meat dishes across momo, curry, tandoori, biryani, and sides.'],
                ['icon' => 'users', 'title' => 'A neighborhood table', 'text' => 'Families, coworkers, date nights, and regulars — everyone has a seat at our Everett dining room.'],
            ],
            'stats' => [
                ['11–9', 'open Tue–Sun'],
                ['6211', 'Evergreen Way'],
                ['Mon', 'closed'],
            ],
            'team' => [
                ['name' => 'Kitchen team', 'role' => 'Momo, curry & tandoor', 'tag' => 'Kitchen'],
                ['name' => 'Front of house', 'role' => 'Welcome & service', 'tag' => 'Team'],
            ],
        ];
    }

    public static function reviews(): array
    {
        return [
            ['name' => 'Priya M.', 'stars' => 5, 'text' => 'We stop in after work when we do not feel like cooking. Butter curry with garlic naan is always good, and the chicken biryani portions are generous.', 'tag' => 'Google'],
            ['name' => 'James T.', 'stars' => 4, 'text' => 'Solid lunch spot on Evergreen Way. Chicken pakora was crispy, matar paneer had nice spice, and the staff was friendly even when it was busy.', 'tag' => 'Yelp'],
            ['name' => 'Linda K.', 'stars' => 5, 'text' => 'Brought my parents here for the first time and they loved it. Dal makhani with plain naan was the highlight. Already planning our next visit.', 'tag' => 'Google'],
            ['name' => 'Chris W.', 'stars' => 5, 'text' => 'Ordered pickup twice last week. Food was still hot when we got home, and the steamed momo were fresh. Easy ordering through Toast.', 'tag' => 'Pickup'],
            ['name' => 'Angela P.', 'stars' => 4, 'text' => 'Cozy dining room and fair prices. Tikka masala and garlic basil naan were excellent. Good option for a relaxed family dinner.', 'tag' => 'Regular guest'],
            ['name' => 'Kevin N.', 'stars' => 5, 'text' => 'Catered lunch for our office — chicken biryani and tray sides fed everyone with plenty left over. Team was easy to work with.', 'tag' => 'Catering'],
        ];
    }

    public static function promos(): array
    {
        return [
            [
                'id' => 'free-delivery-40',
                'badge' => 'Spend & save',
                'title' => 'Free delivery on orders $40+',
                'detail' => 'Order $40 or more for delivery and the delivery fee is on us — perfect for family dinners.',
                'price' => '$40 min',
                'accent' => 'gold',
                'offer_type' => 'spend_save',
                'cta_type' => 'menu',
                'cta_label' => 'Start your order',
                'terms' => 'Applies to delivery orders only. Before tax and tip.',
                'min_order_amount' => 40,
            ],
            [
                'id' => 'momo-combo',
                'badge' => 'Combo deal',
                'title' => 'Combo Momo Feast',
                'detail' => 'Steamed, fried, sandheko, and chili momo in one order — four styles, one great price.',
                'price' => '$14.99',
                'accent' => 'spice',
                'offer_type' => 'combo_meal',
                'cta_type' => 'order_item',
                'cta_label' => 'Order this combo',
                'menu_item_slug' => 'combo-momo',
                'terms' => 'Valid for pickup and delivery. Cannot be combined with other offers.',
            ],
            [
                'id' => 'party-welcome-drink',
                'badge' => 'Dine-in perk',
                'title' => 'Party of 6 — welcome drink on us',
                'detail' => 'Reserve a table for six or more and each guest receives a complimentary welcome drink.',
                'price' => '6+ guests',
                'accent' => 'leaf',
                'offer_type' => 'reservation_perk',
                'cta_type' => 'reserve',
                'cta_label' => 'Reserve for 6+',
                'terms' => 'Dine-in only. Mention this offer when seated. Non-alcoholic welcome drink per guest.',
                'min_party_size' => 6,
            ],
        ];
    }

    public static function galleryCategories(): array
    {
        return [
            ['id' => 'food', 'name' => 'The Food', 'items' => [
                'Jhol (soup) Momo', 'Combo Momo', 'Tandoori Chicken Momos', 'Butter Masala Momo',
                'Chicken Chili', 'Vegetable Pakora', 'Samosa Chaat', 'Butter Curry with lamb',
                'House Curry', 'Aloo Gobi', 'Garlic Basil Naan', 'Biryani Lamb',
                'Gulab Jamun', 'Daal Soup',
            ]],
            ['id' => 'space', 'name' => 'The Restaurant', 'items' => [
                'Dining room on Evergreen Way', 'Counter service', 'Tandoor clay oven',
                'Cozy black and red interior', 'Family-friendly seating',
            ]],
            ['id' => 'events', 'name' => 'Catering & Events', 'items' => [
                'Catering spread', 'Live momo station', 'Family-size trays',
                'Office lunch setup', 'Celebration feast',
            ]],
        ];
    }

    public static function menu(): array
    {
        return ToastMenuCatalog::menu();
    }
}
