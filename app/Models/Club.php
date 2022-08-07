<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $logo
 * @property int $group_id
 * @property int $pot_id
 * @property int $games
 * @property int $goals_scored
 * @property int $goals_conceded
 * @property int $wins
 * @property int $points
 * @property int $losses
 * @property int $draws
 */
class Club extends Model
{
    use HasFactory;

    /**
     * @var int|mixed
     */

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
