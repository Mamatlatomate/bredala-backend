<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RecipeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RecipeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RecipeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Recipe::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/recipe');
        CRUD::setEntityNameStrings('recette', 'recettes');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('image')->type('image')->label('Image');
        CRUD::column('title')->type('text')->label('Titre');
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
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
            ->type('text')
            ->label('Difficulté')
            ->suffix('<i class="la la-signal"></i>')
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

        CRUD::field('body')->type('ckeditor')->label('Contenu')->tab('Contenu');

        CRUD::field('ingredients')
            ->type('table')
            ->label('Ingrédients')
            ->columns(['name' => 'Nom', 'quantity' => 'Quantité'])
            ->entity_singular('un ingredient')
            ->tab('Recette');

        CRUD::field('utensils')
            ->type('table')
            ->label('Ustensiles')
            ->columns(['name' => 'Nom'])
            ->entity_singular('un ustensile')
            ->tab('Recette');

        CRUD::field('tags')
            ->type('relationship')
            ->label('Catégories')
            ->inline_create(['entity' => 'tag'])
            ->tab('Recette');

        CRUD::field('image')
            ->type('image')
            ->label('Image')
            ->upload(true)
            ->crop(true)
            ->prefix('storage/')
            ->tab('Recette');
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
