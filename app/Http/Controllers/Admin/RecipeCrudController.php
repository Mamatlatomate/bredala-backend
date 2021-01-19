<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Recipe;
use App\Models\Utensil;
use App\Http\Requests\RecipeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RecipeCrudController.
 *
 * @property \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RecipeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Recipe::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/recipe');
        CRUD::setEntityNameStrings('recette', 'recettes');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     *
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addButtonFromModelFunction('line', 'open_recipe', 'openRecipe', 'beginning');

        CRUD::column('image')
            ->type('closure')
            ->label('Image')
            ->function(function (Recipe $recipe) {
                if ($recipe->image) {
                    return '<a href="'.url($this->crud->route.'/'.$recipe->getKey().'/edit').'"><img src="/storage/'.$recipe->image.'" width="80"/></a>';
                }

                return '';
            });
        CRUD::column('title')->type('text')->label('Titre');
        CRUD::column('status')
            ->type('closure')
            ->label('Statut')
            ->function(function (Recipe $recipe) {
                $class = 'published' == $recipe->status ? 'badge-success' : 'badge-warning';
                $text = 'published' == $recipe->status ? 'Publiée' : 'Brouillon';

                return '<span class="badge '.$class.'">'.$text.'</span>';
            });
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     *
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(RecipeRequest::class);

        CRUD::field('title')->type('text')->label('Titre')->tab('Recette');

        CRUD::field('duration')
            ->type('text')
            ->label('Temps de réalisation')
            ->suffix('<i class="las la-hourglass-half"></i>')
            ->size(6)
            ->tab('Recette');

        CRUD::field('difficulty')
            ->type('select_from_array')
            ->label('Difficulté')
            ->options(['Facile' => 'Facile', 'Moyenne' => 'Moyenne', 'Difficile' => 'Difficile'])
            ->size(6)
            ->tab('Recette');

        CRUD::field('price')
            ->type('text')
            ->label('Prix de revient')
            ->suffix('<i class="la la-euro-sign"></i>')
            ->size(6)
            ->tab('Recette');

        CRUD::field('quantity')
            ->type('text')
            ->label('Quantité')
            ->hint('Exemple : "Pour 6 personnes" ou "Pour environ 20 gâteaux"')
            ->size(6)
            ->tab('Recette');

        CRUD::field('advice')
            ->type('textarea')
            ->label('Les conseils de Mamema')
            ->tab('Recette');

        CRUD::field('ingredients')
            ->type('table')
            ->label('Ingrédients')
            ->columns(['name' => 'Nom', 'quantity' => 'Quantité'])
            ->entity_singular('un ingredient')
            ->tab('Recette');

        CRUD::field('utensils')
            ->type('relationship')
            ->label('Ustensiles')
            ->ajax(true)
            ->inline_create([
                'entity'      => 'utensil',
                'modal_class' => 'modal-dialog modal-xl',
            ])
            ->tab('Recette');

        CRUD::field('tags')
            ->type('relationship')
            ->label('Catégories')
            ->ajax(true)
            ->inline_create(['entity' => 'tag'])
            ->tab('Recette');

        CRUD::field('image')
            ->type('image')
            ->label('Image')
            ->upload(true)
            ->crop(true)
            ->prefix('storage/')
            ->tab('Recette');

        CRUD::field('status')
            ->type('select_from_array')
            ->label('Statut')
            ->options(['published' => 'Publiée', 'draft' => 'Brouillon'])
            ->tab('Recette');

        CRUD::field('body')->type('ckeditor')->label('Contenu')->tab('Contenu');
    }

    public function fetchTags()
    {
        return $this->fetch(Tag::class);
    }

    public function fetchUtensils()
    {
        return $this->fetch(Utensil::class);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     *
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
