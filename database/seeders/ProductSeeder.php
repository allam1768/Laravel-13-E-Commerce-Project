<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::truncate();

        $products = [
            [
                'name' => 'Sambal Roa Asap Khas Manado',
                'slug' => 'sambal-roa-asap-manado',
                'category' => 'Sambal & Lauk',
                'price' => 45000,
                'discount_price' => 38000,
                'weight' => '150 gr',
                'description' => 'Sambal khas Manado dengan suwiran ikan roa asap pilihan yang melimpah. Dimasak secara tradisional dengan cabai rawit segar dan rempah alami, menghasilkan aroma smoky yang khas dan rasa gurih pedas yang nagih.',
                'ingredients' => 'Ikan Roa Asap, Cabai Rawit Merah, Bawang Merah, Bawang Putih, Minyak Nabati, Garam, Rempah Pilihan.',
                'badge' => 'Terlaris 🔥',
                'rating' => 4.9,
                'reviews_count' => 142,
                'image_url' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=700&auto=format&fit=crop&q=80',
                'is_available' => true,
                'stock' => 35,
            ],
            [
                'name' => 'Kopi Arabika Gayo Single Origin',
                'slug' => 'kopi-arabika-gayo-single-origin',
                'category' => 'Kopi & Minuman',
                'price' => 75000,
                'discount_price' => null,
                'weight' => '250 gr',
                'description' => 'Biji kopi Arabika asli Dataran Tinggi Gayo, Aceh (ketinggian 1.400 mdpl). Disangrai profil Medium Roast dengan citarasa fruity, aroma floral yang semerbak, dan tingkat keasaman yang seimbang nan lembut di lambung.',
                'ingredients' => '100% Biji Kopi Arabika Gayo Murni (Tersedia Biji / Bubuk Halus / Medium).',
                'badge' => 'Pilihan Barista ⭐',
                'rating' => 5.0,
                'reviews_count' => 98,
                'image_url' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=700&auto=format&fit=crop&q=80',
                'is_available' => true,
                'stock' => 50,
            ],
            [
                'name' => 'Keripik Tempe Oven Daun Jeruk',
                'slug' => 'keripik-tempe-oven-daun-jeruk',
                'category' => 'Camilan & Snack',
                'price' => 25000,
                'discount_price' => 22000,
                'weight' => '200 gr',
                'description' => 'Keripik tempe kedelai lokal non-GMO yang diiris tipis renyah, dipanggang dengan baluran bumbu bawang putih dan irisan daun jeruk segar. Gurih, renyah, dan tidak berminyak di tenggorokan.',
                'ingredients' => 'Kedelai Lokal Pilihan, Tepung Beras, Daun Jeruk Segar, Bawang Putih, Ketumbar, Minyak Kelapa.',
                'badge' => 'Favorit Cemilan 🍃',
                'rating' => 4.8,
                'reviews_count' => 76,
                'image_url' => 'https://images.unsplash.com/photo-1599488615731-7e5c2823ff28?w=700&auto=format&fit=crop&q=80',
                'is_available' => true,
                'stock' => 80,
            ],
            [
                'name' => 'Madu Hutan Akasia Murni Riau',
                'slug' => 'madu-hutan-akasia-murni-riau',
                'category' => 'Madu & Herbal',
                'price' => 98000,
                'discount_price' => 85000,
                'weight' => '350 ml',
                'description' => 'Madu mentah (raw honey) murni hasil panen lebah Apis Mellifera dari nektar bunga pohon Akasia hutan tropis Riau. Tanpa campuran gula, tanpa proses pemanasan, kaya akan enzim dan antioksidan alami.',
                'ingredients' => '100% Madu Hutan Nektar Akasia Murni.',
                'badge' => '100% Organik 🍯',
                'rating' => 4.9,
                'reviews_count' => 110,
                'image_url' => 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?w=700&auto=format&fit=crop&q=80',
                'is_available' => true,
                'stock' => 24,
            ],
            [
                'name' => 'Abon Cakalang Asap Bumbu Rempah',
                'slug' => 'abon-cakalang-asap-bumbu-rempah',
                'category' => 'Sambal & Lauk',
                'price' => 42000,
                'discount_price' => null,
                'weight' => '150 gr',
                'description' => 'Abon dari daging ikan cakalang laut segar yang diasap terlebih dahulu sebelum disuwir halus dan disangrai bersama santan kelapa kental serta rempah-rempah tradisional khas pesisir.',
                'ingredients' => 'Daging Ikan Cakalang Asap, Santan Kelapa, Bawang Merah, Bawang Putih, Lengkuas, Serai, Daun Salam.',
                'badge' => 'Tinggi Protein 💪',
                'rating' => 4.8,
                'reviews_count' => 64,
                'image_url' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=700&auto=format&fit=crop&q=80',
                'is_available' => true,
                'stock' => 40,
            ],
            [
                'name' => 'Wedang Uwuh Rempah Komplit',
                'slug' => 'wedang-uwuh-rempah-komplit',
                'category' => 'Madu & Herbal',
                'price' => 32000,
                'discount_price' => 28000,
                'weight' => '10 Porsi',
                'description' => 'Minuman herbal khas Imogiri Yogyakarta dalam kemasan higienis praktis. Mengandung serutan kayu secang, jahe emprit kering, cengkeh, kayu manis, pala, dan gula batu kristal. Menghangatkan dan menyegarkan tubuh.',
                'ingredients' => 'Kayu Secang, Jahe Kering, Kayu Manis, Kapulaga, Cengkeh, Daun Pala, Gula Batu.',
                'badge' => 'Hangat & Sehat 🫖',
                'rating' => 4.9,
                'reviews_count' => 89,
                'image_url' => 'https://images.unsplash.com/photo-1576092768241-dec231879fc3?w=700&auto=format&fit=crop&q=80',
                'is_available' => true,
                'stock' => 60,
            ],
            [
                'name' => 'Keripik Pisang Lumer Cokelat Premium',
                'slug' => 'keripik-pisang-lumer-cokelat-premium',
                'category' => 'Camilan & Snack',
                'price' => 28000,
                'discount_price' => 24000,
                'weight' => '180 gr',
                'description' => 'Keripik pisang kepok pilihan khas Lampung yang dipotong tipis krispi lalu disiram cokelat lumer premium yang manisnya pas dan tidak enek. Sensasi crunchy berpadu lelehan cokelat yang melimpah.',
                'ingredients' => 'Pisang Kepok Kuning, Dark Chocolate Couverture, Minyak Kelapa, Gula Tebu Alami.',
                'badge' => 'Viral TikTok ✨',
                'rating' => 4.9,
                'reviews_count' => 215,
                'image_url' => 'https://images.unsplash.com/photo-1579954115545-a95591f28bfc?w=700&auto=format&fit=crop&q=80',
                'is_available' => true,
                'stock' => 95,
            ],
            [
                'name' => 'Kopi Robusta Dampit Malang Dark Roast',
                'slug' => 'kopi-robusta-dampit-malang',
                'category' => 'Kopi & Minuman',
                'price' => 48000,
                'discount_price' => null,
                'weight' => '250 gr',
                'description' => 'Kopi Robusta legendaris dari perkebunan lereng Gunung Semeru Dampit Malang. Body yang tebal, rasa cokelat karamel pekat dengan aftertaste manis yang tahan lama, sangat cocok untuk kopi susu atau es kopi kekinian.',
                'ingredients' => '100% Kopi Robusta Dampit Fine Grade.',
                'badge' => 'Cocok Buat Es Kopi ☕',
                'rating' => 4.7,
                'reviews_count' => 53,
                'image_url' => 'https://images.unsplash.com/photo-1498804103079-a6351b050096?w=700&auto=format&fit=crop&q=80',
                'is_available' => true,
                'stock' => 45,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
