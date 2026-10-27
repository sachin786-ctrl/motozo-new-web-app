<?php
/**
 * ============================================================================
 * MOTOZO.IN — DISTRICT PAGES CONTENT & DATA CONFIGURATION
 * ============================================================================
 * 
 * Har district page (Delhi, Noida, Greater Noida, Gurgaon, Ghaziabad, Faridabad, etc.)
 * ka content, numbers aur FAQs yahan se customize kar sakte hain.
 * 
 * Layout sabhi pages ka 100% SAME rahega:
 * Header -> Hero (with Quote Form) -> Stats -> FAQ -> Footer
 * ============================================================================
 */

declare(strict_types=1);

if (!function_exists('getDistrictPageData')) {
    function getDistrictPageData(string $slug): array {
        static $catalog = null;
        if ($catalog === null) {
            $catalog = require __DIR__ . '/district_pages_catalog.php';
        }

        $slug = strtolower(trim($slug));

        if (isset($catalog[$slug])) {
            return $catalog[$slug];
        }

        // Smart dynamic auto-fallback for any new district
        $formatted = ucwords(str_replace(['-', '_'], ' ', $slug));
        return [
            'slug'       => $slug,
            'name'       => $formatted,
            'state'      => 'India',
            'meta_title' => "Car Scrap Dealer in {$formatted} — Highest Cash & Free Doorstep Pickup | Motozo",
            'meta_desc'  => "Authorized car scrap dealer in {$formatted}. Instant cash, free doorstep towing and official Govt. RVSF Certificate of Deposit (COD).",
            'hero'       => [
                'pill_icon'   => 'bi bi-shield-check',
                'pill_text'   => "Authorized Scrap Partner &bull; {$formatted}",
                'pill_live'   => false,
                'title_line1' => "Scrap Your Old Vehicle in <span class=\"hero-city-name\">{$formatted}</span>",
                'flip1'       => ['Easier.', 'Smarter.', 'Faster.', 'Greener.'],
                'title_line2' => 'Sell Your Old Vehicle',
                'flip2'       => ['Better.', 'Safer.', 'Instantly.', 'Higher.'],
                'lead'        => "Get the highest certified valuation for your vehicle in <strong>{$formatted}</strong>. Free doorstep pickup &amp; instant payment.",
                'trust'       => [
                    ['icon' => 'bi-truck',          'text' => 'Free<br>Pickup'],
                    ['icon' => 'bi-cash-stack',     'text' => 'Transparent<br>Pricing'],
                    ['icon' => 'bi-currency-rupee', 'text' => 'Instant<br>Payment'],
                ],
            ],
            'quote'      => [
                'badge'    => "{$formatted} Fast Valuation",
                'subtitle' => "Enter vehicle details for instant scrap value in <strong>{$formatted}</strong>.",
            ],
            'benefits'   => [
                'eyebrow'     => "{$formatted} Advantages",
                'title'       => "Financial &amp; Legal Benefits in <span>{$formatted}</span>",
                'sub'         => "Scrapping your vehicle with a registered authorized facility in {$formatted} offers significant monetary, legal, and eco-friendly advantages.",
                'footer_note' => "Scrap valuation depends on vehicle condition, total weight, current metal indexes, and {$formatted} transport policies.",
            ],
            'rules'      => [
                'eyebrow' => "{$formatted} Transport Guidelines",
                'title'   => "Know The Rules. <span>Scrap Legally in {$formatted}.</span>",
                'sub'     => "Stay fully compliant with government transport regulations in {$formatted}, and see why an authorized RVSF is the only safe way to scrap.",
            ],
            'coverage'   => [
                'eyebrow' => "{$formatted} Coverage",
                'badge'   => "All {$formatted} Zones Covered",
                'title'   => "Free Doorstep Towing Across <span class=\"d-cov-city\">{$formatted}</span>",
                'sub'     => "Every colony, basement, and sector in {$formatted} covered with zero towing charges.",
            ],
            'localities' => [
                "{$formatted} Central", "{$formatted} North", "{$formatted} South", "{$formatted} East", "{$formatted} West",
                "{$formatted} Sector 1", "{$formatted} Sector 10", "{$formatted} Industrial Area", "{$formatted} Extension"
            ],
            'stats'      => [
                ['icon' => 'bi-emoji-smile',     'count' => 1250, 'suffix' => '+', 'label' => "Happy Customers in {$formatted}"],
                ['icon' => 'bi-car-front-fill',  'count' => 1850, 'suffix' => '+', 'label' => "Vehicles Scrapped in {$formatted}"],
                ['icon' => 'bi-geo-alt-fill',    'count' => 10,   'suffix' => '+', 'label' => "Locations Covered"],
                ['icon' => 'bi-leaf',            'text_top' => 'Cleaner', 'label' => 'Greener Tomorrow'],
                ['highlight_icon' => 'bi-shield-check', 'highlight_text' => "Govt. Authorized RVSF Partner in {$formatted}."],
            ],
            'faqs'       => [
                [
                    'category' => 'dealers',
                    'q' => "What is an authorised car scrap dealer in {$formatted}?",
                    'a' => "An authorised car scrap dealer in {$formatted} works directly with government-approved Registered Vehicle Scrapping Facilities (RVSF) to ensure vehicles are scrapped legally under MoRTH guidelines.",
                ],
                [
                    'category' => 'documents',
                    'q' => "What documents are required to scrap my vehicle in {$formatted}?",
                    'a' => "You need: 1. Original Registration Certificate (RC), 2. Copy of owner's Aadhaar & PAN card, and 3. Bank account details (cancelled cheque or passbook copy) for instant payment.",
                ],
                [
                    'category' => 'documents',
                    'q' => "Do I get a Certificate of Deposit (COD) in {$formatted}?",
                    'a' => "Yes, Motozo provides the official MoRTH Certificate of Deposit (COD) which can be used to claim up to a 25% road tax rebate when purchasing a new vehicle.",
                ],
                [
                    'category' => 'pickup',
                    'q' => "Is vehicle towing really free in {$formatted}?",
                    'a' => "Yes, doorstep towing and vehicle pickup are 100% free across all areas of {$formatted} with zero deduction from your agreed scrap valuation.",
                ],
                [
                    'category' => 'motozo',
                    'q' => "Why choose Motozo over local scrap vendors in {$formatted}?",
                    'a' => "Local kabadiwalas and roadside yards operate in the unorganized market and cannot provide de-registration or COD certificates. Motozo ensures legal de-registration on VAHAN with zero future liability.",
                ],
            ],
        ];
    }
}

return true;
