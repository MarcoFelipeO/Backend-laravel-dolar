<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dolar;
use Illuminate\Http\Request;
use App\Services\DolarService;

class DolarController extends Controller
{
    protected $dolarService;

    public function __construct(DolarService $dolarService)
    {
        $this->dolarService = $dolarService;
    }

    public function consultar(Request $request){
        try {
            $inicio = $request->query('fecha_inicio');
            $fin = $request->query('fecha_fin');
    
            if (!$inicio || !$fin) {
                return response()->json(['error' => 'Debe enviar fecha_inicio y fecha_fin '], 400);
            }
    
            $data = $this->dolarService->obtenerPorFechas($inicio, $fin);
            return response()->json($data);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function actualizar(Request $request, $fecha)
{
    $request->validate([
        'valor' => 'required|numeric',
    ]);

    $dolar = Dolar::where('fecha', $fecha)->first();

    if (!$dolar) {
        return response()->json(['error' => 'Registro no encontrado'], 404);
    }

    $dolar->valor = $request->valor;
    $dolar->save();

    return response()->json(['message' => 'Valor actualizado'], 200);
}

public function eliminar($fecha)
{
    $dolar = Dolar::where('fecha', $fecha)->first();

    if (!$dolar) {
        return response()->json(['error' => 'Registro no encontrado'], 404);
    }

    $dolar->delete();

    return response()->json(['message' => 'Registro eliminado'], 200);
}


    


}
