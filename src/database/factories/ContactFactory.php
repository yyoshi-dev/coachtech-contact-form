<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    // 名前を8文字以内に制限する関数
    private function shortName(callable $fakerMethod)
    {
        do {
            $name = $fakerMethod();
        } while (mb_strlen($name) > 8);
        return $name;
    }

    public function definition(): array
    {
        // 性別を定義 (1:男性, 2:女性, 3:その他)
        $gender = $this->faker->numberBetween(1, 3);

        // 問い合わせサンプルを定義
        $categories = [
            1 => ['商品の発送状況について教えてください。', '商品のお届け日時の変更について相談したいです。'],
            2 => ['商品の交換方法について教えてください。', '商品の交換条件について教えてください。'],
            3 => ['注文内容とは別の商品が届きました。', '商品が故障していたので対応して頂きたいです。'],
            4 => ['注文をキャンセルしたいのですが可能でしょうか。', 'サイトのメンテナンス時間を教えてください'],
            5 => ['アカウント情報の変更について教えてください。', 'プロフィールの変更方法について教えてください'],
        ];
        $categoryId = $this->faker->numberBetween(1, 5);

        return [
            'category_id' => $categoryId,
            // 'first_name' => $this->faker->firstName(),
            'first_name' => match ($gender) {
                1 => $this->shortName(fn() => $this->faker->firstNameMale()),
                2 => $this->shortName(fn() => $this->faker->firstNameFemale()),
                3 => $this->shortName(fn() => $this->faker->firstName()),
            },
            'last_name' => $this->shortName(fn() => $this->faker->lastName()),
            'gender' => $gender,
            'email' => $this->faker->safeEmail(),
            'tel' => $this->faker->numerify('0##########'),
            'address' => $this->faker->prefecture() . ' ' . $this->faker->city() . ' ' . $this->faker->streetAddress(),
            'building' => $this->faker->secondaryAddress(),
            'detail' => $this->faker->randomElement($categories[$categoryId]),
        ];
    }
}
