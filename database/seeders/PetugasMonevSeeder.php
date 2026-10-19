<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class PetugasMonevSeeder extends Seeder
{
    public function run(): void
    {
        $petugas = [
            ['name' => 'Fauziyah', 'username' => 'Fauziyah', 'nip' => '198910092014042002'],
            ['name' => 'Adelina', 'username' => 'Adelina', 'nip' => '199902022025062009'],
            ['name' => 'Masturi', 'username' => 'Masturi', 'nip' => '197603142002122004'],
            ['name' => 'Ki', 'username' => 'Ki', 'nip' => '199012052015041001'],
            ['name' => 'Doni', 'username' => 'Doni', 'nip' => '198205062025211051'],
            ['name' => 'Nur', 'username' => 'Nur', 'nip' => '198612292010122003'],
            ['name' => 'Dewi', 'username' => 'Dewi', 'nip' => '198405092008122002'],
            ['name' => 'Eliana', 'username' => 'Eliana', 'nip' => '197612102008102001'],
            ['name' => 'Prita', 'username' => 'Prita', 'nip' => '199202082019022010'],
            ['name' => 'Ibnu', 'username' => 'Ibnu', 'nip' => '198407042010121004'],
            ['name' => 'Akhmad', 'username' => 'Akhmad', 'nip' => '198108212010121002'],
            ['name' => 'Ari', 'username' => 'Ari', 'nip' => '198608092009121005'],
            ['name' => 'Lalu', 'username' => 'LaluFahrurrozi', 'nip' => '198408282010121006'],
            ['name' => 'Lalu', 'username' => 'LaluMukti', 'nip' => '198612082014041001'],
            ['name' => 'Rieza', 'username' => 'Rieza', 'nip' => '198502232025211038'],
            ['name' => 'Yandri', 'username' => 'Yandri', 'nip' => '197406012025211020'],
            ['name' => 'Rusmawati', 'username' => 'Rusmawati', 'nip' => '198007072009122004'],
            ['name' => 'Evi', 'username' => 'Evi', 'nip' => '199108192019022005'],
        ];

        foreach ($petugas as $data) {
            User::updateOrCreate(
                ['username' => $data['username']],
                [
                    'name' => $data['name'],
                    'email' => strtolower($data['username']) . '@bgtk-monev.local',
                    'nip' => $data['nip'],
                    'password' => $data['nip'],
                    'role' => 'petugas_monev',
                    'is_active' => true,
                ]
            );
        }

        $this->command->info('18 akun Petugas Monev berhasil disiapkan.');
    }
}
