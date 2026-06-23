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
            'Home tandoori title' => 'Roasted in the tandoor',
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
            ['name' => 'Rachel H.', 'stars' => 5, 'text' => 'The jhol momo is incredible — rich broth, perfect dumplings. This is our new go-to on Evergreen Way.', 'tag' => 'Google'],
            ['name' => 'Marcus L.', 'stars' => 5, 'text' => 'Combo momo platter is the move. Four styles, one order, zero regrets. Portions are generous and everything arrives hot.', 'tag' => 'Yelp'],
            ['name' => 'Deepa S.', 'stars' => 5, 'text' => 'Finally a proper momo spot in Everett. Garlic naan and butter curry are outstanding. Staff is warm and welcoming.', 'tag' => 'Google'],
            ['name' => 'Chris W.', 'stars' => 5, 'text' => 'Ordered delivery twice this week. Food shows up on time, still steaming. The chili momo has the right kick.', 'tag' => 'DoorDash'],
            ['name' => 'Angela P.', 'stars' => 5, 'text' => 'Cozy dining room, fair prices, and the tandoori momo is something special. Great for family dinners.', 'tag' => 'Regular guest'],
            ['name' => 'Kevin N.', 'stars' => 5, 'text' => 'Catered our team lunch — momo trays and biryani were gone in minutes. Easy to work with and delicious.', 'tag' => 'Catering'],
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
        return [
            'categories' => [
                ['id' => 'appetizer', 'name' => 'Appetizer', 'tag' => 'Starters', 'desc' => 'Samosa, pakora, chili, and Nepali street snacks'],
                ['id' => 'momo', 'name' => 'Momo · Chow Mein · Thukpa', 'tag' => 'Nepali favorites', 'desc' => 'Handmade dumplings, noodles, and Himalayan soup'],
                ['id' => 'entrees', 'name' => 'Entrees', 'tag' => 'Curries', 'desc' => 'Served with rice — house, butter, tikka masala, and more'],
                ['id' => 'nepali-special', 'name' => 'Nepali Special Menu', 'tag' => 'From the hills', 'desc' => 'Gundruk, sekuwa, and traditional Nepali plates'],
                ['id' => 'vegetarian', 'name' => 'Vegetarian Specialties', 'tag' => 'Veg & vegan', 'desc' => 'Paneer, dal, saag, and vegetable curries — served with rice'],
                ['id' => 'tandoori', 'name' => 'Tandoori', 'tag' => 'Clay oven', 'desc' => 'Marinated and roasted in our tandoori oven — served with rice'],
                ['id' => 'salad', 'name' => 'Salad', 'tag' => 'Fresh', 'desc' => 'Green, Caesar, and coleslaw salads'],
                ['id' => 'soup', 'name' => 'Soup', 'tag' => 'Warm bowls', 'desc' => 'Daal, chicken, and mixed bean soups'],
                ['id' => 'breads', 'name' => 'Breads', 'tag' => 'Tandoor baked', 'desc' => 'Naan and Indian breads'],
                ['id' => 'desserts', 'name' => 'Desserts', 'tag' => 'Sweet finish', 'desc' => 'Classic Indian sweets and kulfi'],
                ['id' => 'sides', 'name' => 'Sides', 'tag' => 'Extras', 'desc' => 'Raita, chutneys, and sauces'],
                ['id' => 'biryani', 'name' => 'Biryani', 'tag' => 'Dum rice', 'desc' => 'Aromatic basmati biryani'],
                ['id' => 'rice', 'name' => 'Rice', 'tag' => 'Basmati', 'desc' => 'Fried rice and plain basmati'],
                ['id' => 'drinks', 'name' => 'Drinks', 'tag' => 'Beverages', 'desc' => 'Lassi, chai, juice, and soft drinks'],
            ],
            'items' => [
                // Appetizer
                ['id' => 'veg-samosa', 'cat' => 'appetizer', 'name' => 'Vegetable Samosa (2 pcs)', 'price' => 6.95, 'veg' => true, 'spice' => 1, 'popular' => true, 'desc' => 'Deep fried pastries filled with mildly spiced potatoes and peas.', 'img' => 'Vegetable Samosa'],
                ['id' => 'chicken-samosa', 'cat' => 'appetizer', 'name' => 'Chicken Samosa (2 pcs)', 'price' => 6.99, 'veg' => false, 'spice' => 1, 'desc' => 'Deep fried pastries filled with spiced chicken.', 'img' => 'Chicken Samosa'],
                ['id' => 'lamb-samosa', 'cat' => 'appetizer', 'name' => 'Lamb Samosa (2 pcs)', 'price' => 7.95, 'veg' => false, 'spice' => 2, 'desc' => 'Deep fried pastries stuffed with ground lamb and Indian spices.', 'img' => 'Lamb Samosa'],
                ['id' => 'samosa-chaat', 'cat' => 'appetizer', 'name' => 'Samosa Chaat', 'price' => 7.95, 'veg' => true, 'spice' => 1, 'desc' => 'Vegetable samosa with mint & tamarind sauce, yogurt and garbanzo beans.', 'img' => 'Samosa Chaat'],
                ['id' => 'veg-pakora', 'cat' => 'appetizer', 'name' => 'Vegetable Pakora (8 pcs)', 'price' => 6.50, 'veg' => true, 'spice' => 1, 'desc' => 'Mixed vegetables deep-fried in gram flour batter.', 'img' => 'Vegetable Pakora'],
                ['id' => 'paneer-pakora', 'cat' => 'appetizer', 'name' => 'Paneer Pakora (7 pcs)', 'price' => 7.50, 'veg' => true, 'spice' => 1, 'desc' => 'Homemade cheese deep-fried in gram flour batter.', 'img' => 'Paneer Pakora'],
                ['id' => 'chicken-pakora', 'cat' => 'appetizer', 'name' => 'Chicken Pakora (8 pcs)', 'price' => 9.99, 'veg' => false, 'spice' => 1, 'popular' => true, 'desc' => 'Diced chicken deep-fried in gram flour batter.', 'img' => 'Chicken Pakora'],
                ['id' => 'chicken-chili', 'cat' => 'appetizer', 'name' => 'Chicken Chili (8 pcs)', 'price' => 10.99, 'veg' => false, 'spice' => 2, 'popular' => true, 'desc' => 'Chicken sautéed with bell pepper, onion, and tomato sauce.', 'img' => 'Chicken Chili'],
                ['id' => 'gobi-manchurian', 'cat' => 'appetizer', 'name' => 'Gobi Manchurian', 'price' => 7.50, 'veg' => true, 'spice' => 2, 'desc' => 'Cauliflower seasoned with garlic and a blend of spices.', 'img' => 'Gobi Manchurian'],
                ['id' => 'chatpate', 'cat' => 'appetizer', 'name' => 'Chatpate', 'price' => 7.99, 'veg' => true, 'spice' => 2, 'popular' => true, 'desc' => 'Popular Nepali snack with puffed rice, sev, peanuts, and chopped vegetables.', 'img' => 'Chatpate'],
                ['id' => 'papadam', 'cat' => 'appetizer', 'name' => 'Papadam (2 pcs)', 'price' => 1.99, 'veg' => true, 'spice' => 0, 'desc' => 'Crispy gram flour wafers with mint and tamarind chutneys.', 'img' => 'Papadam'],
                // Momo
                ['id' => 'momo-10', 'cat' => 'momo', 'name' => 'Momo (10 pcs)', 'price' => 11.99, 'veg' => false, 'spice' => 1, 'popular' => true, 'desc' => 'Steamed dumplings with vegetables and ground chicken, ginger, garlic, cilantro, and spices.', 'img' => 'Chicken Momo'],
                ['id' => 'combo-momo', 'cat' => 'momo', 'name' => 'Combo Momo (12 pcs)', 'price' => 14.99, 'veg' => false, 'spice' => 2, 'desc' => 'Steamed, fried, sandheko, and chili momo — four styles in one order.', 'img' => 'Combo Momo'],
                ['id' => 'jhol-momo', 'cat' => 'momo', 'name' => 'Jhol (Soup) Momo', 'price' => 13.99, 'veg' => false, 'spice' => 2, 'desc' => 'Dumplings served in a flavorful Nepali soup or sauce.', 'img' => 'Jhol Momo'],
                ['id' => 'fried-momo', 'cat' => 'momo', 'name' => 'Fried Momo', 'price' => 13.99, 'veg' => false, 'spice' => 1, 'desc' => 'Momos deep fried until crisp.', 'img' => 'Fried Momo'],
                ['id' => 'sandheko-momo', 'cat' => 'momo', 'name' => 'Sandheko Momo', 'price' => 13.99, 'veg' => false, 'spice' => 2, 'desc' => 'Marinated with Nepali spices and Himalayan herbs.', 'img' => 'Sandheko Momo'],
                ['id' => 'butter-masala-momo', 'cat' => 'momo', 'name' => 'Butter Masala Momo', 'price' => 18.99, 'veg' => false, 'spice' => 2, 'desc' => 'Fried momo in tomato sauce with cream and butter.', 'img' => 'Butter Masala Momo'],
                ['id' => 'tandoori-momo', 'cat' => 'momo', 'name' => 'Tandoori Chicken Momos', 'price' => 19.99, 'veg' => false, 'spice' => 2, 'desc' => 'Yogurt-marinated chicken momos cooked in the tandoor oven.', 'img' => 'Tandoori Chicken Momos'],
                ['id' => 'chilli-momo', 'cat' => 'momo', 'name' => 'Chilli Momo', 'price' => 13.99, 'veg' => false, 'spice' => 3, 'desc' => 'Steamed momo with onion, chili, peppers and tomato sauce.', 'img' => 'Chilli Momo'],
                ['id' => 'kothey-momo', 'cat' => 'momo', 'name' => 'Kothey Momo (regular)', 'price' => 13.99, 'veg' => false, 'spice' => 1, 'desc' => 'Pan fried on the bottom for a crisp base.', 'img' => 'Kothey Momo'],
                ['id' => 'chow-mein', 'cat' => 'momo', 'name' => 'Chow Mein', 'price' => 13.50, 'veg' => false, 'spice' => 1, 'desc' => 'Stir fried noodles with onion, garlic, ginger and Nepali spices.', 'img' => 'Chow Mein'],
                ['id' => 'thukpa', 'cat' => 'momo', 'name' => 'Thukpa', 'price' => 12.99, 'veg' => false, 'spice' => 2, 'desc' => 'Traditional curry soup with vegetables, chickpeas and noodles.', 'img' => 'Thukpa'],
                // Entrees
                ['id' => 'house-curry', 'cat' => 'entrees', 'name' => 'House Curry', 'price' => 17.95, 'veg' => false, 'spice' => 2, 'desc' => 'Fresh onions, tomatoes, garlic and ginger in a special sauce. Served with rice.', 'img' => 'House Curry'],
                ['id' => 'butter-curry', 'cat' => 'entrees', 'name' => 'Butter Curry', 'price' => 17.95, 'veg' => false, 'spice' => 1, 'desc' => 'Tomato sauce with spices, cream and butter. Served with rice.', 'img' => 'Butter Curry'],
                ['id' => 'tikka-masala', 'cat' => 'entrees', 'name' => 'Tikka Masala', 'price' => 17.95, 'veg' => false, 'spice' => 2, 'desc' => 'Tomato and onion sauce with spices and cream. Served with rice.', 'img' => 'Tikka Masala'],
                ['id' => 'karahi', 'cat' => 'entrees', 'name' => 'Karahi', 'price' => 17.95, 'veg' => false, 'spice' => 2, 'desc' => 'Tomatoes, onion, ginger, garlic and fresh pepper. Served with rice.', 'img' => 'Karahi'],
                ['id' => 'mango-curry', 'cat' => 'entrees', 'name' => 'Mango Curry', 'price' => 17.95, 'veg' => false, 'spice' => 1, 'desc' => 'Onion sauce with cream and mango. Served with rice.', 'img' => 'Mango Curry'],
                ['id' => 'korma', 'cat' => 'entrees', 'name' => 'Korma', 'price' => 17.95, 'veg' => false, 'spice' => 1, 'desc' => 'Creamy sauce with cashews and almonds. Served with rice.', 'img' => 'Korma'],
                ['id' => 'vindaloo', 'cat' => 'entrees', 'name' => 'Vindaloo', 'price' => 17.95, 'veg' => false, 'spice' => 3, 'desc' => 'Tangy onion sauce with vinegar, soy and potatoes. Served with rice.', 'img' => 'Vindaloo'],
                ['id' => 'saag-entree', 'cat' => 'entrees', 'name' => 'Saag (Spinach)', 'price' => 17.95, 'veg' => false, 'spice' => 1, 'desc' => 'Fresh spinach in a mildly spiced sauce. Served with rice.', 'img' => 'Saag'],
                // Nepali Special
                ['id' => 'gundruk', 'cat' => 'nepali-special', 'name' => 'Gundruk', 'price' => 14.50, 'veg' => true, 'spice' => 2, 'desc' => 'Potatoes, soybeans and dried spinach with Nepali spices. Served with rice.', 'img' => 'Gundruk'],
                ['id' => 'aloo-bodi-tama', 'cat' => 'nepali-special', 'name' => 'Aloo-Bodi-Tama', 'price' => 14.50, 'veg' => true, 'spice' => 2, 'desc' => 'Potatoes, bamboo shoot and black eye beans — originally Nepali taste.', 'img' => 'Aloo Bodi Tama'],
                ['id' => 'aloo-rayo-saag', 'cat' => 'nepali-special', 'name' => 'Aloo Rayo Ko Saag', 'price' => 14.50, 'veg' => true, 'spice' => 2, 'desc' => 'Potatoes and mustard greens with Nepalese spices.', 'img' => 'Aloo Rayo Ko Saag'],
                ['id' => 'goat-curry-nepali', 'cat' => 'nepali-special', 'name' => 'Goat Curry (Nepali)', 'price' => 19.95, 'veg' => false, 'spice' => 3, 'desc' => 'Nepali-style goat curry with onion, tomato, garlic and ginger.', 'img' => 'Goat Curry'],
                ['id' => 'sekuwa', 'cat' => 'nepali-special', 'name' => 'Sekuwa', 'price' => 17.99, 'veg' => false, 'spice' => 2, 'desc' => 'Marinated meat skewered and barbecued in the clay oven, served with chatpate.', 'img' => 'Sekuwa'],
                // Vegetarian
                ['id' => 'dal-makhani', 'cat' => 'vegetarian', 'name' => 'Dal Makhani', 'price' => 14.50, 'veg' => true, 'spice' => 1, 'desc' => 'Black lentils slow cooked with spices and butter.', 'img' => 'Dal Makhani'],
                ['id' => 'aloo-gobi', 'cat' => 'vegetarian', 'name' => 'Aloo Gobi', 'price' => 14.95, 'veg' => true, 'spice' => 1, 'desc' => 'Cauliflower and potatoes with garlic, onions and tomatoes.', 'img' => 'Aloo Gobi'],
                ['id' => 'chana-masala', 'cat' => 'vegetarian', 'name' => 'Chana Masala', 'price' => 14.50, 'veg' => true, 'spice' => 2, 'desc' => 'Garbanzo beans with onions, tomatoes and spices.', 'img' => 'Chana Masala'],
                ['id' => 'shahi-paneer', 'cat' => 'vegetarian', 'name' => 'Shahi Paneer / Tofu', 'price' => 14.95, 'veg' => true, 'spice' => 1, 'desc' => 'Paneer or tofu in a creamy tomato and onion sauce.', 'img' => 'Shahi Paneer'],
                ['id' => 'malai-kofta', 'cat' => 'vegetarian', 'name' => 'Malai Kofta', 'price' => 14.95, 'veg' => true, 'spice' => 1, 'desc' => 'Vegetable balls in a creamy tomato sauce.', 'img' => 'Malai Kofta'],
                // Tandoori
                ['id' => 'tandoori-chicken', 'cat' => 'tandoori', 'name' => 'Tandoori Chicken', 'price' => 18.50, 'veg' => false, 'spice' => 2, 'desc' => 'Bone-in chicken marinated in yogurt and spices, roasted in the clay oven.', 'img' => 'Tandoori Chicken'],
                ['id' => 'chicken-tikka', 'cat' => 'tandoori', 'name' => 'Chicken Tikka', 'price' => 18.99, 'veg' => false, 'spice' => 2, 'desc' => 'Boneless breast marinated and roasted in the tandoori oven.', 'img' => 'Chicken Tikka'],
                ['id' => 'lamb-boti', 'cat' => 'tandoori', 'name' => 'Lamb Boti', 'price' => 20.99, 'veg' => false, 'spice' => 2, 'desc' => 'Tender lamb marinated in yogurt, ginger and garlic.', 'img' => 'Lamb Boti'],
                ['id' => 'mixed-grill', 'cat' => 'tandoori', 'name' => 'Mixed Grilled', 'price' => 23.95, 'veg' => false, 'spice' => 2, 'desc' => 'Tandoori chicken, shrimp, chicken tikka and lamb boti.', 'img' => 'Mixed Grilled'],
                ['id' => 'paneer-tikka', 'cat' => 'tandoori', 'name' => 'Paneer Tikka', 'price' => 17.99, 'veg' => true, 'spice' => 1, 'desc' => 'Marinated Indian cheese baked in the tandoor clay oven.', 'img' => 'Paneer Tikka'],
                // Salad & Soup
                ['id' => 'green-salad', 'cat' => 'salad', 'name' => 'Fresh Green Salad', 'price' => 7.95, 'veg' => true, 'spice' => 0, 'popular' => true, 'desc' => 'Cucumber, onion, tomato, lettuce, carrots and chickpeas.', 'img' => 'Garden Salad'],
                ['id' => 'daal-soup', 'cat' => 'soup', 'name' => 'Daal Soup', 'price' => 6.50, 'veg' => true, 'spice' => 1, 'desc' => 'Yellow lentils lightly cooked.', 'img' => 'Daal Soup'],
                ['id' => 'chicken-soup', 'cat' => 'soup', 'name' => 'Chicken Soup', 'price' => 7.99, 'veg' => false, 'spice' => 1, 'desc' => 'Mildly spiced lentil soup with chicken and cream.', 'img' => 'Chicken Soup'],
                // Breads
                ['id' => 'naan', 'cat' => 'breads', 'name' => 'Naan', 'price' => 2.95, 'veg' => true, 'spice' => 0, 'desc' => 'Indian style leavened white bread.', 'img' => 'Naan'],
                ['id' => 'garlic-naan', 'cat' => 'breads', 'name' => 'Garlic Naan', 'price' => 3.95, 'veg' => true, 'spice' => 0, 'desc' => 'Naan brushed with garlic — puffy, toasty, and perfect for curry.', 'img' => 'Garlic Naan'],
                // Desserts
                ['id' => 'gulab-jamun', 'cat' => 'desserts', 'name' => 'Gulab Jamun', 'price' => 4.50, 'veg' => true, 'spice' => 0, 'desc' => 'Cheese balls in lightly flavored syrup with pistachios.', 'img' => 'Gulab Jamun'],
                ['id' => 'mango-kulfi', 'cat' => 'desserts', 'name' => 'Mango Kulfi', 'price' => 2.99, 'veg' => true, 'spice' => 0, 'desc' => 'Indian ice cream made with fresh mangoes.', 'img' => 'Mango Kulfi'],
                ['id' => 'rice-pudding', 'cat' => 'desserts', 'name' => 'Rice Pudding', 'price' => 4.50, 'veg' => true, 'spice' => 0, 'desc' => 'Homemade rice pudding with sweet milk and pistachio.', 'img' => 'Rice Pudding'],
                // Sides
                ['id' => 'french-fries', 'cat' => 'sides', 'name' => 'French Fries', 'price' => 4.99, 'veg' => true, 'spice' => 0, 'popular' => true, 'desc' => 'Crispy golden fries served with ketchup.', 'img' => 'French Fries'],
                ['id' => 'raita', 'cat' => 'sides', 'name' => 'Raita', 'price' => 2.50, 'veg' => true, 'spice' => 0, 'desc' => 'Cool homemade yogurt with fresh seasoning.', 'img' => 'Raita'],
                ['id' => 'mint-sauce', 'cat' => 'sides', 'name' => 'Mint Sauce', 'price' => 0.99, 'veg' => true, 'spice' => 0, 'desc' => 'Fresh mint chutney.', 'img' => 'Mint Sauce'],
                // Biryani
                ['id' => 'biryani-chicken', 'cat' => 'biryani', 'name' => 'Biryani Chicken', 'price' => 18.95, 'veg' => false, 'spice' => 2, 'desc' => 'Basmati rice slow cooked with biryani spices, onion and tomato.', 'img' => 'Biryani Chicken'],
                ['id' => 'biryani-lamb', 'cat' => 'biryani', 'name' => 'Biryani Lamb', 'price' => 21.50, 'veg' => false, 'spice' => 2, 'desc' => 'Aromatic basmati with lamb and biryani spices.', 'img' => 'Biryani Lamb'],
                ['id' => 'biryani-veg', 'cat' => 'biryani', 'name' => 'Biryani Vegetable', 'price' => 15.95, 'veg' => true, 'spice' => 1, 'desc' => 'Basmati rice with seasonal vegetables and biryani spices.', 'img' => 'Biryani Vegetable'],
                // Rice & Drinks
                ['id' => 'basmati-rice', 'cat' => 'rice', 'name' => 'Basmati Rice', 'price' => 2.50, 'veg' => true, 'spice' => 0, 'desc' => 'Steamed aromatic basmati rice.', 'img' => 'Basmati Rice'],
                ['id' => 'fried-rice', 'cat' => 'rice', 'name' => 'Fried Rice', 'price' => 9.95, 'veg' => false, 'spice' => 1, 'desc' => 'Basmati sautéed with cashew, almond and soy sauce.', 'img' => 'Fried Rice'],
                ['id' => 'lassi', 'cat' => 'drinks', 'name' => 'Lassi', 'price' => 3.99, 'veg' => true, 'spice' => 0, 'desc' => 'Traditional yogurt drink.', 'img' => 'Lassi'],
                ['id' => 'chai', 'cat' => 'drinks', 'name' => 'Tea', 'price' => 2.99, 'veg' => true, 'spice' => 0, 'desc' => 'Masala chai — the perfect way to finish your meal.', 'img' => 'Chai'],
                ['id' => 'mango-lassi', 'cat' => 'drinks', 'name' => 'Mango Lassi', 'price' => 4.50, 'veg' => true, 'spice' => 0, 'desc' => 'Sweet mango yogurt drink.', 'img' => 'Mango Lassi'],
            ],
        ];
    }
}
