<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property int $num_of_clubs
 * @property bool $is_active
 */
class Stage extends Model
{
    use HasFactory;

    public function clubs()
    {
        return $this->hasMany(Club::class);
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function teamOfTheWeek()
    {
        return $this->hasOne(TeamOfTheWeek::class);
    }
}
