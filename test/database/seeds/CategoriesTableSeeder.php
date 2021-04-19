<?php

use Illuminate\Database\Seeder;
use App\models\Category;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = $this->getCategories();

        // Category.php con metodo a cui passo un array con chiave valore delle mie categorie
        // con insert non controlla le colonne che sono in $fillable dentro category.
        // insert è della classe DB, non crea effetivamente l'oggetto ma fa una query secca sul database.
        // Quindi dobbiamo passargli anche le colonne created_at e updated_at
        // però in pasto ::insert prende un array, ::create no. Per questo ::insert è più scalabile. BULK INSERT
        // Category::insert(['name' => 'Animazione', 'cat_code' => 'animazione', 'icon_path' => '']);
        // Category::insert($categories);
        // dobbiamo sincerarci che la tabella sia buota
        //insert restituisce il numero di query eseguite
        
        // con ::create fa il touch delle date, quindi le aggiorna anche senza che gliele passiamo, con ::insert no
        foreach ($categories as $category) {
            Category::create($category);
        };
    }

    private function getCategories(){
        $now = Carbon::now();
        return [
            [
                'name' => 'Animazione', 
                'cat_code' => 'animazione', 
                'icon_path' => '',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Commedia', 
                'cat_code' => 'commedia', 
                'icon_path' => '',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Musical', 
                'cat_code' => 'musical', 
                'icon_path' => '',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Horror', 
                'cat_code' => 'horror', 
                'icon_path' => '',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
    }
}
