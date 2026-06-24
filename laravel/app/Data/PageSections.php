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
                ['section' => 'Marquee text', 'type' => 'Text', 'label' => 'Homepage ticker text', 'default' => 'Namaste MoMo & curry house · 6211 Evergreen Way · Steamed · Fried · Jhol momo · Open Tue–Sun 11AM–9PM ·'],
                ['section' => 'Footer tagline', 'type' => 'Textarea', 'label' => 'Footer tagline', 'default' => 'Hand-folded momo, tandoor favorites, and homestyle curries at Namaste MoMo & curry house — 6211 Evergreen Way, Everett.'],
                ['section' => 'Footer CTA eyebrow', 'type' => 'Text', 'label' => 'Footer CTA eyebrow', 'default' => 'Open Tue–Sun'],
                ['section' => 'Footer CTA heading', 'type' => 'Text', 'label' => 'Footer CTA heading', 'default' => 'Ready for momo tonight?'],
                ['section' => 'Home footer headline', 'type' => 'Text', 'label' => 'Footer headline', 'default' => "Hungry for momo? We're on Evergreen Way."],
                ['section' => 'Delivery blurb', 'type' => 'Textarea', 'label' => 'Delivery & pickup blurb', 'default' => 'Order online for pickup or delivery from 6211 Evergreen Way, Everett. Most orders are ready in 30–60 minutes. Closed Mondays.'],
                ['section' => 'Catering blurb', 'type' => 'Textarea', 'label' => 'Catering blurb', 'default' => 'Office lunches, birthday parties, and family gatherings — we cater groups of 20 or more with momo trays, curry spreads, biryani, and fresh naan.'],
                ['section' => 'Hours banner', 'type' => 'Text', 'label' => 'Hours banner (optional)', 'default' => 'Tue–Sun · 11:00 AM – 9:00 PM · Closed Mondays'],
            ],
            'Homepage' => [
                ['section' => 'Hero headline', 'type' => 'Text', 'label' => 'Journey section body', 'default' => 'A full menu built around momo — and everything worth pairing with it.'],
                ['section' => 'Hero subtext', 'type' => 'Textarea', 'label' => 'Hero subtitle', 'default' => 'Everett\'s home for hand-folded momo, homestyle curry, and tandoor-roasted favorites. Dine in at 6211 Evergreen Way, pick up on your way home, or order delivery — open Tuesday through Sunday, 11 AM to 9 PM.'],
                ['section' => 'Home hero image', 'type' => 'Media', 'label' => 'Hero background image', 'default' => ''],
                ['section' => 'Home story eyebrow', 'type' => 'Text', 'label' => 'Story eyebrow', 'default' => 'Welcome to Everett'],
                ['section' => 'Home story title', 'type' => 'Text', 'label' => 'Story heading', 'default' => 'Where every basket starts by hand.'],
                ['section' => 'Home story text', 'type' => 'Textarea', 'label' => 'Story body', 'default' => 'Namaste MoMo & curry house opened on Evergreen Way with one goal: serve momo the way families make them at home — fresh fillings, soft wrappers, and sauces worth dipping into again and again. From combo platters to slow-simmered curries and naan from the clay oven, this is comfort food made with real care.'],
                ['section' => 'Home story bullets', 'type' => 'Textarea', 'label' => 'Story bullet points (one per line)', 'default' => "Hand-folded momo every day\nCurries made to order\nDine in, pickup & delivery"],
                ['section' => 'Home story stamp title', 'type' => 'Text', 'label' => 'Story stamp title', 'default' => 'Everett, WA'],
                ['section' => 'Home story stamp text', 'type' => 'Text', 'label' => 'Story stamp subtitle', 'default' => '6211 Evergreen Way'],
                ['section' => 'Home story image', 'type' => 'Media', 'label' => 'Story section image', 'default' => ''],
                ['section' => 'Home journey eyebrow', 'type' => 'Text', 'label' => 'Journey eyebrow', 'default' => 'What we serve'],
                ['section' => 'Home journey title', 'type' => 'Text', 'label' => 'Journey heading', 'default' => 'Momo, curry, tandoor — and more.'],
                ['section' => 'Home journey stat 1', 'type' => 'Text', 'label' => 'Journey stat 1 (value|label) — unused', 'default' => '|'],
                ['section' => 'Home journey stat 2', 'type' => 'Text', 'label' => 'Journey stat 2 (value|label)', 'default' => '11–9|Open Tue–Sun'],
                ['section' => 'Home journey stat 3', 'type' => 'Text', 'label' => 'Journey stat 3 (value|label)', 'default' => '30 min|Avg. pickup time'],
                ['section' => 'Home journey badge', 'type' => 'Text', 'label' => 'Journey badge text', 'default' => 'Folded fresh, never frozen'],
                ['section' => 'Home journey image main', 'type' => 'Media', 'label' => 'Journey collage — main image', 'default' => ''],
                ['section' => 'Home journey image 2', 'type' => 'Media', 'label' => 'Journey collage — image 2', 'default' => ''],
                ['section' => 'Home journey image 3', 'type' => 'Media', 'label' => 'Journey collage — image 3', 'default' => ''],
                ['section' => 'Home signatures eyebrow', 'type' => 'Text', 'label' => 'Signatures eyebrow', 'default' => 'Start here'],
                ['section' => 'Home signatures title', 'type' => 'Text', 'label' => 'Signatures heading', 'default' => 'Dishes our guests order first'],
                ['section' => 'Home tandoor eyebrow', 'type' => 'Text', 'label' => 'Starters band eyebrow', 'default' => 'Starters'],
                ['section' => 'Home tandoori title', 'type' => 'Text', 'label' => 'Starters band heading', 'default' => 'Crispy golden samosa'],
                ['section' => 'Home tandoor text', 'type' => 'Textarea', 'label' => 'Starters band body', 'default' => 'Vegetable, paneer, and chicken samosa — fried to order with mint and tamarind chutney. Try our chholey samosa topped with spiced chickpeas.'],
                ['section' => 'Home tandoor tags', 'type' => 'Textarea', 'label' => 'Starters tags (one per line)', 'default' => "Vegetable, paneer & chicken\nFlaky pastry, spiced filling\nMint & tamarind chutney"],
                ['section' => 'Home tandoor image', 'type' => 'Media', 'label' => 'Starters band background', 'default' => ''],
                ['section' => 'Home reserve title', 'type' => 'Text', 'label' => 'Visit section heading', 'default' => 'Come see us on Evergreen Way'],
                ['section' => 'Home reserve text', 'type' => 'Textarea', 'label' => 'Reserve card body', 'default' => 'Walk in or reserve a table in our Everett dining room — cozy booths, friendly service, and momo steaming from the kitchen.'],
                ['section' => 'Home reserve card title', 'type' => 'Text', 'label' => 'Reserve card title', 'default' => 'Dine with us'],
                ['section' => 'Home catering card title', 'type' => 'Text', 'label' => 'Catering card title', 'default' => 'Catering & events'],
                ['section' => 'Home catering title', 'type' => 'Text', 'label' => 'Catering section title (legacy)', 'default' => 'Feed your crowd'],
                ['section' => 'Home reserve image', 'type' => 'Media', 'label' => 'Reserve card image', 'default' => ''],
                ['section' => 'Home catering image', 'type' => 'Media', 'label' => 'Catering card image', 'default' => ''],
                ['section' => 'Home gallery eyebrow', 'type' => 'Text', 'label' => 'Gallery eyebrow', 'default' => 'Take a look inside'],
                ['section' => 'Home gallery title', 'type' => 'Text', 'label' => 'Gallery heading', 'default' => 'The food, the flavors & our dining room'],
                ['section' => 'Home reviews eyebrow', 'type' => 'Text', 'label' => 'Reviews eyebrow', 'default' => 'Kind words'],
                ['section' => 'Home reviews title', 'type' => 'Text', 'label' => 'Reviews heading', 'default' => 'What Everett is saying'],
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
                ['section' => 'About eyebrow', 'type' => 'Text', 'label' => 'Opening eyebrow', 'default' => 'Everett, WA'],
                ['section' => 'About tag', 'type' => 'Text', 'label' => 'Opening tag', 'default' => 'About us'],
                ['section' => 'About title line 1', 'type' => 'Text', 'label' => 'Opening title line 1', 'default' => 'Namaste MoMo'],
                ['section' => 'About title line 2', 'type' => 'Text', 'label' => 'Opening title line 2', 'default' => '& curry house'],
                ['section' => 'About lead', 'type' => 'Textarea', 'label' => 'Opening lead', 'default' => "We're a family-run restaurant at 6211 Evergreen Way — a cozy spot in Everett where momo is the star and curries, tandoori, and Nepali classics round out the table."],
                ['section' => 'About scroll CTA', 'type' => 'Text', 'label' => 'Scroll CTA', 'default' => 'Read our story ↓'],
                ['section' => 'About caption title', 'type' => 'Text', 'label' => 'Hero caption title', 'default' => 'On Evergreen Way'],
                ['section' => 'About caption text', 'type' => 'Textarea', 'label' => 'Hero caption', 'default' => 'Open Tue–Sun, 11 AM – 9 PM. Closed Mondays.'],
                ['section' => 'About journey title', 'type' => 'Text', 'label' => 'Story section heading', 'default' => 'Our kitchen story'],
                ['section' => 'About journey lead', 'type' => 'Text', 'label' => 'Story section subtitle', 'default' => 'From the first fold to the plate in front of you.'],
                ['section' => 'About values title', 'type' => 'Text', 'label' => 'Values heading', 'default' => 'What we believe'],
                ['section' => 'About values lead', 'type' => 'Text', 'label' => 'Values subtitle', 'default' => 'The standards behind every momo basket and curry bowl.'],
                ['section' => 'About team title', 'type' => 'Text', 'label' => 'Team heading', 'default' => 'The people in our kitchen'],
                ['section' => 'About team lead', 'type' => 'Text', 'label' => 'Team subtitle', 'default' => 'Chefs, tandoor, and the team that greets you at the door.'],
                ['section' => 'About locate title', 'type' => 'Text', 'label' => 'Location heading', 'default' => 'Visit us in Everett'],
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
