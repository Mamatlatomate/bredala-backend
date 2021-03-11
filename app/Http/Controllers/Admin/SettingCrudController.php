<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Requests\SettingRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SettingCrudController.
 *
 * @property \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SettingCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Setting::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/setting');
        CRUD::setEntityNameStrings('paramètre', 'paramètres');

        if (User::min('id') !== backpack_user()->id) {
            CRUD::denyAccess(['delete', 'create']);
        }
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
        CRUD::column('key')->label('ID key')->type('text');
        CRUD::column('name')->label('Nom')->type('text')->limit(200);
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
        CRUD::setValidation(SettingRequest::class);

        CRUD::field('key')->type('text')->label('ID key');
        CRUD::field('name')->type('text')->label('Nom');
        CRUD::field('type')
            ->type('select_from_array')
            ->label('Type de widget')
            ->options([
                'ckeditor' => 'ckeditor',
                'textarea' => 'textarea',
                'text'     => 'text',
            ]);
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
        CRUD::setValidation(SettingRequest::class);

        $readonly = [];
        if (User::min('id') !== backpack_user()->id) {
            $readonly = ['readonly' => 'readonly'];
        }

        CRUD::field('key')->type('text')->label('ID key')->attributes($readonly);
        CRUD::field('name')->type('text')->label('Nom');
        CRUD::field('value')->type(CRUD::getCurrentEntry()->type)->label('Contenu');
    }
}
