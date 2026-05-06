<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Restaurant;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $restaurantIds = [
            'Mizumi Atelier' => Restaurant::where('name', 'Mizumi Atelier')->first()->id,
            'Pasta & Petals' => Restaurant::where('name', 'Pasta & Petals')->first()->id,
            'Flora Kitchen' => Restaurant::where('name', 'Flora Kitchen')->first()->id,
            'Citra Bakery' => Restaurant::where('name', 'Citra Bakery')->first()->id,
            'Bistro de Citra' => Restaurant::where('name', 'Bistro de Citra')->first()->id,
            'Sushi Zen Surabaya' => Restaurant::where('name', 'Sushi Zen Surabaya')->first()->id,
            'Toscana Grill Citraland' => Restaurant::where('name', 'Toscana Grill Citraland')->first()->id,
            'Green Leaf Surabaya' => Restaurant::where('name', 'Green Leaf Surabaya')->first()->id,
        ];

        $menuGroups = [
            'Mizumi Atelier' => [
                ['name' => 'Omakase Set', 'description' => 'Chef-selected premium sushi tasting menu.', 'price' => 48.00, 'rating' => 4.9],
                ['name' => 'Salmon Nigiri', 'description' => 'Fresh salmon over seasoned rice.', 'price' => 14.00, 'rating' => 4.7],
                ['name' => 'Tuna Sashimi', 'description' => 'Thinly sliced fresh bluefin tuna.', 'price' => 18.00, 'rating' => 4.8],
                ['name' => 'Tempura Moriawase', 'description' => 'Assorted crispy fried shrimp and vegetables.', 'price' => 16.00, 'rating' => 4.6],
                ['name' => 'Miso Glazed Black Cod', 'description' => 'Buttery cod marinated in sweet miso.', 'price' => 32.00, 'rating' => 4.9],
                ['name' => 'Dragon Roll', 'description' => 'Eel and cucumber topped with avocado.', 'price' => 15.00, 'rating' => 4.5],
                ['name' => 'Beef Tataki', 'description' => 'Lightly seared beef with ponzu sauce.', 'price' => 19.00, 'rating' => 4.7],
                ['name' => 'Matcha Cheesecake', 'description' => 'Creamy cheesecake with premium green tea.', 'price' => 9.00, 'rating' => 4.4],
                ['name' => 'Chicken Teriyaki', 'description' => 'Grilled chicken with sweet soy glaze.', 'price' => 14.00, 'rating' => 4.3],
                ['name' => 'Edamame', 'description' => 'Steamed soybeans with sea salt.', 'price' => 6.00, 'rating' => 4.2],
                ['name' => 'Gyoza', 'description' => 'Pan-seared Japanese dumplings.', 'price' => 12.00, 'rating' => 4.5],
                ['name' => 'Unagi Kabayaki', 'description' => 'Grilled eel with kabayaki sauce.', 'price' => 28.00, 'rating' => 4.8],
            ],
            'Pasta & Petals' => [
                ['name' => 'Truffle Alfredo', 'description' => 'Creamy pasta with black truffle essence.', 'price' => 28.00, 'rating' => 4.8],
                ['name' => 'Classic Carbonara', 'description' => 'Traditional Roman pasta with parmesan and egg.', 'price' => 22.00, 'rating' => 4.6],
                ['name' => 'Margherita Pizza', 'description' => 'Fresh basil, mozzarella, and tomato sauce.', 'price' => 18.00, 'rating' => 4.7],
                ['name' => 'Seafood Risotto', 'description' => 'Creamy rice with shrimp, mussels, and clams.', 'price' => 26.00, 'rating' => 4.9],
                ['name' => 'Lasagna Bolognese', 'description' => 'Layered pasta with rich meat sauce.', 'price' => 20.00, 'rating' => 4.5],
                ['name' => 'Gnocchi Sorrento', 'description' => 'Potato dumplings with tomato and buffalo mozzarella.', 'price' => 19.00, 'rating' => 4.6],
                ['name' => 'Bruschetta Trio', 'description' => 'Toasted bread with varied Mediterranean toppings.', 'price' => 12.00, 'rating' => 4.4],
                ['name' => 'Tiramisu', 'description' => 'Coffee-soaked ladyfingers with mascarpone.', 'price' => 10.00, 'rating' => 4.8],
                ['name' => 'Panna Cotta', 'description' => 'Silky vanilla cream with berry coulis.', 'price' => 9.00, 'rating' => 4.5],
                ['name' => 'Aglio e Olio', 'description' => 'Simple pasta with garlic, oil, and chili.', 'price' => 16.00, 'rating' => 4.3],
                ['name' => 'Fettuccine Salmon', 'description' => 'Creamy salmon pasta with dill.', 'price' => 25.00, 'rating' => 4.7],
                ['name' => 'Gelato Italiano', 'description' => 'Authentic Italian ice cream.', 'price' => 8.00, 'rating' => 4.6],
            ],
            'Flora Kitchen' => [
                ['name' => 'Green Bowl', 'description' => 'Healthy bowl with avocado, quinoa, and greens.', 'price' => 18.00, 'rating' => 4.5],
                ['name' => 'Vegan Lasagna', 'description' => 'Layered vegan lasagna with cashew cheese.', 'price' => 24.00, 'rating' => 4.7],
                ['name' => 'Tempeh Buddha Bowl', 'description' => 'Roasted tempeh with kale and tahini dressing.', 'price' => 16.00, 'rating' => 4.6],
                ['name' => 'Mushroom Risotto', 'description' => 'Creamy arborio rice with wild mushrooms.', 'price' => 20.00, 'rating' => 4.8],
                ['name' => 'Zucchini Noodles', 'description' => 'Fresh zoodles with basil pesto and pine nuts.', 'price' => 15.00, 'rating' => 4.4],
                ['name' => 'Chickpea Curry', 'description' => 'Spiced curry with coconut milk and spinach.', 'price' => 17.00, 'rating' => 4.7],
                ['name' => 'Raw Cacao Tart', 'description' => 'Guilt-free chocolate dessert with almond crust.', 'price' => 11.00, 'rating' => 4.9],
                ['name' => 'Acai Superfood Bowl', 'description' => 'Acai blend topped with granola and fresh fruits.', 'price' => 14.00, 'rating' => 4.5],
                ['name' => 'Falafel Wrap', 'description' => 'Crispy falafel with hummus and pickled veggies.', 'price' => 13.00, 'rating' => 4.3],
                ['name' => 'Sweet Potato Fries', 'description' => 'Oven-baked fries with vegan spicy mayo.', 'price' => 8.00, 'rating' => 4.2],
                ['name' => 'Lentil Soup', 'description' => 'Hearty red lentil soup with turmeric.', 'price' => 10.00, 'rating' => 4.4],
                ['name' => 'Avocado Toast', 'description' => 'Sourdough bread with smashed avocado.', 'price' => 12.00, 'rating' => 4.6],
            ],
            'Citra Bakery' => [
                ['name' => 'Croissant Supreme', 'description' => 'Flaky buttery layers with almond filling.', 'price' => 5.00, 'rating' => 4.8],
                ['name' => 'Pain au Chocolat', 'description' => 'Classic French chocolate pastry.', 'price' => 6.00, 'rating' => 4.7],
                ['name' => 'Sourdough Loaf', 'description' => 'Crusty artisan bread with a perfect tang.', 'price' => 8.00, 'rating' => 4.9],
                ['name' => 'Red Velvet Cupcake', 'description' => 'Moist cake with cream cheese frosting.', 'price' => 4.00, 'rating' => 4.6],
                ['name' => 'Blueberry Muffin', 'description' => 'Soft muffin packed with fresh berries.', 'price' => 4.50, 'rating' => 4.4],
                ['name' => 'Cinnamon Roll', 'description' => 'Sticky and sweet with vanilla glaze.', 'price' => 5.50, 'rating' => 4.7],
                ['name' => 'Apple Galette', 'description' => 'Rustic tart with caramelized cinnamon apples.', 'price' => 7.00, 'rating' => 4.5],
                ['name' => 'Cheese Danish', 'description' => 'Pastry filled with sweet cream cheese.', 'price' => 5.00, 'rating' => 4.3],
                ['name' => 'Baguette Tradition', 'description' => 'Hand-rolled traditional French baguette.', 'price' => 4.00, 'rating' => 4.8],
                ['name' => 'Fruit Tartlet', 'description' => 'Shortbread crust with custard and seasonal fruit.', 'price' => 6.50, 'rating' => 4.6],
                ['name' => 'Choco Chip Cookie', 'description' => 'Large chewy cookie with dark chocolate.', 'price' => 3.00, 'rating' => 4.5],
                ['name' => 'Lemon Pound Cake', 'description' => 'Zesty cake with lemon glaze.', 'price' => 15.00, 'rating' => 4.4],
            ],
            'Bistro de Citra' => [
                ['name' => 'Duck Confit', 'description' => 'Slow-cooked duck leg with crispy skin.', 'price' => 34.00, 'rating' => 4.9],
                ['name' => 'Coq au Vin', 'description' => 'Chicken braised in red wine and mushrooms.', 'price' => 28.00, 'rating' => 4.8],
                ['name' => 'French Onion Soup', 'description' => 'Rich broth with caramelized onions and gruyere.', 'price' => 14.00, 'rating' => 4.7],
                ['name' => 'Steak Frites', 'description' => 'Grilled sirloin with garlic butter and thin fries.', 'price' => 38.00, 'rating' => 4.9],
                ['name' => 'Ratatouille', 'description' => 'Classic Provencal stewed vegetables.', 'price' => 19.00, 'rating' => 4.5],
                ['name' => 'Bouillabaisse', 'description' => 'Traditional Provençal fish stew.', 'price' => 36.00, 'rating' => 4.8],
                ['name' => 'Escargots de Bourgogne', 'description' => 'Snails in garlic and parsley butter.', 'price' => 16.00, 'rating' => 4.6],
                ['name' => 'Creme Brulee', 'description' => 'Rich custard with a brittle caramel top.', 'price' => 12.00, 'rating' => 4.9],
                ['name' => 'Profiteroles', 'description' => 'Choux pastry filled with vanilla ice cream.', 'price' => 11.00, 'rating' => 4.7],
                ['name' => 'Salade Niçoise', 'description' => 'Tuna, olives, and egg on fresh greens.', 'price' => 18.00, 'rating' => 4.4],
                ['name' => 'Crepes Suzette', 'description' => 'Crepes with orange butter sauce.', 'price' => 14.00, 'rating' => 4.6],
                ['name' => 'Foie Gras', 'description' => 'Pan-seared foie gras with fig jam.', 'price' => 45.00, 'rating' => 4.8],
            ],
        ];

        foreach ($menuGroups as $resName => $items) {
            if (isset($restaurantIds[$resName])) {
                foreach ($items as $item) {
                    $item['restaurant_id'] = $restaurantIds[$resName];
                    $item['image'] = null;
                    Menu::create($item);
                }
            }
        }

        // Fill remaining restaurants with generic but themed menus
        foreach (['Sushi Zen Surabaya', 'Toscana Grill Citraland', 'Green Leaf Surabaya'] as $resName) {
            if (!isset($restaurantIds[$resName])) continue;
            for ($i = 1; $i <= 12; $i++) {
                Menu::create([
                    'restaurant_id' => $restaurantIds[$resName],
                    'name' => $resName . " Signature " . $i,
                    'description' => "Experience the unique flavors of our chef's special " . $i . " from " . $resName,
                    'price' => rand(15, 65),
                    'rating' => rand(42, 50) / 10,
                    'image' => null,
                ]);
            }
        }
    }
}
