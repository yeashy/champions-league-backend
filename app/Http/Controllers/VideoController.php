<?php

namespace App\Http\Controllers;

use App\Models\DTO\ClubPlayerDTO;
use App\Models\DTO\VideoDTO;
use App\Models\Video;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function getVideos(): JsonResponse
    {
        $videos = Video::all();

        $videosResult = [];

        foreach ($videos as $video) {
            $game = $video->game;
            $stageName = $game->stage->name;
            $homeClub = ClubPlayerDTO::fromModel($game->homeClub);
            $awayClub = ClubPlayerDTO::fromModel($game->awayClub);
            $homeScored = $game->home_scored;
            $awayScored = $game->away_scored;
            $videoResult = VideoDTO::fromModel($video);

            $videosResult[] = [
                "video" => $videoResult,
                "stage" => $stageName,
                "home_scored" => $homeScored,
                "away_scored" => $awayScored,
                "home_club" => $homeClub,
                "away_club" => $awayClub
            ];
        }

        return response()->json($videosResult);
    }

    public function getBestVideo(): JsonResponse
    {
        $video = Video::where('is_best', '=', true)->first();

        $game = $video->game;
        $stageName = $game->stage->name;
        $homeClub = ClubPlayerDTO::fromModel($game->homeClub);
        $awayClub = ClubPlayerDTO::fromModel($game->awayClub);
        $homeScored = $game->home_scored;
        $awayScored = $game->away_scored;
        $videoResult = VideoDTO::fromModel($video);

        return response()->json([
            "video" => $videoResult,
            "stage" => $stageName,
            "home_scored" => $homeScored,
            "away_scored" => $awayScored,
            "home_club" => $homeClub,
            "away_club" => $awayClub
        ]);
    }
}
