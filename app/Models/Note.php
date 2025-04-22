<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends \FamilyTree365\LaravelGedcom\Models\Note
{
    use HasFactory;
    use BelongsToTenant;
}
