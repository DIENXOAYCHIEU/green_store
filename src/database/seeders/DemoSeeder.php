<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\Account;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // USERS
        // =========================

        $users = [];

        for ($i = 1; $i <= 10; $i++) {
            $users[] = Account::create([
                'username' => 'user'.$i,
                'phone' => '09000000'.$i,
                'email' => 'user'.$i.'@gmail.com',
                'password' => Hash::make('12345678'),
                'avatar' => 'avatar.png',
                'role_id' => 1,
                'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
            ]);
        }

        DB::table('accounts')->insert([
			[
				'username' => 'test test',
				'phone' => '0123456789',
				'email' => 'example123@gmail.com',
				'password' => Hash::make('12345678'),
				'avatar' => 'avatar.png',
				'role_id' => 1,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'username' => 'admin test test',
				'phone' => '0123456790',
				'email' => 'example123admin@gmail.com',
				'password' => Hash::make('12345678'),
				'avatar' => 'avatar.png',
				'role_id' => 2,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'username' => 'VExample',
				'phone' => '0123456791',
				'email' => 'ngquvi461@gmail.com',
				'password' => Hash::make('12345678'),
				'avatar' => 'avatar.png',
				'role_id' => 2,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],

		]);


        // =========================
        // PRODUCTS
        // =========================

        $productNames = [
            'Ống hút tre',
            'Bàn chải tre',
            'Túi vải canvas',
            'Bình nước inox',
            'Muỗng gỗ',
            'Hộp cơm tre',
            'Ly giấy sinh học',
            'Khăn cotton',
            'Nến thơm thiên nhiên',
            'Ống hút inox',
            'Túi giấy kraft',
            'Đũa tre',
            'Xà phòng hữu cơ',
            'Bàn chải gỗ',
            'Cốc tre',
            'Bọc thực phẩm sáp ong',
            'Tăm tre',
            'Chai thủy tinh',
            'Giỏ mây',
            'Lược gỗ',
        ];

        $products = [];
        for ($i = 1; $i <= 20; $i++) {
            $products[] = Product::create([
                'name' => $productNames[$i - 1],
                'price' => rand(1, 12)*15000,
                'picture' => 'storage/products/'.$i.'.jpg',
                'description' => 'Sản phẩm thân thiện với môi trường',
                'category_id' => 1,
                'inventory_quantity' => rand(10, 100),
                'sold_quantity' => rand(0, 50),
            ]);
        }

        // =========================
        // REVIEWS
        // =========================

        $reviewContents = [
            'Sản phẩm rất tốt',
            'Đóng gói cẩn thận',
            'Chất lượng ổn',
            'Giao hàng nhanh',
            'Rất đáng tiền',
            'Dùng khá thích',
            'Sẽ mua lại',
            'Hài lòng',
            'Chất liệu đẹp',
            'Khá ổn trong tầm giá',
        ];

        // mỗi sản phẩm ít nhất 1 review
        foreach ($products as $product) {

            $randomUser = $users[array_rand($users)];
            Review::create([
                'content' => $reviewContents[array_rand($reviewContents)],
                'product_id' => $product->id,
                'account_id' => $randomUser->id,
            ]);
        }

        // mỗi user review thêm 2 sản phẩm random
        foreach ($users as $user) {
            $randomProducts = collect($products)->random(2);
            foreach ($randomProducts as $product) {
                $alreadyReviewed = Review::where('product_id', $product->id)
                    ->where('account_id', $user->id)
                    ->exists();
                if (!$alreadyReviewed) {
                    Review::create([
                        'content' => $reviewContents[array_rand($reviewContents)],
                        'product_id' => $product->id,
                        'account_id' => $user->id,
                    ]);
                }
            }
        }
    }
}