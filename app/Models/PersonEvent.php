<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonEvent extends \FamilyTree365\LaravelGedcom\Models\PersonEvent
{
    use HasFactory;
    use BelongsToTenant;
}
