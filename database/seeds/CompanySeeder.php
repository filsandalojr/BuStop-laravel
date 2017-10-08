<?php

use App\Http\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            [
                'data' => [
                    'name' => 'Ceres Liner',
                    'address' => 'N. Bacalso Avenue, Cebu City, 6000 Cebu',
                    'contact_number' => '(032) 253 3830',
                    'contact_person' => 'Peter Lim'
                ]
            ],
            [
                'data' => [
                    'name' => 'Sunrays Bus Lines',
                    'address' => ' C-Padilla Street, Mambaling, 6000 Cebu',
                    'contact_number' => '(032) 418 8520',
                    'contact_person' => 'David Lim'
                ]
            ],
            [
                'data' => [
                    'name' => 'Librando',
                    'address' => 'Natalio B. Bacalso Ave, Cebu City, 6000 Cebu',
                    'contact_number' => '(02) 416 4875',
                    'contact_person' => 'Xian Lim'
                ]
            ]
        ];
        foreach ($records as $record) {
            $company = new Company();
            $company->create($record['data']);
        }
    }
}
