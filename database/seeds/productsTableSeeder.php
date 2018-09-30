<?php

use Illuminate\Database\Seeder;

class productsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\products([
            'imagePath'  => 'https://www.lahuertacafe.com/wp-content/uploads/2017/11/espressoShot-600x426.jpg',
            'title' => 'Espresso',
            'price' => '2.5',
        ]);
        $product->save();

        $product = new \App\products([
            'imagePath'  => 'https://www.cretapost.gr/wp-content/uploads/2017/11/ellhnikos-kafes.jpg',
            'title' => 'Greek Coffee',
            'price' => '2.5',
        ]);
        $product->save();

        $product = new \App\products([
            'imagePath'  => 'http://www.athensmagazine.gr/photos/w_800px/articles/201707/frape.jpg',
            'title' => 'Frape',
            'price' => '2.5',
        ]);
        $product->save();

        $product = new \App\products([
            'imagePath'  => 'https://www.merriam-webster.com/assets/mw/images/article/art-wap-article-main/cappuccino-2029-e80b7c6d318c7862df2c4c8623a11f99@1x.jpg',
            'title' => 'Cappuccino',
            'price' => '2.5',
        ]);
        $product->save();

        $product = new \App\products([
            'imagePath'  => 'https://blue-bottle-cms.global.ssl.fastly.net/hbhhv9rz9/image/upload/v1507567356/v2o2ayxayqloam4tpdhj.jpg',
            'title' => 'Filter',
            'price' => '2.5',
        ]);
        $product->save();

        $product = new \App\products([
            'imagePath'  => 'https://christinascucina.com/wp-content/uploads/2013/12/IMG_3319.jpg',
            'title' => 'Cheese Pie',
            'price' => '2.5',
        ]);
        $product->save();

        $product = new \App\products([
            'imagePath'  => 'https://caruso.gr/wp-content/uploads/2015/04/Tyropita-aromatiki_20150423_0134.jpg',
            'title' => 'Spinach Pie',
            'price' => '2.5',
        ]);
        $product->save();

        $product = new \App\products([
            'imagePath'  => 'http://miltos.com.gr/wp-content/uploads/2017/03/koulouri.jpg',
            'title' => 'Simit',
            'price' => '2.5',
        ]);
        $product->save();

        $product = new \App\products([
            'imagePath'  => 'https://secure.i.telegraph.co.uk/multimedia/archive/02997/Croque_Monsieur_to_2997094b.jpg',
            'title' => 'Toast',
            'price' => '2.5',
        ]);
        $product->save();

        $product = new \App\products([
            'imagePath'  => 'https://akispetretzikis.com/system/uploads/medium/data/6169/recipe_main_akis-petretzikis-keik-fystikovoutyro-me-kommatia-sokolatas.jpg',
            'title' => 'Cake',
            'price' => '2.5',
        ]);
        $product->save();
    }
}
