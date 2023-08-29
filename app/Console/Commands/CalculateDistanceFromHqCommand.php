<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CalculateDistanceService;

class CalculateDistanceFromHqCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hq:calculate-distance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to calculate distance of offices from HQ and store them in CSV';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $locations = [
            "Eastern Enterprise B.V. - Deldenerstraat 70, 7551AH Hengelo, The Netherlands",
            "Eastern Enterprise - 46/1 Office no 1 Ground Floor , Dada House , Inside dada silk mills",
            "compound, Udhana Main Rd, near Chhaydo Hospital, Surat, 394210, India",
            "Adchieve Rotterdam - Weena 505, 3013 AL Rotterdam, The Netherlands",
            "Sherlock Holmes - 221B Baker St., London, United Kingdom",
            "The White House - 1600 Pennsylvania Avenue, Washington, D.C., USA",
            "The Empire State Building - 350 Fifth Avenue, New York City, NY 10118",
            "The Pope - Saint Martha House, 00120 Citta del Vaticano, Vatican City",
            "Neverland - 5225 Figueroa Mountain Road, Los Olivos, Calif. 93441, USA",
        ];

        (new CalculateDistanceService($locations))->fromHq();

        return Command::SUCCESS;
    }
}
