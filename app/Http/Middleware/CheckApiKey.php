<?php

namespace App\Http\Middleware;

use App\Models\PerangkatDaerah;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('x-api-key');

        // Mengambil {slug} dari URL (contoh: /api/v1/kunjungan/diskominfo -> mengambil 'diskominfo')
        $slug = $request->route('slug');

        if (! is_string($apiKey) || $apiKey === '') {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. Harap sertakan Header x-api-key.',
            ], 401);
        }

        // api_key di database berupa hash; dibandingkan di PHP dengan hash_equals
        // (case-sensitive dan tahan timing attack), bukan lewat WHERE di SQL.
        $instansi = PerangkatDaerah::where('slug', $slug)->first();

        if (! $instansi || ! $instansi->apiKeyMatches($apiKey)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. API Key tidak valid atau tidak cocok dengan instansi tersebut.',
            ], 401);
        }

        return $next($request);
    }
}
