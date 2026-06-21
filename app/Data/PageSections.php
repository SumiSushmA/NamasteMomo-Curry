<?php

namespace App\Data;

/**
 * Registry of all customer-site copy and media manageable from Admin → Website content.
 */
class PageSections
{
    /** @return array<string, array<int, array{section: string, type: string, label: string, default: string, hint?: string}>> */
    public static function grouped(): array
    {
        return [
            'Global' => [
                ['section' => 'Logo image', 'type' => 'Media', 'label' => 'Site logo', 'default' => '', 'hint' => 'Used in header, gift cards, and favicon areas.'],
                ['section' => 'Marquee text', 'type' => 'Text', 'label' => 'Homepage ticker text', 'default' => 'Namaste MoMo & curry house · Indian & Nepali · Seattle · Momo & Curry · Himalayan flavors ·'],
                ['section' => 'Footer tagline', 'type' => 'Textarea', 'label' => 'Footer tagline', 'default' => 'Hand-pleated momo, charcoal tandoor, and slow-simmered curries — dine in, pick up, or order delivery from Namaste MoMo & curry house.'],
                ['section' => 'Footer CTA eyebrow', 'type' => 'Text', 'label' => 'Footer CTA eyebrow', 'default' => 'Ready for tonight?'],
                ['section' => 'Footer CTA heading', 'type' => 'Text', 'label' => 'Footer CTA heading', 'default' => 'Ready for momo tonight?'],
                ['section' => 'Home footer headline', 'type' => 'Text', 'label' => 'Footer headline', 'default' => "Craving momo tonight? We've got you."],
                ['section' => 'Delivery blurb', 'type' => 'Textarea', 'label' => 'Delivery & pickup blurb', 'default' => 'Order from Namaste MoMo & curry house for pickup or delivery. Most orders are ready in 30–60 minutes within our local delivery area.'],
                ['section' => 'Catering blurb', 'type' => 'Textarea', 'label' => 'Catering blurb', 'default' => 'From office lunches to birthdays and celebrations — Namaste MoMo & curry house caters groups of 20 and up with momo trays, curries, biryani, and naan.'],
                ['section' => 'Hours banner', 'type' => 'Text', 'label' => 'Hours banner (optional)', 'default' => 'Tue–Sun · 11:00 AM – 9:00 PM'],
            ],
            'Homepage' => [
                ['section' => 'Hero headline', 'type' => 'Text', 'label' => 'Journey section body', 'default' => 'Namaste — welcome to MoMo & curry house.'],
                ['section' => 'Hero subtext', 'type' => 'Textarea', 'label' => 'Hero subtitle', 'default' => 'Your neighborhood spot for juicy momo, sizzling tandoori, and comforting Indian & Nepali curries. Order for pickup or delivery, or join us for a relaxed meal on Aurora Avenue.'],
                ['section' => 'Home hero image', 'type' => 'Media', 'label' => 'Hero background image', 'default' => ''],
                ['section' => 'Home story eyebrow', 'type' => 'Text', 'label' => 'Story eyebrow', 'default' => 'Our story'],
                ['section' => 'Home story title', 'type' => 'Text', 'label' => 'Story heading', 'default' => 'Momo first. Curry always. Welcome home.'],
                ['section' => 'Home story text', 'type' => 'Textarea', 'label' => 'Story body', 'default' => 'At Namaste MoMo & curry house, every meal starts with care — hand-pleated momo, curries simmered to order, and naan pulled warm from the tandoor.'],
                ['section' => 'Home story bullets', 'type' => 'Textarea', 'label' => 'Story bullet points (one per line)', 'default' => "Fresh momo made daily\nSmall-batch curry bases\nWarm family-style service"],
                ['section' => 'Home story stamp title', 'type' => 'Text', 'label' => 'Story stamp title', 'default' => 'Since day one'],
                ['section' => 'Home story stamp text', 'type' => 'Text', 'label' => 'Story stamp subtitle', 'default' => 'Indian & Nepali kitchen'],
                ['section' => 'Home story image', 'type' => 'Media', 'label' => 'Story section image', 'default' => ''],
                ['section' => 'Home journey eyebrow', 'type' => 'Text', 'label' => 'Journey eyebrow', 'default' => 'Our menu'],
                ['section' => 'Home journey title', 'type' => 'Text', 'label' => 'Journey heading', 'default' => 'Around Seattle, one plate at a time.'],
                ['section' => 'Home journey stat 1', 'type' => 'Text', 'label' => 'Journey stat 1 (value|label)', 'default' => '20+|Momo styles'],
                ['section' => 'Home journey stat 2', 'type' => 'Text', 'label' => 'Journey stat 2 (value|label)', 'default' => '4.9|Guest rating'],
                ['section' => 'Home journey stat 3', 'type' => 'Text', 'label' => 'Journey stat 3 (value|label)', 'default' => '30 min|Pickup ready'],
                ['section' => 'Home journey badge', 'type' => 'Text', 'label' => 'Journey badge text', 'default' => 'Hand-pleated fresh daily'],
                ['section' => 'Home journey image main', 'type' => 'Media', 'label' => 'Journey collage — main image', 'default' => ''],
                ['section' => 'Home journey image 2', 'type' => 'Media', 'label' => 'Journey collage — image 2', 'default' => ''],
                ['section' => 'Home journey image 3', 'type' => 'Media', 'label' => 'Journey collage — image 3', 'default' => ''],
                ['section' => 'Home signatures eyebrow', 'type' => 'Text', 'label' => 'Signatures eyebrow', 'default' => 'Signature dishes'],
                ['section' => 'Home signatures title', 'type' => 'Text', 'label' => 'Signatures heading', 'default' => 'Guest favorites'],
                ['section' => 'Home tandoor eyebrow', 'type' => 'Text', 'label' => 'Tandoor band eyebrow', 'default' => 'Charcoal-fired signature'],
                ['section' => 'Home tandoori title', 'type' => 'Text', 'label' => 'Tandoor band heading', 'default' => 'From the tandoor clay oven'],
                ['section' => 'Home tandoor text', 'type' => 'Textarea', 'label' => 'Tandoor band body', 'default' => 'Tandoori chicken, lamb boti, paneer tikka, and tandoori momos — marinated in yogurt and spices, roasted at high heat.'],
                ['section' => 'Home tandoor tags', 'type' => 'Textarea', 'label' => 'Tandoor tags (one per line)', 'default' => "Clay oven roasted\nHand-cut marination\nServed sizzling"],
                ['section' => 'Home tandoor image', 'type' => 'Media', 'label' => 'Tandoor band background', 'default' => ''],
                ['section' => 'Home reserve title', 'type' => 'Text', 'label' => 'Visit section heading', 'default' => 'Dine in, cater, or take home.'],
                ['section' => 'Home reserve text', 'type' => 'Textarea', 'label' => 'Reserve card body', 'default' => 'Walk in or reserve a table in our welcoming dining room — friendly service, cozy booths, and the aroma of momo and masala in the air.'],
                ['section' => 'Home reserve card title', 'type' => 'Text', 'label' => 'Reserve card title', 'default' => 'Reserve a table'],
                ['section' => 'Home catering card title', 'type' => 'Text', 'label' => 'Catering card title', 'default' => 'Catering & events'],
                ['section' => 'Home catering title', 'type' => 'Text', 'label' => 'Catering section title (legacy)', 'default' => 'Feed your crowd'],
                ['section' => 'Home reserve image', 'type' => 'Media', 'label' => 'Reserve card image', 'default' => ''],
                ['section' => 'Home catering image', 'type' => 'Media', 'label' => 'Catering card image', 'default' => ''],
                ['section' => 'Home gallery eyebrow', 'type' => 'Text', 'label' => 'Gallery eyebrow', 'default' => 'Inside the restaurant'],
                ['section' => 'Home gallery title', 'type' => 'Text', 'label' => 'Gallery heading', 'default' => 'The food, the room & the feast'],
                ['section' => 'Home reviews eyebrow', 'type' => 'Text', 'label' => 'Reviews eyebrow', 'default' => 'From our guests'],
                ['section' => 'Home reviews title', 'type' => 'Text', 'label' => 'Reviews heading', 'default' => 'Why neighbors keep coming back'],
            ],
            'Menu' => [
                ['section' => 'Menu hero eyebrow', 'type' => 'Text', 'label' => 'Hero eyebrow', 'default' => 'Menu & online ordering'],
                ['section' => 'Menu hero title', 'type' => 'Text', 'label' => 'Hero heading', 'default' => 'Order from our kitchen.'],
                ['section' => 'Menu hero lead', 'type' => 'Textarea', 'label' => 'Hero lead', 'default' => 'Everything cooked to order — momo, tandoori, curries, biryani, and Nepali favorites. Pickup or delivery.'],
                ['section' => 'Menu hero image', 'type' => 'Media', 'label' => 'Hero background image', 'default' => ''],
            ],
            'Gallery' => [
                ['section' => 'Gallery eyebrow', 'type' => 'Text', 'label' => 'Page eyebrow', 'default' => 'Gallery'],
                ['section' => 'Gallery title', 'type' => 'Text', 'label' => 'Page heading', 'default' => 'A look inside'],
                ['section' => 'Gallery subtitle', 'type' => 'Textarea', 'label' => 'Page subtitle', 'default' => 'The plates, the room, and the feasts — a peek at what we serve and where we welcome you.'],
            ],
            'About' => [
                ['section' => 'About eyebrow', 'type' => 'Text', 'label' => 'Opening eyebrow', 'default' => 'Seattle · Indian & Nepali'],
                ['section' => 'About tag', 'type' => 'Text', 'label' => 'Opening tag', 'default' => 'Our story'],
                ['section' => 'About title line 1', 'type' => 'Text', 'label' => 'Opening title line 1', 'default' => 'Indian & Nepali'],
                ['section' => 'About title line 2', 'type' => 'Text', 'label' => 'Opening title line 2', 'default' => 'on Aurora Avenue'],
                ['section' => 'About lead', 'type' => 'Textarea', 'label' => 'Opening lead', 'default' => "Seattle's destination for momo, curries, tandoori, and Nepali thali — cooked to order in a warm, family-run dining room."],
                ['section' => 'About scroll CTA', 'type' => 'Text', 'label' => 'Scroll CTA', 'default' => 'Read our story ↓'],
                ['section' => 'About caption title', 'type' => 'Text', 'label' => 'Hero caption title', 'default' => 'Family-run kitchen'],
                ['section' => 'About caption text', 'type' => 'Textarea', 'label' => 'Hero caption', 'default' => 'Momo craft & curry house warmth on Aurora Avenue.'],
            ],
            'Contact' => [
                ['section' => 'Contact eyebrow', 'type' => 'Text', 'label' => 'Hero eyebrow', 'default' => 'Contact'],
                ['section' => 'Contact title', 'type' => 'Text', 'label' => 'Hero heading', 'default' => "We'd love to hear from you"],
                ['section' => 'Contact lead', 'type' => 'Textarea', 'label' => 'Hero lead', 'default' => 'Questions about the menu, catering for your event, or just want to say hi — our team reads every message and replies within one business day.'],
            ],
            'Offers' => [
                ['section' => 'Promos eyebrow', 'type' => 'Text', 'label' => 'Hero eyebrow', 'default' => 'Offers & specials'],
                ['section' => 'Promos title', 'type' => 'Text', 'label' => 'Hero heading', 'default' => 'Deals going on now'],
                ['section' => 'Promos subtitle', 'type' => 'Textarea', 'label' => 'Hero subtitle', 'default' => 'Limited-time offers, combo deals, and dine-in perks — updated regularly.'],
                ['section' => 'Promos newsletter title', 'type' => 'Text', 'label' => 'Newsletter heading', 'default' => 'Join the table'],
                ['section' => 'Promos newsletter text', 'type' => 'Textarea', 'label' => 'Newsletter body', 'default' => 'Get new offers and seasonal specials in your inbox.'],
            ],
            'Catering' => [
                ['section' => 'Catering hero eyebrow', 'type' => 'Text', 'label' => 'Hero eyebrow', 'default' => 'Catering studio'],
                ['section' => 'Catering hero title', 'type' => 'Text', 'label' => 'Hero heading', 'default' => 'Celebrate with food made to share.'],
                ['section' => 'Catering hero lead', 'type' => 'Textarea', 'label' => 'Hero lead', 'default' => 'From office lunches to milestone parties — build a custom per-person spread or pick ready-made trays. Fresh momo, curries, and naan for groups of 20 and up.'],
                ['section' => 'Catering hero image', 'type' => 'Media', 'label' => 'Hero image', 'default' => ''],
            ],
            'Gift cards' => [
                ['section' => 'Giftcards title', 'type' => 'Text', 'label' => 'Page heading', 'default' => 'Give the gift of the feast'],
                ['section' => 'Giftcards subtitle', 'type' => 'Textarea', 'label' => 'Page subtitle', 'default' => 'Digital gift cards for momo nights, family dinners, and celebrations — delivered by email or ready to print.'],
            ],
            'Reserve' => [
                ['section' => 'Reserve title', 'type' => 'Text', 'label' => 'Page heading', 'default' => 'Reserve your table'],
                ['section' => 'Reserve lead', 'type' => 'Textarea', 'label' => 'Page lead', 'default' => 'Book instantly — for an intimate dinner or the whole family. Large parties and the chef\'s counter, just ask.'],
            ],
        ];
    }

    /** @return array<string, string> */
    public static function defaults(): array
    {
        $out = [];
        foreach (self::grouped() as $sections) {
            foreach ($sections as $row) {
                $out[$row['section']] = $row;
            }
        }

        return $out;
    }

    /** @return array<string, string> */
    public static function defaultValues(): array
    {
        return array_map(fn ($row) => $row['default'], self::defaults());
    }
}
