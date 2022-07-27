<?php

namespace App\Console\Commands;

use App\Models\Settlements;
use App\Models\Zipcode;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class ImportTxtToDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import-txt-to-db {
        --path= : the path of the file
    }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import a txt file to DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('PREPARANDO');
        $this->info('CARGANDO');

        $file = $this->option('path');
        
        $gestor = @fopen($file, "r");

        if ($gestor) {
            $this->info('IMPORTANDO');
            $counter = 0;
            while (($bufer = fgets($gestor, 4096)) !== false) {
                if ($counter > 1) {

                    $line_exploded = explode("|", $bufer);

                    $zipcode = Zipcode::firstOrCreate(
                        ['zip_code' => $line_exploded[0],],
                        [
                            'locality'            => utf8_encode($line_exploded[5]),
                            'federal_entity_key'  => $line_exploded[7],
                            'federal_entity_name' => utf8_encode($line_exploded[4]),
                            'federal_entity_code' => null,
                            'municipality_key'    => $line_exploded[11],
                            'municipality_name'   => utf8_encode($line_exploded[3]),
                        ]
                    );

                    Settlements::create([
                        'zipcode_id' => $zipcode->id,
                        'key' => $line_exploded[12],
                        'name' => utf8_encode($line_exploded[1]),
                        'zone_type' => utf8_encode($line_exploded[13]),
                        'settlement_type_name' => utf8_encode($line_exploded[2]),
                    ]);
                }
                $counter++;

                
            }
            if (!feof($gestor)) {
                $this->error("Error: fallo inesperado de fgets()");
            }
            fclose($gestor);

            $this->info('IMPORTADOS: '.$counter.' REGISTROS');
        }
    }
}
