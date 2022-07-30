<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $logo
 * @property int $group_id
 * @property int $pot_id
 */
class Club extends Model
{
    use HasFactory;

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function outStage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function pot()
    {
        return $this->belongsTo(Pot::class);
    }
}
