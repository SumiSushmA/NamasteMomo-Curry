<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class StockImages
{
    /** @var list<string> */
    private const LOCAL_EXTENSIONS = ['webp', 'jpg', 'jpeg', 'png', 'gif'];

    /** Canonical dish name for each local photo (what is actually in the image). */
    /** @var array<string, string> */
    private const FILE_DISHES = [
        'food.jpeg' => 'House Feast Spread',
        'food 1.jpeg' => 'Momo & Thali Spread',
        'food 2.jpeg' => 'Samosa Chaat',
        'food 3.jpeg' => 'Vegetarian Thali',
        'food 4.jpeg' => 'Korma',
        'food 5.jpeg' => 'Aloo Matar',
        'food 6.jpeg' => 'Kadai Paneer',
        'food 7.jpeg' => 'Khaja Set',
        'food 8.jpeg' => 'Momo & Nepali Favorites',
        'food 9.jpeg' => 'Naan',
        'food 10.jpeg' => 'Nepali Thali',
        'food 11.jpeg' => 'Garden Salad',
        'food 12.jpeg' => 'Chicken Pakora',
        'food 13.jpeg' => 'French Fries',
        'food 14.jpeg' => 'Chatpate & Choila',
        'food 15.jpeg' => 'Tandoori Momo',
        'food 16.jpeg' => 'Mango Lassi',
        'food 17.jpeg' => 'Strawberry Lassi',
        'food 18.jpeg' => 'Aloo Gobi',
        'food 19.jpeg' => 'Chicken Chili',
        'food 20.jpeg' => 'Assorted Momo Platter',
    ];

    /** Homepage sections — online photos for ambiance (hero, dining, catering, etc.) */
    /** @var array<string, array{url: string, label: string}> */
    private const SECTION_STOCK = [
        'Home hero image' => [
            'url' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1600&q=80',
            'label' => 'Restaurant dining room',
        ],
        'Home story image' => [
            'url' => 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=1200&q=80',
            'label' => 'Fresh from our kitchen',
        ],
        'Home reserve image' => [
            'url' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?auto=format&fit=crop&w=1200&q=80',
            'label' => 'Dine with us',
        ],
        'Menu hero image' => [
            'url' => 'https://images.unsplash.com/photo-1552566626-52f8b828add9?auto=format&fit=crop&w=1600&q=80',
            'label' => 'Order from our kitchen',
        ],
    ];

    /** Homepage sections — local dish photos only */
    /** @var array<string, string> */
    private const SECTION_LOCAL = [
        'Home journey image main' => 'food 20.jpeg',
        'Home journey image 2' => 'food 2.jpeg',
        'Home journey image 3' => 'food 12.jpeg',
        'Home tandoor image' => 'food 9.jpeg',
        'Catering hero image' => 'food 1.jpeg',
    ];

    /** @deprecated Use SECTION_STOCK or SECTION_LOCAL */
    private const SECTION_SLOTS = [];

    /** Menu / dish labels → photo file (longer keys win on partial match). */
    /** @var array<string, string> */
    private const MENU_LABEL_FILES = [
        'assorted momo platter' => 'food 20.jpeg',
        'combo momo' => 'food 20.jpeg',
        'sandheko momo' => 'food 20.jpeg',
        'fried momo' => 'food 20.jpeg',
        'butter masala momo' => 'food 20.jpeg',
        'jhol (soup) momo' => 'food 20.jpeg',
        'jhol momo' => 'food 20.jpeg',
        'chilli momo' => 'food 20.jpeg',
        'chili momo' => 'food 20.jpeg',
        'c-momo' => 'food 20.jpeg',
        'chicken momo' => 'food 20.jpeg',
        'momo' => 'food 20.jpeg',

        'samosa chaat' => 'food 2.jpeg',
        'vegetable samosa' => 'food 2.jpeg',
        'chicken samosa' => 'food 2.jpeg',
        'lamb samosa' => 'food 2.jpeg',
        'samosa' => 'food 2.jpeg',

        'chicken pakora' => 'food 12.jpeg',
        'paneer pakora' => 'food 6.jpeg',
        'vegetable pakora' => 'food 18.jpeg',

        'chicken chili' => 'food 19.jpeg',
        'chili chicken' => 'food 19.jpeg',
        'gobi manchurian' => 'food 19.jpeg',

        'chatpate' => 'food 14.jpeg',
        'taas' => 'food 14.jpeg',
        'choila' => 'food 14.jpeg',
        'sekuwa' => 'food 14.jpeg',

        'korma' => 'food 4.jpeg',
        'butter curry' => 'food 4.jpeg',
        'tikka masala' => 'food 6.jpeg',
        'matar paneer' => 'food 6.jpeg',
        'kadai paneer' => 'food 6.jpeg',
        'karahi' => 'food 6.jpeg',
        'shahi paneer' => 'food 6.jpeg',
        'malai kofta' => 'food 6.jpeg',
        'paneer' => 'food 6.jpeg',
        'aloo matar' => 'food 5.jpeg',
        'aloo gobi' => 'food 18.jpeg',
        'house curry' => 'food 10.jpeg',
        'goat curry' => 'food 10.jpeg',
        'vindaloo' => 'food 10.jpeg',
        'saag' => 'food 3.jpeg',
        'gundruk' => 'food 3.jpeg',
        'aloo bodi tama' => 'food 8.jpeg',
        'aloo rayo ko saag' => 'food 3.jpeg',
        'dal makhani' => 'food 3.jpeg',
        'chana masala' => 'food 5.jpeg',
        'curry' => 'food 10.jpeg',

        'vegetarian thali' => 'food 3.jpeg',
        'nepali thali' => 'food 10.jpeg',
        'thali' => 'food 10.jpeg',
        'khaja set' => 'food 7.jpeg',
        'daal soup' => 'food 3.jpeg',

        'plain butter naan' => 'food 9.jpeg',
        'garlic basil naan' => 'food 9.jpeg',
        'garlic naan' => 'food 9.jpeg',
        'naan' => 'food 9.jpeg',

        'garden salad' => 'food 11.jpeg',
        'salad' => 'food 11.jpeg',
        'french fries' => 'food 13.jpeg',
        'papadam' => 'food 9.jpeg',

        'mango lassi' => 'food 16.jpeg',
        'strawberry lassi' => 'food 17.jpeg',
        'rose lassi' => 'food 17.jpeg',
        'lassi' => 'food 16.jpeg',

        'founder' => 'food 8.jpeg',
        'promo' => 'food 20.jpeg',
    ];

    /** Non-dish labels → online stock URL */
    /** @var array<string, string> */
    private const STOCK_URLS = [
        'dining room' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?auto=format&fit=crop&w=1200&q=80',
        'restaurant' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1600&q=80',
        'hero' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1600&q=80',
        'tandoori' => 'https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?auto=format&fit=crop&w=1600&q=80',
        'tandoor' => 'https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?auto=format&fit=crop&w=1600&q=80',
        'kitchen' => 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=1200&q=80',
        'catering spread' => 'https://images.unsplash.com/photo-1555244162-803834f70033?auto=format&fit=crop&w=1200&q=80',
        'catering' => 'https://images.unsplash.com/photo-1555244162-803834f70033?auto=format&fit=crop&w=1200&q=80',
        'celebration' => 'https://images.unsplash.com/photo-1555244162-803834f70033?auto=format&fit=crop&w=1200&q=80',
        'gallery' => 'https://images.unsplash.com/photo-1552566626-52f8b828add9?auto=format&fit=crop&w=1200&q=80',
    ];

    /** Gallery captions → photo file */
    /** @var array<string, string> */
    private const GALLERY_CAPTION_FILES = [
        'assorted momo platter' => 'food 20.jpeg',
        'combo momo' => 'food 20.jpeg',
        'chilli momo' => 'food 20.jpeg',
        'butter masala momo' => 'food 20.jpeg',
        'chicken chili' => 'food 19.jpeg',
        'chicken pakora' => 'food 12.jpeg',
        'samosa chaat' => 'food 2.jpeg',
        'korma' => 'food 4.jpeg',
        'nepali thali' => 'food 10.jpeg',
        'aloo gobi' => 'food 18.jpeg',
        'naan' => 'food 9.jpeg',
        'mango lassi' => 'food 16.jpeg',
        'vegetarian thali' => 'food 3.jpeg',
        'khaja set' => 'food 7.jpeg',
        'chatpate & choila' => 'food 14.jpeg',
        'kadai paneer' => 'food 6.jpeg',
        'garden salad' => 'food 11.jpeg',
    ];

    /** Gallery ambiance captions → online stock URL */
    /** @var array<string, string> */
    private const GALLERY_STOCK_URLS = [
        'house feast spread' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1200&q=80',
        'dining room' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?auto=format&fit=crop&w=1200&q=80',
        'celebration feast' => 'https://images.unsplash.com/photo-1555244162-803834f70033?auto=format&fit=crop&w=1200&q=80',
        'office lunch setup' => 'https://images.unsplash.com/photo-1555244162-803834f70033?auto=format&fit=crop&w=1200&q=80',
        'family-friendly seating' => 'https://images.unsplash.com/photo-1552566626-52f8b828add9?auto=format&fit=crop&w=1200&q=80',
        'cozy black and red interior' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1200&q=80',
        'counter service' => 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=1200&q=80',
        'live momo station' => 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=1200&q=80',
        'tandoor clay oven' => 'https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?auto=format&fit=crop&w=1200&q=80',
    ];

    /** @var array<string, string> */
    private const MAP = [
        'hero' => 'https://images.unsplash.com/photo-1585937421612-70a008356fbe?auto=format&fit=crop&w=1600&q=80',
    ];

    private const DEFAULT = 'https://images.unsplash.com/photo-1585937421612-70a008356fbe?auto=format&fit=crop&w=800&q=80';

    public static function imagesDir(): string
    {
        return public_path('images');
    }

    public static function sectionImage(string $section): ?string
    {
        if ($stock = self::SECTION_STOCK[$section] ?? null) {
            return $stock['url'];
        }

        $file = self::SECTION_LOCAL[$section] ?? null;
        if (! $file) {
            return null;
        }

        return self::fileUrl($file);
    }

    public static function sectionDishName(string $section): string
    {
        if ($stock = self::SECTION_STOCK[$section] ?? null) {
            return $stock['label'];
        }

        $file = self::SECTION_LOCAL[$section] ?? null;

        return ($file && isset(self::FILE_DISHES[$file]))
            ? self::FILE_DISHES[$file]
            : '';
    }

    public static function dishForFile(string $filename): string
    {
        return self::FILE_DISHES[$filename] ?? '';
    }

    public static function galleryForCaption(?string $caption): ?string
    {
        if (! $caption) {
            return null;
        }

        $key = strtolower(trim($caption));

        if ($url = self::galleryImageForKey($key)) {
            return $url;
        }

        return self::forLabel($caption);
    }

    public static function slot(string $key): string
    {
        if ($stock = self::SECTION_STOCK[$key] ?? null) {
            return $stock['url'];
        }

        $file = self::SECTION_LOCAL[$key] ?? self::MENU_LABEL_FILES[$key] ?? null;
        if ($file && ($url = self::fileUrl($file))) {
            return $url;
        }

        return self::forLabel($key);
    }

    public static function galleryAt(int $index): string
    {
        $pool = self::galleryPoolList();

        if ($pool === []) {
            return self::forLabel('gallery');
        }

        return $pool[$index % count($pool)];
    }

    /** @return list<string> */
    public static function galleryLocalPool(): array
    {
        return self::galleryPoolList();
    }

    public static function teamAt(int $index): string
    {
        $files = ['food 8.jpeg', 'food.jpeg', 'food 7.jpeg'];

        $file = $files[$index % count($files)];

        return self::fileUrl($file) ?? self::galleryAt($index);
    }

    public static function forLabel(?string $label): string
    {
        if ($local = self::localForLabel($label)) {
            return $local;
        }

        $pool = self::localFoodPool();
        if ($pool !== []) {
            $key = strtolower(trim($label ?? 'dish'));

            return $pool[abs(crc32($key)) % count($pool)];
        }

        if (! $label) {
            return self::DEFAULT;
        }

        $key = strtolower(trim($label));

        if (isset(self::MAP[$key])) {
            return self::MAP[$key];
        }

        return self::DEFAULT;
    }

    public static function hero(): string
    {
        return self::sectionImage('Home hero image') ?? self::forLabel('hero');
    }

    public static function resolve(?string $label, ?string $imagePath = null, ?string $toastImageUrl = null): string
    {
        if (filled($toastImageUrl)) {
            return $toastImageUrl;
        }

        if ($imagePath) {
            if (str_starts_with($imagePath, 'http://') || str_starts_with($imagePath, 'https://')) {
                return $imagePath;
            }

            if (str_starts_with($imagePath, 'images/')) {
                return self::publicImageUrl(basename($imagePath));
            }

            return Storage::url($imagePath);
        }

        return self::forLabel($label);
    }

    public static function publicImageUrl(string $filename): string
    {
        $parts = array_map('rawurlencode', explode('/', str_replace('\\', '/', $filename)));

        return '/images/'.implode('/', $parts);
    }

    private static function fileUrl(string $filename): ?string
    {
        $path = self::imagesDir().DIRECTORY_SEPARATOR.$filename;

        return is_file($path) ? self::publicImageUrl($filename) : null;
    }

    private static function localForLabel(?string $label): ?string
    {
        if (! $label) {
            return null;
        }

        $key = strtolower(trim($label));

        if ($url = self::menuImageForKey($key)) {
            return $url;
        }

        $candidates = array_unique(array_filter([
            $key,
            self::filenameSlug($label),
            str_replace('-', ' ', self::filenameSlug($label)),
        ]));

        foreach ($candidates as $basename) {
            if ($url = self::menuImageForKey($basename)) {
                return $url;
            }

            if ($url = self::localFileUrl($basename)) {
                return $url;
            }
        }

        return null;
    }

    private static function menuImageForKey(string $key): ?string
    {
        if (isset(self::STOCK_URLS[$key])) {
            return self::STOCK_URLS[$key];
        }

        if (isset(self::MENU_LABEL_FILES[$key])) {
            return self::fileUrl(self::MENU_LABEL_FILES[$key]);
        }

        $best = null;
        $bestLen = 0;
        foreach (self::MENU_LABEL_FILES as $needle => $file) {
            if (str_contains($key, $needle) && strlen($needle) > $bestLen) {
                $best = $file;
                $bestLen = strlen($needle);
            }
        }

        if ($best) {
            return self::fileUrl($best);
        }

        $bestUrl = null;
        $bestUrlLen = 0;
        foreach (self::STOCK_URLS as $needle => $url) {
            if (str_contains($key, $needle) && strlen($needle) > $bestUrlLen) {
                $bestUrl = $url;
                $bestUrlLen = strlen($needle);
            }
        }

        return $bestUrl;
    }

    private static function galleryImageForKey(string $key): ?string
    {
        if (isset(self::GALLERY_STOCK_URLS[$key])) {
            return self::GALLERY_STOCK_URLS[$key];
        }

        if (isset(self::GALLERY_CAPTION_FILES[$key])) {
            return self::fileUrl(self::GALLERY_CAPTION_FILES[$key]);
        }

        $best = null;
        $bestLen = 0;
        foreach (self::GALLERY_CAPTION_FILES as $needle => $file) {
            if (str_contains($key, $needle) && strlen($needle) > $bestLen) {
                $best = $file;
                $bestLen = strlen($needle);
            }
        }

        if ($best) {
            return self::fileUrl($best);
        }

        $bestUrl = null;
        $bestUrlLen = 0;
        foreach (self::GALLERY_STOCK_URLS as $needle => $url) {
            if (str_contains($key, $needle) && strlen($needle) > $bestUrlLen) {
                $bestUrl = $url;
                $bestUrlLen = strlen($needle);
            }
        }

        return $bestUrl;
    }

    private static function localFileUrl(string $basename): ?string
    {
        $dir = self::imagesDir();
        if (! is_dir($dir)) {
            return null;
        }

        foreach (self::LOCAL_EXTENSIONS as $ext) {
            $path = $dir.DIRECTORY_SEPARATOR.$basename.'.'.$ext;
            if (is_file($path)) {
                return self::publicImageUrl(basename($path));
            }
        }

        return null;
    }

    /** @return list<string> */
    private static function localFoodPool(): array
    {
        static $pool = null;
        if ($pool !== null) {
            return $pool;
        }

        $dir = self::imagesDir();
        $pool = [];
        if (! is_dir($dir)) {
            return [];
        }

        foreach (scandir($dir) ?: [] as $name) {
            if ($name === '.' || $name === '..') {
                continue;
            }
            if (preg_match('/^food(?:\s+\d+)?\.(?:jpe?g|png|webp)$/i', $name)) {
                $pool[] = self::publicImageUrl($name);
            }
        }

        natsort($pool);

        return array_values($pool);
    }

    /** @return list<string> */
    private static function galleryPoolList(): array
    {
        $pool = [];
        foreach (array_keys(self::FILE_DISHES) as $file) {
            if ($file === 'food.jpeg') {
                continue;
            }
            if ($url = self::fileUrl($file)) {
                $pool[] = $url;
            }
        }

        return $pool;
    }

    private static function filenameSlug(string $label): string
    {
        $slug = strtolower(trim($label));
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug) ?? '';
        $slug = trim($slug, '-');

        return $slug;
    }
}
