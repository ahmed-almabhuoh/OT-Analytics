<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Contributor extends Authenticatable
{
    use HasFactory;

    // Properties
    const STATUS = ['active', 'draft'];

    public function getContributorStatusAttribute()
    {
        return $this->status === 'active' ? 'label label-lg font-weight-bold label-light-primary label-inline' : 'label label-lg font-weight-bold label-light-danger label-inline';
    }
}
