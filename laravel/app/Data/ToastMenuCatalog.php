<?php

namespace App\Data;

/** Menu names and prices mirrored from Toast online ordering. */
class ToastMenuCatalog
{
    public static function menu(): array
    {
        return [
            'categories' => self::categories(),
            'items' => self::items(),
        ];
    }

    private static function categories(): array
    {
        return [
            ['id' => 'appetizers', 'name' => 'Appetizers', 'tag' => 'Starters', 'desc' => 'Pakora, samosa, chili, and Nepali street snacks'],
            ['id' => 'momo', 'name' => 'Momo (Dumplings)', 'tag' => 'Nepali favorites', 'desc' => 'Steamed, fried, soup, and masala momo'],
            ['id' => 'chowmein-thukpa', 'name' => 'Chowmein & Thukpa', 'tag' => 'Noodles', 'desc' => 'Stir-fried noodles and Himalayan soup'],
            ['id' => 'vegetarian-entrees', 'name' => 'Vegetarian Entrees', 'tag' => 'Veg curries', 'desc' => 'Vegetarian curries served with rice'],
            ['id' => 'nonveg-entrees', 'name' => 'Non Veg Entrees', 'tag' => 'Curries', 'desc' => 'Meat curries served with rice'],
            ['id' => 'biryani-rice', 'name' => 'Biryani and Rice', 'tag' => 'Dum rice', 'desc' => 'Aromatic biryani and fried rice'],
            ['id' => 'breads', 'name' => 'Naan / Breads', 'tag' => 'Tandoor baked', 'desc' => 'Naan and Indian breads'],
            ['id' => 'desserts', 'name' => 'Desserts', 'tag' => 'Sweet finish', 'desc' => 'Classic Indian sweets'],
            ['id' => 'sides', 'name' => 'Sides', 'tag' => 'Extras', 'desc' => 'Chutneys, raita, and sauces'],
            ['id' => 'drinks', 'name' => 'Drinks', 'tag' => 'Beverages', 'desc' => 'Lassi, chai, and tea'],
            ['id' => 'alcohol', 'name' => 'Alcohol', 'tag' => 'Wine', 'desc' => 'Wine by the glass'],
        ];
    }

    private static function items(): array
    {
        return [
            ['id' => 'vegetable-pakoa', 'cat' => 'appetizers', 'name' => 'Vegetable pakoa', 'price' => 6.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Vegetable pakoa'],
            ['id' => 'paneer-pakora', 'cat' => 'appetizers', 'name' => 'Paneer Pakora', 'price' => 7.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Paneer Pakora'],
            ['id' => 'chicken-pakora', 'cat' => 'appetizers', 'name' => 'Chicken Pakora', 'price' => 9.99, 'veg' => false, 'spice' => 1, 'desc' => '', 'img' => 'Chicken Pakora', 'popular' => true],
            ['id' => 'vegetable-samosa', 'cat' => 'appetizers', 'name' => 'Vegetable samosa', 'price' => 5.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Vegetable samosa'],
            ['id' => 'paneer-samosa', 'cat' => 'appetizers', 'name' => 'Paneer Samosa', 'price' => 6.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Paneer Samosa'],
            ['id' => 'chicken-65', 'cat' => 'appetizers', 'name' => 'Chicken 65', 'price' => 15.99, 'veg' => false, 'spice' => 1, 'desc' => '', 'img' => 'Chicken 65'],
            ['id' => 'chicken-chili', 'cat' => 'appetizers', 'name' => 'Chicken Chili', 'price' => 10.99, 'veg' => false, 'spice' => 2, 'desc' => '', 'img' => 'Chicken Chili', 'popular' => true],
            ['id' => 'paneer-chili', 'cat' => 'appetizers', 'name' => 'Paneer Chili', 'price' => 8.99, 'veg' => true, 'spice' => 2, 'desc' => '', 'img' => 'Paneer Chili'],
            ['id' => 'chholey-samosa', 'cat' => 'appetizers', 'name' => 'Chholey samosa', 'price' => 8.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Chholey samosa'],
            ['id' => 'chatpate', 'cat' => 'appetizers', 'name' => 'Chatpate', 'price' => 8.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Chatpate'],
            ['id' => 'papadum', 'cat' => 'appetizers', 'name' => 'Papadum', 'price' => 1.99, 'veg' => true, 'spice' => 0, 'desc' => '', 'img' => 'Papadum'],
            ['id' => 'steamed-momo', 'cat' => 'momo', 'name' => 'Steamed MoMo', 'price' => 12.99, 'veg' => false, 'spice' => 1, 'desc' => '', 'img' => 'Steamed MoMo', 'popular' => true],
            ['id' => 'fried-momo', 'cat' => 'momo', 'name' => 'Fried MoMo', 'price' => 12.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Fried MoMo'],
            ['id' => 'jhol-soup-momo', 'cat' => 'momo', 'name' => 'Jhol (soup) MoMo', 'price' => 14.99, 'veg' => false, 'spice' => 1, 'desc' => '', 'img' => 'Jhol (soup) MoMo'],
            ['id' => 'chili-momo', 'cat' => 'momo', 'name' => 'Chili MoMo', 'price' => 14.99, 'veg' => true, 'spice' => 2, 'desc' => '', 'img' => 'Chili MoMo'],
            ['id' => 'butter-masala-momo', 'cat' => 'momo', 'name' => 'Butter Masala MoMo', 'price' => 19.99, 'veg' => false, 'spice' => 1, 'desc' => '', 'img' => 'Butter Masala MoMo'],
            ['id' => 'tikka-masala-momo', 'cat' => 'momo', 'name' => 'Tikka Masala MoMo', 'price' => 19.99, 'veg' => false, 'spice' => 1, 'desc' => '', 'img' => 'Tikka Masala MoMo'],
            ['id' => 'chicken-chowmein', 'cat' => 'chowmein-thukpa', 'name' => 'Chicken Chowmein', 'price' => 15.99, 'veg' => false, 'spice' => 1, 'desc' => '', 'img' => 'Chicken Chowmein'],
            ['id' => 'vegetable-chowmein', 'cat' => 'chowmein-thukpa', 'name' => 'Vegetable Chowmein', 'price' => 14.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Vegetable Chowmein'],
            ['id' => 'egg-chowmein', 'cat' => 'chowmein-thukpa', 'name' => 'Egg Chowmein', 'price' => 15.99, 'veg' => false, 'spice' => 1, 'desc' => '', 'img' => 'Egg Chowmein'],
            ['id' => 'paneer-chowmein', 'cat' => 'chowmein-thukpa', 'name' => 'Paneer Chowmein', 'price' => 15.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Paneer Chowmein'],
            ['id' => 'chicken-thukpa', 'cat' => 'chowmein-thukpa', 'name' => 'Chicken Thukpa', 'price' => 15.99, 'veg' => false, 'spice' => 1, 'desc' => '', 'img' => 'Chicken Thukpa'],
            ['id' => 'vegetable-thukpa', 'cat' => 'chowmein-thukpa', 'name' => 'Vegetable Thukpa', 'price' => 14.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Vegetable Thukpa'],
            ['id' => 'paneer-thukpa', 'cat' => 'chowmein-thukpa', 'name' => 'Paneer Thukpa', 'price' => 15.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Paneer Thukpa'],
            ['id' => 'namaste-curry-vegetarian', 'cat' => 'vegetarian-entrees', 'name' => 'Namaste Curry (Vegetarian)', 'price' => 14.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Namaste Curry (Vegetarian)'],
            ['id' => 'butter-curry', 'cat' => 'vegetarian-entrees', 'name' => 'Butter Curry', 'price' => 14.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Butter Curry'],
            ['id' => 'tikka-masala', 'cat' => 'vegetarian-entrees', 'name' => 'Tikka Masala', 'price' => 14.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Tikka Masala'],
            ['id' => 'saag', 'cat' => 'vegetarian-entrees', 'name' => 'saag', 'price' => 14.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'saag'],
            ['id' => 'vindaloo', 'cat' => 'vegetarian-entrees', 'name' => 'Vindaloo', 'price' => 14.99, 'veg' => true, 'spice' => 2, 'desc' => '', 'img' => 'Vindaloo'],
            ['id' => 'mango-curry', 'cat' => 'vegetarian-entrees', 'name' => 'Mango Curry', 'price' => 14.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Mango Curry'],
            ['id' => 'coconut-curry', 'cat' => 'vegetarian-entrees', 'name' => 'Coconut Curry', 'price' => 14.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Coconut Curry'],
            ['id' => 'korma', 'cat' => 'vegetarian-entrees', 'name' => 'Korma', 'price' => 14.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Korma'],
            ['id' => 'dal-makhani', 'cat' => 'vegetarian-entrees', 'name' => 'Dal Makhani', 'price' => 14.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Dal Makhani'],
            ['id' => 'dal-tadka', 'cat' => 'vegetarian-entrees', 'name' => 'Dal Tadka', 'price' => 14.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Dal Tadka'],
            ['id' => 'matar-paneer', 'cat' => 'vegetarian-entrees', 'name' => 'Matar paneer', 'price' => 15.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Matar paneer', 'popular' => true],
            ['id' => 'aloo-gobi', 'cat' => 'vegetarian-entrees', 'name' => 'Aloo Gobi', 'price' => 14.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Aloo Gobi'],
            ['id' => 'chana-masala', 'cat' => 'vegetarian-entrees', 'name' => 'Chana Masala', 'price' => 14.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Chana Masala'],
            ['id' => 'bhindi-okra', 'cat' => 'vegetarian-entrees', 'name' => 'Bhindi (Okra)', 'price' => 14.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Bhindi (Okra)'],
            ['id' => 'namaste-curry', 'cat' => 'nonveg-entrees', 'name' => 'Namaste Curry', 'price' => 16.99, 'veg' => false, 'spice' => 1, 'desc' => '', 'img' => 'Namaste Curry'],
            ['id' => 'butter-curry-meat', 'cat' => 'nonveg-entrees', 'name' => 'Butter Curry', 'price' => 16.99, 'veg' => false, 'spice' => 1, 'desc' => '', 'img' => 'Butter Curry'],
            ['id' => 'tikka-masala-meat', 'cat' => 'nonveg-entrees', 'name' => 'Tikka Masala', 'price' => 16.99, 'veg' => false, 'spice' => 1, 'desc' => '', 'img' => 'Tikka Masala'],
            ['id' => 'korma-meat', 'cat' => 'nonveg-entrees', 'name' => 'Korma', 'price' => 16.99, 'veg' => false, 'spice' => 1, 'desc' => '', 'img' => 'Korma'],
            ['id' => 'mango-curry-meat', 'cat' => 'nonveg-entrees', 'name' => 'Mango Curry', 'price' => 16.99, 'veg' => false, 'spice' => 1, 'desc' => '', 'img' => 'Mango Curry'],
            ['id' => 'coconut-curry-meat', 'cat' => 'nonveg-entrees', 'name' => 'Coconut Curry', 'price' => 16.99, 'veg' => false, 'spice' => 1, 'desc' => '', 'img' => 'Coconut Curry'],
            ['id' => 'vindaloo-meat', 'cat' => 'nonveg-entrees', 'name' => 'Vindaloo', 'price' => 16.99, 'veg' => false, 'spice' => 2, 'desc' => '', 'img' => 'Vindaloo'],
            ['id' => 'saag-meat', 'cat' => 'nonveg-entrees', 'name' => 'Saag', 'price' => 16.99, 'veg' => false, 'spice' => 1, 'desc' => '', 'img' => 'Saag'],
            ['id' => 'vegetable-biryani', 'cat' => 'biryani-rice', 'name' => 'Vegetable Biryani', 'price' => 16.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Vegetable Biryani'],
            ['id' => 'chicken-biryani', 'cat' => 'biryani-rice', 'name' => 'Chicken Biryani', 'price' => 18.99, 'veg' => false, 'spice' => 1, 'desc' => '', 'img' => 'Chicken Biryani'],
            ['id' => 'paneer-biryani', 'cat' => 'biryani-rice', 'name' => 'Paneer Biryani', 'price' => 17.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Paneer Biryani'],
            ['id' => 'lamb-biryani', 'cat' => 'biryani-rice', 'name' => 'Lamb Biryani', 'price' => 20.99, 'veg' => false, 'spice' => 1, 'desc' => '', 'img' => 'Lamb Biryani'],
            ['id' => 'goat-biryani', 'cat' => 'biryani-rice', 'name' => 'Goat Biryani', 'price' => 20.99, 'veg' => false, 'spice' => 1, 'desc' => '', 'img' => 'Goat Biryani'],
            ['id' => 'vegetable-fried-rice', 'cat' => 'biryani-rice', 'name' => 'Vegetable Fried Rice', 'price' => 11.99, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Vegetable Fried Rice'],
            ['id' => 'chicken-fried-rice', 'cat' => 'biryani-rice', 'name' => 'Chicken fried rice', 'price' => 12.99, 'veg' => false, 'spice' => 1, 'desc' => '', 'img' => 'Chicken fried rice'],
            ['id' => 'egg-fried-rice', 'cat' => 'biryani-rice', 'name' => 'Egg fried rice', 'price' => 12.99, 'veg' => false, 'spice' => 1, 'desc' => '', 'img' => 'Egg fried rice'],
            ['id' => 'small-rice', 'cat' => 'biryani-rice', 'name' => 'Small rice', 'price' => 2.99, 'veg' => true, 'spice' => 0, 'desc' => '', 'img' => 'Small rice'],
            ['id' => 'large-rice', 'cat' => 'biryani-rice', 'name' => 'Large rice', 'price' => 4.99, 'veg' => true, 'spice' => 0, 'desc' => '', 'img' => 'Large rice'],
            ['id' => 'plain-butter-naan', 'cat' => 'breads', 'name' => 'Plain butter Naan', 'price' => 3.25, 'veg' => true, 'spice' => 0, 'desc' => '', 'img' => 'Naan', 'popular' => true],
            ['id' => 'garlic-naan', 'cat' => 'breads', 'name' => 'Garlic Naan', 'price' => 3.99, 'veg' => true, 'spice' => 0, 'desc' => '', 'img' => 'Garlic Naan'],
            ['id' => 'garlic-basil-naan', 'cat' => 'breads', 'name' => 'Garlic Basil Naan', 'price' => 4.99, 'veg' => true, 'spice' => 0, 'desc' => '', 'img' => 'Garlic Basil Naan'],
            ['id' => 'potato-naan', 'cat' => 'breads', 'name' => 'Potato naan', 'price' => 5.25, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Potato naan'],
            ['id' => 'paneer-naan', 'cat' => 'breads', 'name' => 'Paneer Naan', 'price' => 5.5, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Paneer Naan'],
            ['id' => 'cheese-naan', 'cat' => 'breads', 'name' => 'Cheese Naan', 'price' => 5.5, 'veg' => true, 'spice' => 1, 'desc' => '', 'img' => 'Cheese Naan'],
            ['id' => 'roti', 'cat' => 'breads', 'name' => 'Roti', 'price' => 2.99, 'veg' => true, 'spice' => 0, 'desc' => '', 'img' => 'Roti'],
            ['id' => 'rice-pudding', 'cat' => 'desserts', 'name' => 'Rice pudding', 'price' => 4.99, 'veg' => true, 'spice' => 0, 'desc' => '', 'img' => 'Rice pudding'],
            ['id' => 'gulab-jamun', 'cat' => 'desserts', 'name' => 'Gulab jamun', 'price' => 4.99, 'veg' => true, 'spice' => 0, 'desc' => '', 'img' => 'Gulab jamun'],
            ['id' => 'rasmalai', 'cat' => 'desserts', 'name' => 'Rasmalai', 'price' => 4.99, 'veg' => true, 'spice' => 0, 'desc' => '', 'img' => 'Rasmalai'],
            ['id' => 'mint-chutney', 'cat' => 'sides', 'name' => 'Mint Chutney', 'price' => 1.0, 'veg' => true, 'spice' => 0, 'desc' => '', 'img' => 'Mint Chutney'],
            ['id' => 'tamarind-chutney', 'cat' => 'sides', 'name' => 'Tamarind Chutney', 'price' => 1.0, 'veg' => true, 'spice' => 0, 'desc' => '', 'img' => 'Tamarind Chutney'],
            ['id' => 'momo-sauce', 'cat' => 'sides', 'name' => 'MoMo Sauce', 'price' => 1.99, 'veg' => true, 'spice' => 0, 'desc' => '', 'img' => 'MoMo Sauce'],
            ['id' => 'raita', 'cat' => 'sides', 'name' => 'Raita', 'price' => 2.99, 'veg' => true, 'spice' => 0, 'desc' => '', 'img' => 'Raita'],
            ['id' => 'chai-milk-tea', 'cat' => 'drinks', 'name' => 'Chai (Milk Tea)', 'price' => 3.0, 'veg' => true, 'spice' => 0, 'desc' => '', 'img' => 'Chai (Milk Tea)'],
            ['id' => 'black-tea', 'cat' => 'drinks', 'name' => 'Black Tea', 'price' => 2.5, 'veg' => true, 'spice' => 0, 'desc' => '', 'img' => 'Black Tea'],
            ['id' => 'iced-chai', 'cat' => 'drinks', 'name' => 'Iced Chai', 'price' => 3.0, 'veg' => true, 'spice' => 0, 'desc' => '', 'img' => 'Iced Chai'],
            ['id' => 'iced-tea', 'cat' => 'drinks', 'name' => 'Iced Tea', 'price' => 2.5, 'veg' => true, 'spice' => 0, 'desc' => '', 'img' => 'Iced Tea'],
            ['id' => 'mango-lassi', 'cat' => 'drinks', 'name' => 'Mango lassi', 'price' => 4.99, 'veg' => true, 'spice' => 0, 'desc' => '', 'img' => 'Mango lassi'],
            ['id' => 'plain-sweet-lassi', 'cat' => 'drinks', 'name' => 'Plain sweet Lassi', 'price' => 4.5, 'veg' => true, 'spice' => 0, 'desc' => '', 'img' => 'Plain sweet Lassi'],
            ['id' => 'plain-salty-lassi', 'cat' => 'drinks', 'name' => 'Plain Salty lassi', 'price' => 4.5, 'veg' => true, 'spice' => 0, 'desc' => '', 'img' => 'Plain Salty lassi'],
            ['id' => 'chardonnay', 'cat' => 'alcohol', 'name' => 'Chardonnay', 'price' => 6.0, 'veg' => false, 'spice' => 1, 'desc' => '', 'img' => 'Chardonnay'],
        ];
    }
}

