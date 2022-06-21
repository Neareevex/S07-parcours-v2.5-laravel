<?php

namespace App\Http\Controllers;

use App\Models\Videogame;
use Illuminate\Http\Request;

class VideogameController extends Controller
{
    /**
     * /videogames/[id]
     * GET
     */
    public function read($id)
    {
        // Get item or send 404 response if not
        $item = Videogame::find($id);

        // Si on a un résultat
        if (!empty($item)) {
            // Return JSON of this list
            return response()->json($item, 200);
        } else { // Sinon
            // HTTP status code 404 Not Found
            return response('', 404);
        }
    }

    /**
     * /videogames/[id]/reviews
     * GET
     */
    public function getReviews($id)
    {
        // Get item or send 404 response if not
        $item = Videogame::find($id);

        // Si on a un résultat
        if (!empty($item)) {
            // Retrieve all related Reviews (thanks to Relationships)
            // $reviews = $item->reviews->load(['videogame', 'platform']);
            // But, relationships with videogame & plaftorm are not configured yet
            $reviews = $item->reviews;

            // Return JSON of this list
            return response()->json($reviews, 200);
        } else { // Sinon
            // HTTP status code 404 Not Found
            return response('', 404);
        }
    }
}
