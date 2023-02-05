<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use Livewire\Component;

class AdminSearchLivewire extends Component
{
    public $admin_id;
    public $name;
    public $email;
    public $created_at;
    public $updated_at;
    public $status;
    protected $admins;
    protected $fname;
    protected $lname;
    protected $search_items = [];

    public function mount()
    {
        $this->admins = Admin::paginate();
    }

    public function render()
    {
        $this->admins = Admin::where($this->getQueries($this->getSearchableItems()))->paginate();
        // $this->search_items = $this->getSearchableItems();
        return view('livewire.admin-search-livewire', [
            'admins' => $this->admins,
            // 'search_items' => $this->search_items,
        ]);
    }

    public function getSearchableItems()
    {
        $items = [];
        if (!is_null($this->admin_id)) {
            $items['id'] = $this->admin_id;
        }
        if (!is_null($this->name)) {
            $name = trim($this->name, ' ');
            $items['fname'] = $name[0];
            $items['lname'] = $name[1];
        }
        if (!is_null($this->email)) {
            $items['email'] = $this->email;
        }
        if (!is_null($this->created_at)) {
            $items['created_at'] = $this->created_at;
        }
        if (!is_null($this->updated_at)) {
            $items['updated_at'] = $this->updated_at;
        }
        if (!is_null($this->status)) {
            $items['status'] = $this->status;
        }

        return $items;
    }

    public function getQueries($searchable_items)
    {
        $query = [];
        if (!count($searchable_items))
            return $query;

        foreach ($searchable_items as $key => $value) {
            $query[] = [
                $key, 'LIKE', '%' . $value . '%'
            ];
        }
        return $query;
    }
}
