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

        if (! $apiKey) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. Harap sertakan Header x-api-key.',
            ], 401);
        }

        // Cek ke database: Apakah ada instansi dengan slug X yang memiliki api_key Y?
        $instansi = PerangkatDaerah::where('slug', $slug)
            ->where('api_key', $apiKey)
            ->first();

        if (! $instansi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. API Key tidak valid atau tidak cocok dengan instansi tersebut.',
            ], 401);
        }

        return $next($request);
    }
}
