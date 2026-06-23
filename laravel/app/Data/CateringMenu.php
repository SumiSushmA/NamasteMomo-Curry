<?php
namespace App\Data;

/**
 * Catering catalog synced from Square Online (Indian-Nepali Kitchen).
 * Per-person builder: $5/guest base + per-dish add-ons, 20 guest minimum.
 */
class CateringMenu
{
    public const MIN_GUESTS = 20;

    public const PER_PERSON_PRICE = 5.00;

    public static function perPerson(): array
    {
        return [
            'title' => 'Catering Menu (20 people required)',
            'description' => 'Our catering menu offers a variety of delectable dishes to choose from, with a base price of $5.00 per person. A minimum of 20 people is required for all catering orders. If you order for less than 20 people, your order won\'t be fulfilled and your money will be refunded.',
            'price_label' => '$5.00 / person',
            'groups' => [
                [
                    'id' => 'included',
                    'label' => 'Included( Person)',
                    'options' => [
                        ['name' => 'Rice', 'price' => 0.00],
                        ['name' => 'Salad', 'price' => 0.00],
                        ['name' => 'Raita', 'price' => 0.00],
                    ],
                ],
                [
                    'id' => 'appetizers',
                    'label' => 'Appetizers option(Person)',
                    'options' => [
                        ['name' => 'Vegetable pakora', 'price' => 2.25],
                        ['name' => 'Paneer pakora', 'price' => 2.50],
                        ['name' => 'Chicken pakora', 'price' => 2.75],
                        ['name' => 'Fish pakora', 'price' => 4.00],
                        ['name' => 'vegetable samosa', 'price' => 3.10],
                        ['name' => 'Chicken samosa', 'price' => 3.40],
                        ['name' => 'Lamb samosa', 'price' => 3.80],
                        ['name' => 'Paneer chili', 'price' => 2.75],
                        ['name' => 'Mushroom chili', 'price' => 2.75],
                        ['name' => 'Chicken chili', 'price' => 3.00],
                        ['name' => 'Fish chili', 'price' => 4.25],
                        ['name' => 'Gobi Manchurias', 'price' => 2.75],
                        ['name' => 'chicken roast', 'price' => 3.00],
                    ],
                ],
                [
                    'id' => 'momos',
                    'label' => 'MoMo (person)',
                    'options' => [
                        ['name' => 'Chicken MoMo( 3pcs)', 'price' => 3.85],
                        ['name' => 'Vegetable MoMO(3Pcs)', 'price' => 3.55],
                    ],
                ],
                [
                    'id' => 'chowmein',
                    'label' => 'Chowmein( Person)',
                    'options' => [
                        ['name' => 'Chicken Chowmein', 'price' => 3.25],
                        ['name' => 'Paneer showmen', 'price' => 3.25],
                        ['name' => 'Vegetable chowmein', 'price' => 3.00],
                        ['name' => 'Egg showmen', 'price' => 3.25],
                        ['name' => 'Shrimp showmen', 'price' => 4.00],
                    ],
                ],
                [
                    'id' => 'nepali_entrees',
                    'label' => 'Nepali Entrees(Person)',
                    'options' => [
                        ['name' => 'Goat curry', 'price' => 5.25],
                        ['name' => 'Chicken Curry Nepali', 'price' => 4.00],
                        ['name' => 'Chicken Bone in curry', 'price' => 4.00],
                        ['name' => 'Chicken chhoila', 'price' => 4.50],
                        ['name' => 'Chicken sekuwa', 'price' => 4.50],
                        ['name' => 'Lamb Sekuwa', 'price' => 5.50],
                        ['name' => 'Aloo bodi Tama', 'price' => 3.00],
                        ['name' => 'Gundruk', 'price' => 3.00],
                        ['name' => 'Aloo rayo saag', 'price' => 3.00],
                        ['name' => 'Aloo curry(Dum)', 'price' => 3.00],
                        ['name' => 'Aloo simi', 'price' => 3.00],
                    ],
                ],
                [
                    'id' => 'vegetarian_entrees',
                    'label' => 'Vegetarian Entrees(Person)',
                    'options' => [
                        ['name' => 'Vegetables entrees', 'price' => 3.00],
                        ['name' => 'Tofu entrees', 'price' => 3.00],
                        ['name' => 'Paneer entrees', 'price' => 3.50],
                        ['name' => 'Aloo Gobi', 'price' => 3.00],
                        ['name' => 'Chana Masala', 'price' => 3.00],
                        ['name' => 'Aloo Chana', 'price' => 3.00],
                        ['name' => 'Aloo Matar', 'price' => 3.00],
                        ['name' => 'Dal Makhani', 'price' => 3.00],
                        ['name' => 'Dal Tadka', 'price' => 3.00],
                    ],
                ],
                [
                    'id' => 'chicken_entrees',
                    'label' => 'Chicken Entrees (person)',
                    'options' => [
                        ['name' => 'Chicke house curry', 'price' => 4.00],
                        ['name' => 'Butter chicken curry', 'price' => 4.00],
                        ['name' => 'Chicken Tikka Masala', 'price' => 4.00],
                        ['name' => 'Chicken Korma', 'price' => 4.00],
                        ['name' => 'chicken coconut curry', 'price' => 4.00],
                        ['name' => 'Chicken Pineapple curry', 'price' => 4.00],
                        ['name' => 'Chicken Vindaloo', 'price' => 4.00],
                        ['name' => 'Chicken Karahi', 'price' => 4.00],
                        ['name' => 'Chicken Jalfrezi', 'price' => 4.00],
                        ['name' => 'Chicken saag', 'price' => 4.00],
                        ['name' => 'Chicken Mango curry', 'price' => 4.00],
                    ],
                ],
                [
                    'id' => 'lamb_entrees',
                    'label' => 'Lamb entrees(person)',
                    'options' => [
                        ['name' => 'Lamb house curry', 'price' => 5.00],
                        ['name' => 'Lamb Butter curry', 'price' => 5.00],
                        ['name' => 'Lamb Tikka masala', 'price' => 5.00],
                        ['name' => 'Lamb Mango Curry', 'price' => 5.00],
                        ['name' => 'Lamb Pineapple curry', 'price' => 5.00],
                        ['name' => 'Lamb Karahi', 'price' => 5.00],
                        ['name' => 'Lamb Korma', 'price' => 5.00],
                        ['name' => 'Lamb coconut Curry', 'price' => 5.00],
                        ['name' => 'Lamb saag', 'price' => 5.00],
                        ['name' => 'Lamb Vindaloo', 'price' => 5.00],
                        ['name' => 'Lamb Jalfrezi', 'price' => 5.00],
                    ],
                ],
                [
                    'id' => 'shrimp_entrees',
                    'label' => 'Shrimp Entrees(Person)',
                    'options' => [
                        ['name' => 'Shrimp House curry', 'price' => 5.00],
                        ['name' => 'Shrimp Butter curry', 'price' => 5.00],
                        ['name' => 'Shrimp Tikka masala', 'price' => 5.00],
                        ['name' => 'Shrimp Pineapple Curry', 'price' => 5.00],
                        ['name' => 'Shrimp Karahi', 'price' => 5.00],
                    ],
                ],
                [
                    'id' => 'nepali_sides',
                    'label' => 'Nepali sides(person)',
                    'options' => [
                        ['name' => 'Aloo kakro achar', 'price' => 2.00],
                        ['name' => 'Tomato Achar', 'price' => 1.75],
                        ['name' => 'Gundruk sandheko', 'price' => 2.00],
                        ['name' => 'Badam sandheko', 'price' => 2.00],
                        ['name' => 'Chicken Panera', 'price' => 2.00],
                    ],
                ],
                [
                    'id' => 'naan',
                    'label' => 'Naan option(person)',
                    'options' => [
                        ['name' => 'Plain Naan(half)', 'price' => 1.50],
                        ['name' => 'garlic Naan( Half)', 'price' => 1.90],
                        ['name' => 'Garlic Basil Naan (half)', 'price' => 2.40],
                        ['name' => 'Puri 1', 'price' => 1.25],
                        ['name' => 'Roti 1', 'price' => 2.75],
                    ],
                ],
                [
                    'id' => 'drinks',
                    'label' => 'Drinks (Person)',
                    'options' => [
                        ['name' => 'Mango Lassi', 'price' => 3.00],
                        ['name' => 'Strawberry lassi', 'price' => 3.00],
                        ['name' => 'Chai (Milk Tea)', 'price' => 2.00],
                        ['name' => 'Soda', 'price' => 1.50],
                    ],
                ],
                [
                    'id' => 'desserts',
                    'label' => 'Dessert (Person)',
                    'options' => [
                        ['name' => 'Rice Pudding', 'price' => 2.00],
                        ['name' => 'Gulab Jamun', 'price' => 1.80],
                        ['name' => 'Rasmalai', 'price' => 1.80],
                        ['name' => 'Gajar Halwa', 'price' => 2.00],
                        ['name' => 'Ice cream', 'price' => 1.80],
                    ],
                ],
            ],
        ];
    }

    /** @return array<string, array<string, float>> */
    public static function optionPriceMap(): array
    {
        $map = [];
        foreach (self::perPerson()['groups'] as $group) {
            $map[$group['id']] = [];
            foreach ($group['options'] as $option) {
                $map[$group['id']][$option['name']] = (float) $option['price'];
            }
        }

        return $map;
    }

    /** Per-guest unit price: base + sum of selected dish add-ons. */
    public static function perPersonUnitPrice(array $selections): float
    {
        $prices = self::optionPriceMap();
        $addons = 0.0;

        foreach ($selections as $groupId => $items) {
            foreach ($items as $name) {
                $addons += $prices[$groupId][$name] ?? 0.0;
            }
        }

        return round(self::PER_PERSON_PRICE + $addons, 2);
    }

    public static function perPersonTotal(int $guests, array $selections): float
    {
        return round(self::perPersonUnitPrice($selections) * max(self::MIN_GUESTS, $guests), 2);
    }

    public static function isValidOption(string $groupId, string $name): bool
    {
        return isset(self::optionPriceMap()[$groupId][$name]);
    }

    /** @return array<int, array{slug: string, name: string, description: string, price: float, serves: string}> */
    public static function trays(): array
    {
        return [
            [
                'slug' => 'tray-veg-samosas',
                'name' => 'Vegetable Samosas (Tray)',
                'description' => 'Crispy pastry filled with spiced potatoes and peas.',
                'price' => 30.00,
                'serves' => 'Serves 10',
            ],
            [
                'slug' => 'tray-mixed-appetizers',
                'name' => 'Mixed Appetizers (Tray)',
                'description' => 'Assorted pakora, samosa, and papadum.',
                'price' => 45.00,
                'serves' => 'Serves 10',
            ],
            [
                'slug' => 'tray-steamed-momo',
                'name' => 'Steamed Momo (Tray)',
                'description' => 'Hand-pleated dumplings with momo sauce.',
                'price' => 55.00,
                'serves' => 'Serves 10',
            ],
            [
                'slug' => 'tray-combo-momo',
                'name' => 'Combo Momo Feast (Tray)',
                'description' => 'Steamed, fried, sandheko, and chili momo.',
                'price' => 75.00,
                'serves' => 'Serves 10',
            ],
            [
                'slug' => 'tray-butter-chicken',
                'name' => 'Butter Curry — Chicken (Tray)',
                'description' => 'Creamy tomato curry with basmati rice.',
                'price' => 85.00,
                'serves' => 'Serves 8',
            ],
            [
                'slug' => 'tray-tikka-masala',
                'name' => 'Tikka Masala — Chicken (Tray)',
                'description' => 'Char-grilled chicken in spiced masala sauce.',
                'price' => 85.00,
                'serves' => 'Serves 8',
            ],
            [
                'slug' => 'tray-goat-curry',
                'name' => 'Goat Curry (Tray)',
                'description' => 'Slow-braised goat in Nepali spices with rice.',
                'price' => 95.00,
                'serves' => 'Serves 8',
            ],
            [
                'slug' => 'tray-veg-entree',
                'name' => 'Vegetarian Entree Combo (Tray)',
                'description' => 'Dal makhani, aloo gobi, and saag with rice.',
                'price' => 75.00,
                'serves' => 'Serves 8',
            ],
            [
                'slug' => 'tray-chicken-biryani',
                'name' => 'Chicken Biryani (Tray)',
                'description' => 'Fragrant basmati with spiced chicken.',
                'price' => 80.00,
                'serves' => 'Serves 8',
            ],
            [
                'slug' => 'tray-tandoori',
                'name' => 'Tandoori Platter (Tray)',
                'description' => 'Mixed tandoori chicken and seekh kebab.',
                'price' => 90.00,
                'serves' => 'Serves 8',
            ],
            [
                'slug' => 'tray-naan-basket',
                'name' => 'Naan Basket (Tray)',
                'description' => 'Garlic naan, plain naan, and garlic basil naan.',
                'price' => 35.00,
                'serves' => 'Serves 10',
            ],
            [
                'slug' => 'tray-gulab-jamun',
                'name' => 'Gulab Jamun (Tray)',
                'description' => 'Warm milk dumplings in rose-cardamom syrup.',
                'price' => 40.00,
                'serves' => 'Serves 10',
            ],
        ];
    }

    public static function tray(string $slug): ?array
    {
        foreach (self::trays() as $tray) {
            if ($tray['slug'] === $slug) {
                return $tray;
            }
        }

        return null;
    }
}
