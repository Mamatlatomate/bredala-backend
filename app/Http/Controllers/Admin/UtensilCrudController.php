<?php

namespace App\Http\Controllers\Admin;

use App\Models\Utensil;
use App\Http\Requests\UtensilRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UtensilCrudController.
 *
 * @property \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UtensilCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Utensil::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/utensil');
        CRUD::setEntityNameStrings('ustensile', 'ustensiles');
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
        CRUD::column('image')
            ->type('closure')
            ->label('Image')
            ->function(function (Utensil $utensil) {
                if ($utensil->image) {
                    return '<a href="'.url($this->crud->route.'/'.$utensil->getKey().'/edit').'"><img src="/storage/'.$utensil->image.'" width="80"/></a>';
                }

                return '';
            });

        CRUD::column('name')->type('text')->label('Nom');
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
        CRUD::setValidation(UtensilRequest::class);

        CRUD::field('name')->type('text')->label('Nom');

        CRUD::field('description')->type('ckeditor')->label('Description');

        CRUD::field('image')
            ->type('image')
            ->label('Image')
            ->upload(true)
            ->crop(true)
            ->prefix('storage/');
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
