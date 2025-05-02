<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DolarService;

class ImportarDolares extends Command{
    
    protected $signature = 'importar:dolares';
    protected $description = 'Importa los valores del dólar desde la API externa.';

    protected DolarService $dolarService;

    public function __construct(DolarService $dolarService)
    {
        parent::__construct();
        $this->dolarService = $dolarService;
    }

    public function handle()
    {
        $this->dolarService->importarRangoAnios([2024, 2025]);
        $this->info('Importación completada.');
    }
}
