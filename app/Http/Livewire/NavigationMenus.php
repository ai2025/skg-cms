<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\NavigationMenu;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class NavigationMenus extends Component
{

    use WithPagination;

    public $modalFormVisible;
    public $modalConfirmDeleteVisible;

    public $modelId;
    public $label;
    public $slug;
    public $sequence = 1;
    public $type = 'SidebarNav';

    /**
     * rules for validation
     *
     * @return void
     */
    public function rules()
    {
        return [
            'label' => 'required',
            'slug' => 'required',
            // 'slug' => ['required', Rule::unique('pages', 'slug')->ignore($this->modelId)],
            'sequence' => 'required',
            'type' => 'required',
        ];
    }

    /**
     * create function
     *
     * @return void
     */
    public function create()
    {
        $this->validate();
        NavigationMenu::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }

    /**
     * read the database
     *
     * @return void
     */
    public function read()
    {
        return NavigationMenu::paginate(5);
    }

    /**
     * update function
     *
     * @return void
     */
    public function update()
    {
        $this->validate();
        NavigationMenu::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    /**
     * delete function
     *
     * @return void
     */
    public function delete()
    {
        NavigationMenu::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    /**
     * show the create modal
     *
     * @return void
     */
    public function createShowModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }

    /**
     * shows the form modal when
     * in update mode
     *
     * @param  mixed $id
     * @return void
     */
    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
        $this->modelId = $id;
        $this->loadModel();
    }

    /**
     * show delete confirmation modal
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteShowModal($id)
    {
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }

    /**
     * load the model data
     * of this component
     *
     * @return void
     */
    public function loadModel()
    {
        $data = NavigationMenu::find($this->modelId);
        $this->label = $data->label;
        $this->slug = $data->slug;
        $this->type = $data->type;
        $this->sequence = $data->sequence;
    }

    /**
     * the data for the model mapped
     * in this component
     *
     * @return void
     */
    public function modelData()
    {
        return [
            'label' => $this->label,
            'slug' => $this->slug,
            'sequence' => $this->sequence,
            'type' => $this->type,
        ];
    }

    public function render()
    {
        return view('livewire.navigation-menus', [
            'data' => $this->read(),
        ]);
    }
}
