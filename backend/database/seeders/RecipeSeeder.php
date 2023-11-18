<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function createRecipe($recipe, $ingredients, $tags): void
    {
        $recipe_id = DB::table('recipes')->insertGetId($recipe);

        foreach ($ingredients as $ingredient) {
            $ingredient_id = Ingredient::firstOrCreate($ingredient)->id;

            DB::table('recipes_ingredients')->insert([
                'recipe_id' => $recipe_id,
                'ingredient_id' => $ingredient_id,
            ]);
        }

        foreach ($tags as $tag) {
            $tag_id = Tag::firstOrCreate($tag)->id;

            DB::table('recipes_tags')->insert([
                'recipe_id' => $recipe_id,
                'tag_id' => $tag_id,
            ]);
        }
    }

    public function run(): void
    {
        $current_recipe = [
            'name' => 'Harissa chicken on quinoa with green olives',
            'headline' => 'This dish produces 50% less CO2e from ingredients than an average HelloFresh recipe',
            'preptime' => 'PT25M',
            'instructions' => 'Create a flavorful Harissa Chicken on Quinoa with Green Olives by marinating and searing the chicken. Cook quinoa separately, mix with green olives, and plate the dish for a visually appealing meal.',
            'image' => 'https://img.hellofresh.com/q_auto/recipes/image/HF_Y23_R37_W44_DE_R4819-1_Main_low-661e95c9.jpg',
            'calories' => 606,
            'carbs' => 52.54,
            'fat' => 30,
            'protein' => 38.4,
            'sugar' => 5.6,
            'sustainability_rating' => 0.85,

        ];

        $ingredients = [[
            'name' => 'Chicken Breast',
            'is_vegan' => false,
            'is_vegetarian' => false,
        ], [
            'name' => 'Quinoa',
            'is_vegan' => true,
            'is_vegetarian' => true,
        ], [
            'name' => 'Green Olives',
            'is_vegan' => true,
            'is_vegetarian' => true,
        ], [
            'name' => 'Harissa Spice Blend',
            'is_vegan' => true,
            'is_vegetarian' => true,
        ], [
            'name' => 'Garlic',
            'is_vegan' => true,
            'is_vegetarian' => true,
        ], [
            'name' => 'Lemon',
            'is_vegan' => true,
            'is_vegetarian' => true,
        ], [
            'name' => 'Sour Cream',
            'is_vegan' => false,
            'is_vegetarian' => true,
        ], [
            'name' => 'Olive Oil',
            'is_vegan' => true,
            'is_vegetarian' => true,
        ], [
            'name' => 'Salt',
            'is_vegan' => true,
            'is_vegetarian' => true,
        ], [
            'name' => 'Pepper',
            'is_vegan' => true,
            'is_vegetarian' => true,
        ], [
            'name' => 'Water',
            'is_vegan' => true,
            'is_vegetarian' => true,
        ], [
            'name' => 'Sugar',
            'is_vegan' => true,
            'is_vegetarian' => true,
        ], [
            'name' => 'Vegetable Stock Concentrate',
            'is_vegan' => true,
            'is_vegetarian' => true,
        ], [
            'name' => 'Butter',
            'is_vegan' => false,
            'is_vegetarian' => true,
        ]];

        $tags = [['name' => 'Low Calorie'],
            ['name' => 'High Protein']];
        $this->createRecipe($current_recipe, $ingredients, $tags);
        $this->createRecipe(['name' => 'Grilled Salmon with Lemon Dill Sauce', 'headline' => 'A zesty and flavorful salmon dish', 'preptime' => 'PT30M', 'instructions' => 'Grill salmon fillets and top with a tangy lemon dill sauce.', 'image' => 'https://img.hellofresh.com/c_fit,f_auto,fl_lossy,h_1100,q_30,w_2600/hellofresh_s3/image/65235c856c96c01e5b4700ed-a5457b80.jpeg', 'calories' => 450, 'carbs' => 12.8, 'fat' => 28, 'protein' => 36.5, 'sugar' => 2.5, 'sustainability_rating' => 0.75], [['name' => 'Salmon', 'is_vegan' => false, 'is_vegetarian' => false], ['name' => 'Lemon', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Dill', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Olive Oil', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Salt', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Pepper', 'is_vegan' => true, 'is_vegetarian' => true]], [['name' => 'Low Carb'], ['name' => 'High Protein']]);
        $this->createRecipe(['name' => 'Vegetarian Lentil Stew', 'headline' => 'A hearty and nutritious plant-based stew', 'preptime' => 'PT40M', 'instructions' => 'Simmer lentils, vegetables, and spices to create a delicious and filling vegetarian stew.', 'image' => 'https://img.hellofresh.com/c_fit,f_auto,fl_lossy,h_1100,q_30,w_2600/hellofresh_s3/image/64e2c08edd7d57f2ca82c08c-2bbec2cc.jpeg', 'calories' => 320, 'carbs' => 58.2, 'fat' => 1.8, 'protein' => 18.5, 'sugar' => 6.4, 'sustainability_rating' => 0.90], [['name' => 'Lentils', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Carrots', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Tomatoes', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Onion', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Garlic', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Vegetable Broth', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Cumin', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Paprika', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Bay Leaves', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Salt', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Pepper', 'is_vegan' => true, 'is_vegetarian' => true]], [['name' => 'Vegetarian'], ['name' => 'High Fiber']]);
        $this->createRecipe(['name' => 'Spaghetti Bolognese', 'headline' => 'Classic Italian pasta dish with a rich meat sauce', 'preptime' => 'PT35M', 'instructions' => 'Prepare a savory meat sauce with tomatoes, ground beef, and herbs. Serve over cooked spaghetti.', 'image' => 'https://img.hellofresh.com/c_fit,f_auto,fl_lossy,h_1100,q_30,w_2600/hellofresh_s3/image/klassische-pasta-bolognese-mit-rinderhack-bbacf739.jpg', 'calories' => 580, 'carbs' => 75.5, 'fat' => 22, 'protein' => 26, 'sugar' => 9.2, 'sustainability_rating' => 0.80], [['name' => 'Spaghetti', 'is_vegan' => false, 'is_vegetarian' => true], ['name' => 'Ground Beef', 'is_vegan' => false, 'is_vegetarian' => false], ['name' => 'Tomato Sauce', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Onion', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Garlic', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Oregano', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Basil', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Parmesan Cheese', 'is_vegan' => false, 'is_vegetarian' => false], ['name' => 'Olive Oil', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Salt', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Pepper', 'is_vegan' => true, 'is_vegetarian' => true]], [['name' => 'High Protein']]);
        $this->createRecipe(['name' => 'Thai Red Curry with Tofu', 'headline' => 'A flavorful and spicy Thai-inspired curry', 'preptime' => 'PT45M', 'instructions' => 'Simmer tofu, vegetables, and Thai red curry paste in coconut milk. Serve over rice.', 'image' => 'https://img.hellofresh.com/c_fit,f_auto,fl_lossy,h_1100,q_30,w_2600/hellofresh_s3/image/thai-red-tofu-veggie-curry-728eb3e7.jpg', 'calories' => 420, 'carbs' => 30.5, 'fat' => 32, 'protein' => 12.8, 'sugar' => 5.2, 'sustainability_rating' => 0.85], [['name' => 'Tofu', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Red Curry Paste', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Coconut Milk', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Bell Peppers', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Zucchini', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Carrots', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Basil', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Soy Sauce', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Brown Sugar', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Lime', 'is_vegan' => true, 'is_vegetarian' => true]], [['name' => 'Vegetarian'], ['name' => 'Spicy']]);
        $this->createRecipe(['name' => 'Mushroom Risotto', 'headline' => 'Creamy and comforting Italian rice dish', 'preptime' => 'PT50M', 'instructions' => 'Sauté mushrooms, onions, and Arborio rice. Slowly add broth and Parmesan cheese to create a creamy risotto.', 'image' => 'https://img.hellofresh.com/c_fit,f_auto,fl_lossy,h_1100,q_30,w_2600/hellofresh_s3/image/5332347bff604d567f8b4574.jpg', 'calories' => 480, 'carbs' => 60.2, 'fat' => 18.5, 'protein' => 14.8, 'sugar' => 3.5, 'sustainability_rating' => 0.88], [['name' => 'Arborio Rice', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Mushrooms', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Onion', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Garlic', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Vegetable Broth', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Parmesan Cheese', 'is_vegan' => false, 'is_vegetarian' => false], ['name' => 'White Wine', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Butter', 'is_vegan' => false, 'is_vegetarian' => true], ['name' => 'Olive Oil', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Salt', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Pepper', 'is_vegan' => true, 'is_vegetarian' => true]], [['name' => 'Vegetarian'], ['name' => 'Comfort Food']]);
        $this->createRecipe(['name' => 'Cajun Shrimp Pasta', 'headline' => 'A spicy and flavorful pasta with Cajun-seasoned shrimp', 'preptime' => 'PT40M', 'instructions' => 'Sauté shrimp with Cajun seasoning, garlic, and bell peppers. Toss with pasta and a creamy Alfredo sauce.', 'image' => 'https://img.hellofresh.com/c_fit,f_auto,fl_lossy,h_1100,q_30,w_2600/hellofresh_s3/image/6549b36bab5441ef936d8205-4ce975d5.jpeg', 'calories' => 550, 'carbs' => 45.8, 'fat' => 24, 'protein' => 38.5, 'sugar' => 3.8, 'sustainability_rating' => 0.82], [['name' => 'Shrimp', 'is_vegan' => false, 'is_vegetarian' => false], ['name' => 'Penne Pasta', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Cajun Seasoning', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Bell Peppers', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Garlic', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Heavy Cream', 'is_vegan' => false, 'is_vegetarian' => true], ['name' => 'Parmesan Cheese', 'is_vegan' => false, 'is_vegetarian' => false], ['name' => 'Butter', 'is_vegan' => false, 'is_vegetarian' => true], ['name' => 'Olive Oil', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Salt', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Pepper', 'is_vegan' => true, 'is_vegetarian' => true]], [['name' => 'High Protein'], ['name' => 'Spicy']]);
        $this->createRecipe(['name' => 'Caprese Salad', 'headline' => 'A simple and refreshing Italian salad', 'preptime' => 'PT15M', 'instructions' => 'Layer fresh tomatoes, mozzarella, and basil. Drizzle with balsamic glaze and olive oil.', 'image' => 'https://img.hellofresh.com/c_fit,f_auto,fl_lossy,h_1100,q_30,w_2600/hellofresh_s3/image/552f366c6ced6e9b3c8b456f.jpg', 'calories' => 280, 'carbs' => 7.5, 'fat' => 22, 'protein' => 14.2, 'sugar' => 4.8, 'sustainability_rating' => 0.92], [['name' => 'Tomatoes', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Mozzarella', 'is_vegan' => false, 'is_vegetarian' => true], ['name' => 'Basil', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Balsamic Glaze', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Olive Oil', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Salt', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Pepper', 'is_vegan' => true, 'is_vegetarian' => true]], [['name' => 'Vegetarian']]);
        $this->createRecipe(['name' => 'Chicken Caesar Salad', 'headline' => 'A classic Caesar salad with grilled chicken', 'preptime' => 'PT30M', 'instructions' => 'Grill chicken, toss with crisp romaine lettuce, croutons, and Caesar dressing.', 'image' => 'https://img.hellofresh.com/w_256,q_auto,f_auto,c_fill,fl_lossy/hellofresh_s3/image/64a7acb60c1283a508a6087a-51a66ece.jpeg', 'calories' => 420, 'carbs' => 18.2, 'fat' => 28, 'protein' => 28.5, 'sugar' => 3.2, 'sustainability_rating' => 0.78], [['name' => 'Chicken Breast', 'is_vegan' => false, 'is_vegetarian' => false], ['name' => 'Romaine Lettuce', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Croutons', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Parmesan Cheese', 'is_vegan' => false, 'is_vegetarian' => false], ['name' => 'Caesar Dressing', 'is_vegan' => false, 'is_vegetarian' => false], ['name' => 'Olive Oil', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Salt', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Pepper', 'is_vegan' => true, 'is_vegetarian' => true]], [['name' => 'High Protein']]);
        $this->createRecipe(['name' => 'Beef and Broccoli Stir-Fry', 'headline' => 'Quick and flavorful Asian-inspired stir-fry', 'preptime' => 'PT25M', 'instructions' => 'Stir-fry thinly sliced beef with broccoli in a savory soy-based sauce. Serve over rice.', 'image' => 'https://img.hellofresh.com/c_fit,f_auto,fl_lossy,h_1100,q_30,w_2600/hellofresh_s3/image/65234540e4436936d49a451a-0b500a48.jpeg', 'calories' => 480, 'carbs' => 35.8, 'fat' => 22, 'protein' => 36.2, 'sugar' => 6.5, 'sustainability_rating' => 0.80], [['name' => 'Beef Sirloin', 'is_vegan' => false, 'is_vegetarian' => false], ['name' => 'Broccoli', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Soy Sauce', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Ginger', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Garlic', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Sesame Oil', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Rice', 'is_vegan' => true, 'is_vegetarian' => true]], [['name' => 'High Protein'], ['name' => 'Quick and Easy']]);
        $this->createRecipe(['name' => 'Vegetable Fajitas', 'headline' => 'A colorful and veggie-packed Tex-Mex dish', 'preptime' => 'PT30M', 'instructions' => 'Sauté bell peppers, onions, and mushrooms. Serve with tortillas, guacamole, and salsa.', 'image' => 'https://img.hellofresh.com/c_fit,f_auto,fl_lossy,h_1100,q_30,w_2600/hellofresh_s3/image/55496be46ced6ea6178b4568.jpg', 'calories' => 320, 'carbs' => 45.2, 'fat' => 14.5, 'protein' => 7.8, 'sugar' => 9.8, 'sustainability_rating' => 0.85], [['name' => 'Bell Peppers', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Onion', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Mushrooms', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Tortillas', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Guacamole', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Salsa', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Olive Oil', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Cumin', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Chili Powder', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Salt', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Pepper', 'is_vegan' => true, 'is_vegetarian' => true]], [['name' => 'Vegetarian'], ['name' => 'Tex-Mex']]);
        $this->createRecipe(['name' => 'Miso Glazed Salmon', 'headline' => 'A sweet and savory glazed salmon dish', 'preptime' => 'PT35M', 'instructions' => 'Brush salmon fillets with miso glaze and bake until golden. Serve with steamed vegetables.', 'image' => 'https://img.hellofresh.com/c_fit,f_auto,fl_lossy,h_1100,q_30,w_2600/hellofresh_s3/image/miso-glazed-salmon-a9f8ef66.jpg', 'calories' => 380, 'carbs' => 15.5, 'fat' => 24, 'protein' => 26.5, 'sugar' => 8.2, 'sustainability_rating' => 0.78], [['name' => 'Salmon', 'is_vegan' => false, 'is_vegetarian' => false], ['name' => 'Miso Paste', 'is_vegan' => false, 'is_vegetarian' => true], ['name' => 'Soy Sauce', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Maple Syrup', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Garlic', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Ginger', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Broccoli', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Carrots', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Snap Peas', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Olive Oil', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Salt', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Pepper', 'is_vegan' => true, 'is_vegetarian' => true]], [['name' => 'High Protein'], ['name' => 'Sweet and Savory']]);
        $this->createRecipe(['name' => 'Quinoa and Black Bean Bowl', 'headline' => 'A protein-packed and nutritious grain bowl', 'preptime' => 'PT40M', 'instructions' => 'Combine cooked quinoa, black beans, corn, and avocado. Drizzle with lime vinaigrette.', 'image' => 'https://img.hellofresh.com/c_fit,f_auto,fl_lossy,h_1100,q_30,w_2600/hellofresh_s3/image/570ef4d2fd2cb9ea038b4567.jpg', 'calories' => 420, 'carbs' => 55.2, 'fat' => 16, 'protein' => 18.8, 'sugar' => 4.5, 'sustainability_rating' => 0.85], [['name' => 'Quinoa', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Black Beans', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Corn', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Avocado', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Tomatoes', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Lime', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Cilantro', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Olive Oil', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Cumin', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Salt', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Pepper', 'is_vegan' => true, 'is_vegetarian' => true]], [['name' => 'Vegetarian'], ['name' => 'High Fiber']]);
        $this->createRecipe(['name' => 'Teriyaki Chicken Skewers', 'headline' => 'Sweet and savory grilled chicken skewers', 'preptime' => 'PT30M', 'instructions' => 'Marinate chicken in teriyaki sauce, thread onto skewers, and grill. Serve with rice.', 'image' => 'https://img.hellofresh.com/w_256,q_auto,f_auto,c_fill,fl_lossy/hellofresh_s3/image/teriyaki-chicken-noodles-with-veggies-lime-87e593aa.jpg', 'calories' => 480, 'carbs' => 35.5, 'fat' => 22.5, 'protein' => 28.2, 'sugar' => 12.8, 'sustainability_rating' => 0.82], [['name' => 'Chicken Thighs', 'is_vegan' => false, 'is_vegetarian' => false], ['name' => 'Teriyaki Sauce', 'is_vegan' => false, 'is_vegetarian' => false], ['name' => 'Bell Peppers', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Pineapple', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Soy Sauce', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Garlic', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Ginger', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Rice', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Olive Oil', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Salt', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Pepper', 'is_vegan' => true, 'is_vegetarian' => true]], [['name' => 'High Protein'], ['name' => 'Grilled']]);
        $this->createRecipe(['name' => 'Pesto Pasta with Cherry Tomatoes', 'headline' => 'A vibrant and herby pasta dish', 'preptime' => 'PT25M', 'instructions' => 'Toss cooked pasta with basil pesto and cherry tomatoes. Garnish with Parmesan.', 'image' => 'https://img.hellofresh.com/c_fit,f_auto,fl_lossy,h_1100,q_30,w_2600/hellofresh_s3/image/quick-pesto-cherry-tomato-pasta-78ecd1fb.jpg', 'calories' => 420, 'carbs' => 50.8, 'fat' => 20, 'protein' => 12.5, 'sugar' => 3.2, 'sustainability_rating' => 0.85], [['name' => 'Penne Pasta', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Basil Pesto', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Cherry Tomatoes', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Parmesan Cheese', 'is_vegan' => false, 'is_vegetarian' => false], ['name' => 'Garlic', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Olive Oil', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Salt', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Pepper', 'is_vegan' => true, 'is_vegetarian' => true]], [['name' => 'Vegetarian']]);
        $this->createRecipe(['name' => 'Honey Mustard Glazed Chicken', 'headline' => 'A sweet and tangy glazed chicken dish', 'preptime' => 'PT35M', 'instructions' => 'Brush chicken breasts with honey mustard glaze and bake until golden. Serve with roasted vegetables.', 'image' => 'https://img.hellofresh.com/c_fit,f_auto,fl_lossy,h_1100,q_30,w_2600/hellofresh_s3/image/57172087f8b25e6f628b4568.jpg', 'calories' => 380, 'carbs' => 28.5, 'fat' => 18, 'protein' => 26.2, 'sugar' => 14.5, 'sustainability_rating' => 0.80], [['name' => 'Chicken Breasts', 'is_vegan' => false, 'is_vegetarian' => false], ['name' => 'Dijon Mustard', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Honey', 'is_vegan' => false, 'is_vegetarian' => true], ['name' => 'Rosemary', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Carrots', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Potatoes', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Olive Oil', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Salt', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Pepper', 'is_vegan' => true, 'is_vegetarian' => true]], [['name' => 'Sweet and Savory']]);
        $this->createRecipe(['name' => 'Shrimp and Avocado Salad', 'headline' => 'A light and refreshing seafood salad', 'preptime' => 'PT20M', 'instructions' => 'Combine cooked shrimp, avocado, and mixed greens. Dress with lemon vinaigrette.', 'image' => 'https://img.hellofresh.com/c_fit,f_auto,fl_lossy,h_1100,q_30,w_2600/hellofresh_s3/image/crispy-chorizo-avocado-salad-bdc2efb4.jpg', 'calories' => 320, 'carbs' => 20.2, 'fat' => 22, 'protein' => 18.8, 'sugar' => 5.5, 'sustainability_rating' => 0.85], [['name' => 'Shrimp', 'is_vegan' => false, 'is_vegetarian' => false], ['name' => 'Avocado', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Mixed Greens', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Lemon', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Olive Oil', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Dijon Mustard', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Honey', 'is_vegan' => false, 'is_vegetarian' => true], ['name' => 'Salt', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Pepper', 'is_vegan' => true, 'is_vegetarian' => true]], [['name' => 'Seafood']]);
        $this->createRecipe(['name' => 'Mediterranean Quinoa Salad', 'headline' => 'A fresh and vibrant salad with Mediterranean flavors', 'preptime' => 'PT30M', 'instructions' => 'Combine cooked quinoa, cherry tomatoes, cucumber, feta, and olives. Dress with olive oil and lemon juice.', 'image' => 'https://img.hellofresh.com/c_fit,f_auto,fl_lossy,h_1100,q_30,w_2600/hellofresh_s3/image/warm-lentil-quinoa-salad-cb7b11ed.jpg', 'calories' => 350, 'carbs' => 40.8, 'fat' => 16.5, 'protein' => 12.2, 'sugar' => 3.8, 'sustainability_rating' => 0.88], [['name' => 'Quinoa', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Cherry Tomatoes', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Cucumber', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Feta Cheese', 'is_vegan' => false, 'is_vegetarian' => true], ['name' => 'Kalamata Olives', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Olive Oil', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Lemon', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Oregano', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Salt', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Pepper', 'is_vegan' => true, 'is_vegetarian' => true]], [['name' => 'Vegetarian'], ['name' => 'Mediterranean']]);
        $this->createRecipe(['name' => 'Stuffed Bell Peppers', 'headline' => 'A hearty and flavorful stuffed peppers dish', 'preptime' => 'PT45M', 'instructions' => 'Stuff bell peppers with a mixture of ground turkey, quinoa, black beans, and spices. Bake until tender.', 'image' => 'https://img.hellofresh.com/c_fit,f_auto,fl_lossy,h_1100,q_30,w_2600/hellofresh_s3/image/5252b1b6301bbf46038b4740.jpg', 'calories' => 420, 'carbs' => 35.5, 'fat' => 22, 'protein' => 26.8, 'sugar' => 8.2, 'sustainability_rating' => 0.82], [['name' => 'Bell Peppers', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Ground Turkey', 'is_vegan' => false, 'is_vegetarian' => false], ['name' => 'Quinoa', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Black Beans', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Tomato Sauce', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Onion', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Garlic', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Cumin', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Chili Powder', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Olive Oil', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Salt', 'is_vegan' => true, 'is_vegetarian' => true], ['name' => 'Pepper', 'is_vegan' => true, 'is_vegetarian' => true]], [['name' => 'High Protein'], ['name' => 'Hearty']]);
    }
}
