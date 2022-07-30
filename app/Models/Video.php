<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $game_id
 * @property mixed $player_id
 * @property string $path
 */
class Video extends Model
{
    use HasFactory;

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
