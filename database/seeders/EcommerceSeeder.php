<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EcommerceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Users
        User::firstOrCreate(
            ['email' => 'admin@ecommerce.test'],
            [
                'name' => 'Allam Admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'customer@ecommerce.test'],
            [
                'name' => 'John Customer',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Categories
        $categoriesData = [
            ['name' => 'Living Room', 'image' => 'uploads/categories/1.jpg', 'is_popular' => true],
            ['name' => 'Bedroom', 'image' => 'uploads/categories/2.jpg', 'is_popular' => true],
            ['name' => 'Dining & Kitchen', 'image' => 'uploads/categories/3.jpg', 'is_popular' => true],
            ['name' => 'Office Furniture', 'image' => 'uploads/categories/4.jpg', 'is_popular' => true],
            ['name' => 'Home Lighting', 'image' => 'uploads/categories/5.jpg', 'is_popular' => true],
            ['name' => 'Decor & Accents', 'image' => 'uploads/categories/6.jpg', 'is_popular' => false],
        ];

        $categories = [];
        foreach ($categoriesData as $c) {
            $categories[] = Category::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name' => $c['name'],
                    'image' => $c['image'],
                    'is_popular' => $c['is_popular'],
                ]
            );
        }

        // 3. Brands
        $brandsData = [
            ['name' => 'Nordic Living', 'image' => 'uploads/brands/1.png'],
            ['name' => 'Minimalist Co', 'image' => 'uploads/brands/2.png'],
            ['name' => 'Urban Craft', 'image' => 'uploads/brands/3.png'],
            ['name' => 'Comfort Craft', 'image' => 'uploads/brands/4.png'],
            ['name' => 'Modern Studio', 'image' => 'uploads/brands/5.png'],
        ];

        $brands = [];
        foreach ($brandsData as $b) {
            $brands[] = Brand::updateOrCreate(
                ['slug' => Str::slug($b['name'])],
                [
                    'name' => $b['name'],
                    'image' => $b['image'],
                ]
            );
        }

        // 4. Slides
        $slidesData = [
            [
                'tag' => 'SUMMER COLLECTION 2026',
                'title' => 'Minimalist Modern Furniture',
                'subtitle' => 'Upgrade your space with timeless ergonomics and natural finishes.',
                'link' => '/shop',
                'image' => 'uploads/slides/1745774614.png',
                'status' => true,
            ],
            [
                'tag' => 'HOT DEALS THIS WEEK',
                'title' => 'Premium Ergonomic Desks',
                'subtitle' => 'Engineered for focus, built to last with sustainable solid teak.',
                'link' => '/shop',
                'image' => 'uploads/slides/1746348368.png',
                'status' => true,
            ],
            [
                'tag' => 'BEST VALUE',
                'title' => 'Living Room Essentials',
                'subtitle' => 'Modular seating solutions designed for compact urban apartments.',
                'link' => '/shop',
                'image' => 'uploads/slides/1746348400.png',
                'status' => true,
            ],
        ];

        foreach ($slidesData as $s) {
            Slide::updateOrCreate(
                ['title' => $s['title']],
                $s
            );
        }

        // 5. Products
        $productsData = [
            [
                'name' => 'Scandinavian Accent Lounge Chair',
                'short_description' => 'Solid oak frame with high-density foam cushion in charcoal wool.',
                'description' => 'The Scandinavian Accent Lounge Chair blends natural wood warmth with plush ergonomic support. Crafted from kiln-dried solid oak, this armchair is tested for over 10 years of daily use. Perfect for reading nooks, modern living rooms, or creative studio spaces.',
                'regular_price' => 2490000,
                'sale_price' => 1990000,
                'featured' => true,
                'image' => 'assets/images/product/product-01.jpg',
                'cat_index' => 0,
                'brand_index' => 0,
            ],
            [
                'name' => 'Minimalist Matte Ceramic Table Lamp',
                'short_description' => 'Warm 2700K ambient illumination with dimmable touch base.',
                'description' => 'Hand-spun ceramic base paired with an unbleached linen drum shade. Emits soft, glare-free light suitable for bedside tables or credenzas.',
                'regular_price' => 750000,
                'sale_price' => 620000,
                'featured' => true,
                'image' => 'assets/images/product/product-02.jpg',
                'cat_index' => 4,
                'brand_index' => 1,
            ],
            [
                'name' => 'Mid-Century Teak Coffee Table',
                'short_description' => 'Curved silhouette with lower slatted shelf for magazines and trays.',
                'description' => 'A statement centerpiece featuring tapered dowel legs and smooth beveled edges. Water-resistant matte polyurethane finish protects against everyday spills.',
                'regular_price' => 1850000,
                'sale_price' => null,
                'featured' => true,
                'image' => 'assets/images/product/product-03.jpg',
                'cat_index' => 0,
                'brand_index' => 2,
            ],
            [
                'name' => 'Ergonomic Mesh Swivel Task Chair',
                'short_description' => 'Adaptive lumbar support, 3D armrests, and breathable mesh back.',
                'description' => 'Designed for prolonged 8+ hour work sessions. Class 4 gas lift with smooth-rolling polyurethane casters safe for all hardwood floors.',
                'regular_price' => 3200000,
                'sale_price' => 2850000,
                'featured' => true,
                'image' => 'assets/images/product/product-04.jpg',
                'cat_index' => 3,
                'brand_index' => 3,
            ],
            [
                'name' => 'Solid Oak 6-Seater Dining Table',
                'short_description' => 'Robust dining surface with chamfered profile and steel bracket joints.',
                'description' => 'Spacious table ready to host intimate family dinners or lively weekend gatherings. Coated with organic hardwax oil.',
                'regular_price' => 5400000,
                'sale_price' => 4890000,
                'featured' => false,
                'image' => 'assets/images/product/product-05.jpg',
                'cat_index' => 2,
                'brand_index' => 0,
            ],
            [
                'name' => 'Floating Headboard Queen Bed Frame',
                'short_description' => 'Sturdy pine slat system with integrated cable pass-throughs.',
                'description' => 'Minimalist low-profile platform bed frame. Does not require a box spring; engineered for zero creaking and squeaking.',
                'regular_price' => 4200000,
                'sale_price' => null,
                'featured' => true,
                'image' => 'assets/images/product/product-06.jpg',
                'cat_index' => 1,
                'brand_index' => 4,
            ],
            [
                'name' => 'Handwoven Jute Textured Area Rug',
                'short_description' => '100% natural biodegradable fiber with stitched non-fray borders.',
                'description' => 'Adds earthy texture and organic warmth to open-concept spaces. Durable enough for high-traffic entryways and dining areas.',
                'regular_price' => 890000,
                'sale_price' => 750000,
                'featured' => false,
                'image' => 'assets/images/product/product-07.jpg',
                'cat_index' => 5,
                'brand_index' => 2,
            ],
            [
                'name' => 'Industrial Matte Black Bookshelf',
                'short_description' => '5-tier open shelving unit with powder-coated steel crossbeams.',
                'description' => 'Generous clearance between shelves accommodates large art books, vinyl records, and indoor greenery. Wall anchoring hardware included.',
                'regular_price' => 1650000,
                'sale_price' => 1400000,
                'featured' => false,
                'image' => 'assets/images/product/product-08.jpg',
                'cat_index' => 3,
                'brand_index' => 1,
            ],
            [
                'name' => 'Velvet Tufted Ottoman Footstool',
                'short_description' => 'High-resilience foam wrapped in stain-resistant performance velvet.',
                'description' => 'Versatile multi-use piece functioning as extra guest seating, a comfortable footrest, or a tray table.',
                'regular_price' => 620000,
                'sale_price' => null,
                'featured' => false,
                'image' => 'assets/images/product/product-09.jpg',
                'cat_index' => 0,
                'brand_index' => 4,
            ],
            [
                'name' => 'Architectural Brass Pendant Light',
                'short_description' => 'Brushed spun brass canopy with braided fabric suspension cord.',
                'description' => 'Striking pendant light that casts downward focused spotlighting. Pairs elegantly over kitchen islands or conference tables.',
                'regular_price' => 980000,
                'sale_price' => 850000,
                'featured' => false,
                'image' => 'assets/images/product/product-10.jpg',
                'cat_index' => 4,
                'brand_index' => 1,
            ],
            [
                'name' => 'Modular 3-Piece Sectional Sofa',
                'short_description' => 'Deep seats, down-blend cushions, and removable machine-washable covers.',
                'description' => 'The ultimate cloud comfort couch. Configurable in left-facing, right-facing, or separated armchair setups.',
                'regular_price' => 8900000,
                'sale_price' => 7900000,
                'featured' => true,
                'image' => 'assets/images/product/product-11.jpg',
                'cat_index' => 0,
                'brand_index' => 0,
            ],
            [
                'name' => 'Bedside Teak Nightstand with Drawer',
                'short_description' => 'Soft-close undermount drawer slides with open display cubby.',
                'description' => 'Compact silhouette with generous concealed storage for chargers, books, and essentials. Solid joinery throughout.',
                'regular_price' => 950000,
                'sale_price' => 820000,
                'featured' => false,
                'image' => 'assets/images/product/product-12.jpg',
                'cat_index' => 1,
                'brand_index' => 2,
            ],
            [
                'name' => 'Ceramic Glazed Artisan Dinnerware Set',
                'short_description' => '16-piece set of plates, bowls, and mugs. Microwave & dishwasher safe.',
                'description' => 'Durable stoneware fired at high temperatures with unique reactive glaze variations. Made for daily dining and special occasions.',
                'regular_price' => 1250000,
                'sale_price' => 1100000,
                'featured' => false,
                'image' => 'assets/images/product/product-13.jpg',
                'cat_index' => 2,
                'brand_index' => 3,
            ],
        ];

        foreach ($productsData as $i => $p) {
            Product::updateOrCreate(
                ['slug' => Str::slug($p['name'])],
                [
                    'name' => $p['name'],
                    'short_description' => $p['short_description'],
                    'description' => $p['description'],
                    'regular_price' => $p['regular_price'],
                    'sale_price' => $p['sale_price'],
                    'SKU' => 'SKU-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                    'stock_status' => 'instock',
                    'featured' => $p['featured'],
                    'quantity' => 25,
                    'image' => $p['image'],
                    'images' => $p['image'],
                    'category_id' => $categories[$p['cat_index']]->id,
                    'brand_id' => $brands[$p['brand_index']]->id,
                ]
            );
        }
    }
}
