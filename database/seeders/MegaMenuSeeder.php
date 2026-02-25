<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class MegaMenuSeeder extends Seeder
{
    public function run(): void
    {
        // --- Категории (как в меню друзей) ---
        $catSets = Category::updateOrCreate(
            ['slug' => 'sets'],
            ['name' => 'Сеты', 'sort' => 10, 'is_active' => true]
        );

        $catCold = Category::updateOrCreate(
            ['slug' => 'cold-rolls'],
            ['name' => 'Холодные роллы', 'sort' => 30, 'is_active' => true]
        );

        $catBaked = Category::updateOrCreate(
            ['slug' => 'baked-rolls'],
            ['name' => 'Запечённые роллы', 'sort' => 40, 'is_active' => true]
        );

        $catFried = Category::updateOrCreate(
            ['slug' => 'fried-rolls'],
            ['name' => 'Жареные роллы', 'sort' => 50, 'is_active' => true]
        );

        $catClassic = Category::updateOrCreate(
            ['slug' => 'classic-rolls-sushi'],
            ['name' => 'Классические роллы и суши', 'sort' => 60, 'is_active' => true]
        );

        $catFryDishes = Category::updateOrCreate(
            ['slug' => 'fried-dishes'],
            ['name' => 'Блюда во фритюре', 'sort' => 70, 'is_active' => true]
        );

        // --- Хелпер для создания/обновления продукта и привязки к категории ---
        $make = function(array $p, Category $cat, int $sort) {
            $product = Product::updateOrCreate(
                ['slug' => $p['slug']],
                [
                    'type' => $p['type'],
                    'name' => $p['name'],
                    'description' => $p['description'] ?? null,
                    'composition' => $p['composition'] ?? null,
                    'pieces' => $p['pieces'] ?? null,
                    'weight_grams' => $p['weight_grams'] ?? null,
                    'price' => $p['price'],
                    'old_price' => $p['old_price'] ?? null,
                    'is_active' => true,
                ]
            );

            $product->categories()->syncWithoutDetaching([$cat->id => ['sort' => $sort]]);
            return $product;
        };

        // --- РОЛЛЫ (из Мега сета и Сакуры) ---

        $philadelphia = $make([
            'type' => 'roll',
            'name' => 'Филадельфия',
            'slug' => 'philadelphia',
            'composition' => "Рис\nНори\nСыр творожный\nОгурец\nЛосось",
            'price' => 420,
            'old_price' => 580,
        ], $catCold, 10);

        $freshShrimp = $make([
            'type' => 'roll',
            'name' => 'Фрэш ролл с креветкой',
            'slug' => 'fresh-roll-shrimp',
            'composition' => "Рис\nНори\nСыр творожный\nИкра Масаго\nКреветка темпура\nОгурец\nСоус унаги\nЧ/б кунжут",
            'price' => 390,
            'old_price' => 470,
        ], $catCold, 20);

        $californiaCrab = $make([
            'type' => 'roll',
            'name' => 'Калифорния с крабом',
            'slug' => 'california-crab',
            'composition' => "Рис\nНори\nКраб\nМайонез\nОгурец\nПекинская капуста\nИкра Масаго",
            'price' => 390,
            'old_price' => 400, // если не нужно — поставь null
        ], $catCold, 30);

        $kappaMaki = $make([
            'type' => 'roll',
            'name' => 'Каппа маки',
            'slug' => 'kappa-maki',
            'composition' => "Рис\nНори\nОгурец\nЧ/б кунжут",
            'price' => 130,
            'old_price' => 180,
        ], $catClassic, 10);

        $summer = $make([
            'type' => 'roll',
            'name' => 'Лето',
            'slug' => 'summer',
            'composition' => "Рис\nНори\nМасляная рыба\nСыр творожный\nОгурец\nУкроп",
            'price' => 380,
            'old_price' => 450,
        ], $catCold, 40);

        $bakedEel = $make([
            'type' => 'roll',
            'name' => 'Запечённый с угрём',
            'slug' => 'baked-eel',
            'composition' => "Рис\nНори\nТворожный сыр\nУгорь\nКраб\nОгурец\nЯпонский омлет\nМайонез\nЗелёный лук\nСоус унаги",
            'price' => 400,
            'old_price' => 520,
        ], $catBaked, 10);

        $tender = $make([
            'type' => 'roll',
            'name' => 'Нежный',
            'slug' => 'tender',
            'composition' => "Рис\nНори\nЖареный лосось\nТворожный сыр\nПекинская капуста\nСыр пластинка\nСоус унаги",
            'price' => 380,
            'old_price' => 470,
        ], $catBaked, 20);

        $lava = $make([
            'type' => 'roll',
            'name' => 'Лава',
            'slug' => 'lava',
            'composition' => "Рис\nНори\nКреветка\nКраб\nСыр творожный\nСоус спайси",
            'price' => 390,
            'old_price' => null,
        ], $catBaked, 30);

        $hotChicken = $make([
            'type' => 'roll',
            'name' => 'Хот чикен',
            'slug' => 'hot-chicken',
            'composition' => "Рис\nНори\nСыр творожный\nКопчёная куриная грудка\nОгурец\nЧесночный соус",
            'price' => 380,
            'old_price' => 450,
        ], $catBaked, 40);

        $hotBacon = $make([
            'type' => 'roll',
            'name' => 'Хот бекон',
            'slug' => 'hot-bacon',
            'composition' => "Рис\nНори\nБекон\nОмлет\nТворожный сыр\nСоус спайси\nСоус унаги",
            'price' => 380,
            'old_price' => 450,
        ], $catBaked, 50);

        $meat = $make([
            'type' => 'roll',
            'name' => 'Мясной',
            'slug' => 'meat',
            'composition' => "Рис\nНори\nСыр творожный\nКопчёная куриная грудка\nЖареные шампиньоны\nБекон\nПомидор\nКляр\nСухари панко",
            'price' => 380,
            'old_price' => 480,
        ], $catFried, 10);

        $salmonTempura = $make([
            'type' => 'roll',
            'name' => 'Лосось темпура',
            'slug' => 'salmon-tempura',
            'composition' => "Рис\nНори\nСыр творожный\nЛосось\nОгурец\nКляр\nСухари панко",
            'price' => 380,
            'old_price' => 480,
        ], $catFried, 20);

        $unagiTempura = $make([
            'type' => 'roll',
            'name' => 'Унаги темпура',
            'slug' => 'unagi-tempura',
            'composition' => "Рис\nНори\nУгорь жареный\nСыр творожный\nКраб\nИкра масаго\nКляр\nСухари панко\nСоус унаги",
            'price' => 390,
            'old_price' => 500,
        ], $catFried, 30);

        $italy = $make([
            'type' => 'roll',
            'name' => 'Италия',
            'slug' => 'italy',
            'composition' => "Рис\nНори\nСыр моцарелла\nКраб\nПомидор\nПекинская капуста\nКляр\nСухари панко",
            'price' => 370,
            'old_price' => 450,
        ], $catFried, 40);

        $twoCheeseSalmon = $make([
            'type' => 'roll',
            'name' => 'Два сыра и лосось',
            'slug' => 'two-cheese-salmon',
            'composition' => "Рис\nНори\nСыр творожный\nСыр пластинка\nЛосось\nЗелёный лук\nКляр\nСухари панко\nСоус унаги",
            'price' => 390,
            'old_price' => 480,
        ], $catFried, 50);

        $olympian = $make([
            'type' => 'roll',
            'name' => 'Олимпиец',
            'slug' => 'olympian',
            'composition' => "Рис\nНори\nСыр творожный\nТилапия жареная\nПомидор\nСоус спайси\nКляр\nСухари панко",
            'price' => 370,
            'old_price' => 450,
        ], $catFried, 60);

        $boston = $make([
            'type' => 'roll',
            'name' => 'Бостон',
            'slug' => 'boston',
            'composition' => "Рис\nНори\nСыр творожный\nЛосось\nОгурец\nКреветка\nКляр\nСухари",
            'price' => 410,
            'old_price' => 520,
        ], $catFried, 70);

        // --- ЗАКУСКИ (во фритюре) ---
        $shrimpBatter = $make([
            'type' => 'snack',
            'name' => 'Креветки в кляре',
            'slug' => 'shrimp-batter',
            'composition' => "5 тигровых креветок\nКляр\nСухари панко",
            'price' => 290,
            'old_price' => 350,
        ], $catFryDishes, 10);

        $fries = $make([
            'type' => 'snack',
            'name' => 'Картофель фри 150гр',
            'slug' => 'fries-150',
            'composition' => "Картофель фри 150гр",
            'price' => 220,
            'old_price' => 280,
        ], $catFryDishes, 20);

        // --- СЕТ: МЕГА СЕТ ---
        $megaSet = $make([
            'type' => 'set',
            'name' => 'Мега сет',
            'slug' => 'mega-set',
            'description' => "120 кусочков.\nСет рассчитан на 8-10 человек и комплектуется 10-ю порциями имбиря, васаби и 0.5 литра соевого соуса.",
            'composition' => null,
            'pieces' => 120,
            'price' => 3700,
            'old_price' => 5500,
        ], $catSets, 10);

        $megaSet->items()->sync([
            $philadelphia->id     => ['qty' => 1, 'sort' => 10],
            $freshShrimp->id      => ['qty' => 1, 'sort' => 20],
            $californiaCrab->id   => ['qty' => 1, 'sort' => 30],
            $kappaMaki->id        => ['qty' => 1, 'sort' => 40],
            $summer->id           => ['qty' => 1, 'sort' => 50],
            $bakedEel->id         => ['qty' => 1, 'sort' => 60],
            $tender->id           => ['qty' => 1, 'sort' => 70],
            $lava->id             => ['qty' => 1, 'sort' => 80],
            $hotChicken->id       => ['qty' => 1, 'sort' => 90],
            $hotBacon->id         => ['qty' => 1, 'sort' => 100],
            $meat->id             => ['qty' => 1, 'sort' => 110],
            $salmonTempura->id    => ['qty' => 1, 'sort' => 120],
            $unagiTempura->id     => ['qty' => 1, 'sort' => 130],
            $italy->id            => ['qty' => 1, 'sort' => 140],
            $twoCheeseSalmon->id  => ['qty' => 1, 'sort' => 150],
        ]);

        // --- СЕТ: САКУРА ---
        $sakuraSet = $make([
            'type' => 'set',
            'name' => 'Сет Сакура',
            'slug' => 'set-sakura',
            'description' => "40 кусочков.\nСет рассчитан на двоих и комплектуется 2-мя порциями имбиря, васаби и соевого соуса.",
            'composition' => null,
            'pieces' => 40,
            'price' => 1600,
            'old_price' => 2100,
        ], $catSets, 20);

        $sakuraSet->items()->sync([
            $philadelphia->id => ['qty' => 1, 'sort' => 10],
            $bakedEel->id     => ['qty' => 1, 'sort' => 20],
            $tender->id       => ['qty' => 1, 'sort' => 30],
            $olympian->id     => ['qty' => 1, 'sort' => 40],
            $boston->id       => ['qty' => 1, 'sort' => 50],
        ]);

        // --- КАРТИНКИ (записи-пути; файлы можно добавить позже) ---
        $ensureMainImage = function(Product $product, string $path) {
            ProductImage::updateOrCreate(
                ['product_id' => $product->id, 'path' => $path],
                ['is_main' => true, 'sort' => 10, 'alt' => $product->name]
            );
        };

        // Сеты
        $ensureMainImage($megaSet, 'products/sets/mega-set.jpg');
        $ensureMainImage($sakuraSet, 'products/sets/set-sakura.jpg');

        // Роллы (часть примеров; остальные добавишь по аналогии)
        $ensureMainImage($philadelphia, 'products/rolls/philadelphia.jpg');
        $ensureMainImage($freshShrimp, 'products/rolls/fresh-roll-shrimp.jpg');
        $ensureMainImage($californiaCrab, 'products/rolls/california-crab.jpg');
        $ensureMainImage($kappaMaki, 'products/rolls/kappa-maki.jpg');
        $ensureMainImage($summer, 'products/rolls/summer.jpg');
        $ensureMainImage($bakedEel, 'products/rolls/baked-eel.jpg');
        $ensureMainImage($tender, 'products/rolls/tender.jpg');
        $ensureMainImage($lava, 'products/rolls/lava.jpg');
        $ensureMainImage($hotChicken, 'products/rolls/hot-chicken.jpg');
        $ensureMainImage($hotBacon, 'products/rolls/hot-bacon.jpg');
        $ensureMainImage($meat, 'products/rolls/meat.jpg');
        $ensureMainImage($salmonTempura, 'products/rolls/salmon-tempura.jpg');
        $ensureMainImage($unagiTempura, 'products/rolls/unagi-tempura.jpg');
        $ensureMainImage($italy, 'products/rolls/italy.jpg');
        $ensureMainImage($twoCheeseSalmon, 'products/rolls/two-cheese-salmon.jpg');
        $ensureMainImage($olympian, 'products/rolls/olympian.jpg');
        $ensureMainImage($boston, 'products/rolls/boston.jpg');

        // Закуски
        $ensureMainImage($shrimpBatter, 'products/snacks/shrimp-batter.jpg');
        $ensureMainImage($fries, 'products/snacks/fries-150.jpg');
    }
}
