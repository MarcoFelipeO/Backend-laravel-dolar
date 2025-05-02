<?php

namespace App\Services;

use App\Models\Dolar;
use Illuminate\Support\Facades\Http;

class DolarService
{
    public function importarPorAño(int $anio): void
{
    $url = "https://mindicador.cl/api/dolar/{$anio}";
    $response = Http::withoutVerifying()->get($url);

    if ($response->successful() && isset($response['serie'])) {
        foreach ($response['serie'] as $dato) {
            Dolar::updateOrCreate(
                ['fecha' => substr($dato['fecha'], 0, 10)], // solo la fecha yyyy-mm-dd
                ['valor' => $dato['valor']]
            );
        }
    }
}


    public function importarRangoAnios(array $anios): void
    {
        foreach ($anios as $anio) {
            $this->importarPorAño($anio);
        }
    }

    public function obtenerPorFechas(string $inicio, string $fin)
    {
        return Dolar::whereBetween('fecha', [$inicio, $fin])
                    ->orderBy('fecha', 'asc')
                    ->get();
    }
}
