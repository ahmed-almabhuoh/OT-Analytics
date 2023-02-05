<?php

namespace App\Http\Livewire;

use App\Models\Contributor;
use Livewire\Component;

class ContributorSearchLivewire extends Component
{
    public $contributor_id;
    public $name;
    public $email;
    public $created_at;
    public $updated_at;
    public $status;
    protected $contributors;
    protected $fname;
    protected $lname;
    protected $search_items = [];

    public function mount()
    {
        $this->contributors = Contributor::paginate();
    }

    public function render()
    {
        $this->contributors = Contributor::where($this->getQueries($this->getSearchableItems()))->paginate();
        return view('livewire.contributor-search-livewire', [
            'contributors' => $this->contributors,
        ]);
    }


    public function getSearchableItems()
    {
        $items = [];
        if (!is_null($this->contributor_id)) {
            $items['id'] = $this->contributor_id;
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
