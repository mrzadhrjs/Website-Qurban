<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Hewan;
use App\Models\Bobot;
use App\Models\User;
use App\Models\Grade;
use App\Models\HewanBobot;
use App\Models\GradeBobot;
use App\Models\HewanGrade;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void{
        $insertAdmin = ['name' => 'Aulia Admin', 'email' => 'admin@example.com', 'username' => 'admin', 'alamat' => 'Klapanunggal', 'phone' => '087873031310', 'password' => 'yangjelasjelasaja'];
        $insertAdmin['password'] = Hash::make($insertAdmin['password']);
        
        User::insert($insertAdmin);

        $insertHewan = [
            ['nama' => 'Kambing', 'coverimg' => 'foto-hewan/kambing-3.png', 'qty' => 10],
            ['nama' => 'Domba', 'coverimg' => 'foto-hewan/domba-1.jpg', 'qty' => 4],
            ['nama' => 'Sapi', 'coverimg' => 'foto-hewan/sapi-3.png', 'qty' => 6],
            ['nama' => 'Sapi Premium', 'coverimg' => 'foto-hewan/sapi-2.png', 'qty' => 2],
        ];
        

        Hewan::insert($insertHewan); // Eloquent

        $insertBobot = [
            ['bobot' => '-260', 'harga' => 17600000],
            ['bobot' => '-265', 'harga' => 17900000],
            ['bobot' => '-270', 'harga' => 18300000],
            ['bobot' => '-275', 'harga' => 18600000],
            ['bobot' => '-280', 'harga' => 18900000],
            ['bobot' => '-285', 'harga' => 19300000],
            ['bobot' => '-290', 'harga' => 19600000],
            ['bobot' => '-295', 'harga' => 20000000],
            ['bobot' => '-300', 'harga' => 20300000],
            ['bobot' => '-310', 'harga' => 21000000],
            ['bobot' => '-320', 'harga' => 21600000],  

            ['bobot' => '-340', 'harga' => 23000000],  
            ['bobot' => '-345', 'harga' => 23300000],  
            ['bobot' => '-350', 'harga' => 23700000],  
            ['bobot' => '-355', 'harga' => 24000000],  
            ['bobot' => '-360', 'harga' => 24300000],  
            ['bobot' => '-365', 'harga' => 24700000],  
            ['bobot' => '-370', 'harga' => 25000000],  
            ['bobot' => '-375', 'harga' => 25400000],  
            ['bobot' => '-380', 'harga' => 25700000],  
            ['bobot' => '-385', 'harga' => 26000000],  
            ['bobot' => '-390', 'harga' => 26400000],  

            ['bobot' => '-400', 'harga' => 27400000],  
            ['bobot' => '-410', 'harga' => 28100000],  
            ['bobot' => '-420', 'harga' => 28800000],  
            ['bobot' => '-430', 'harga' => 29500000],  
            ['bobot' => '-440', 'harga' => 30200000],  
            ['bobot' => '-450', 'harga' => 30900000],  
            ['bobot' => '-460', 'harga' => 31600000],  
            ['bobot' => '-470', 'harga' => 32200000],  
            ['bobot' => '-480', 'harga' => 32900000],  
            ['bobot' => '-490', 'harga' => 33600000],  
            ['bobot' => '-500', 'harga' => 34300000],
            
            ['bobot' => '-520', 'harga' => 35700000],  
            ['bobot' => '-540', 'harga' => 37000000],  
            ['bobot' => '-560', 'harga' => 38400000],  
            ['bobot' => '-580', 'harga' => 39800000],  
            ['bobot' => '-600', 'harga' => 41100000],  
            ['bobot' => '-620', 'harga' => 42500000],  
            ['bobot' => '-640', 'harga' => 43900000],  
        
            ['bobot' => '-680 UP', 'harga' => 46600000],
            
            ['bobot' => '22-24 kg', 'harga' => 2400000],
            ['bobot' => '25-28 kg', 'harga' => 2800000],
            ['bobot' => '29-32 kg', 'harga' => 3200000],
            ['bobot' => '33-36 kg', 'harga' => 3600000],
            ['bobot' => '37-40 kg', 'harga' => 3900000],

        ]; Bobot::insert($insertBobot); // Eloquent
     // DB::table('bobot')->insert($createMultipleRecords); // Query Builder
    

        $insertGrade = [
            ['grade' => 'HMT'], 
            ['grade' => 'A'], 
            ['grade' => 'B'], 
            ['grade' => 'C'], 
            ['grade' => 'D'], 
            ['grade' => 'E'], 
        ]; Grade::insert($insertGrade); // Eloquent
        // DB::table('grade')->insert($createMultipleRecordGrade); // Query Builder

        for ($i=1; $i <= 41 ; $i++) { // Buat mausukin data pivot tabel grade dan tabel bobot untuk Sapi dan Sapi Premium
        $grade_id = 2;
        if ($i <= 11) {
        } else if ($i <= 22){
            $grade_id = $grade_id + 1;
        } else if ($i <= 33){
            $grade_id = $grade_id + 2;
        } else if ($i < 41){
            $grade_id = $grade_id + 3;
        } else {
            $grade_id = $grade_id + 4;
        }
          GradeBobot::create(['grade_id' => $grade_id, 'bobot_id' => $i]);
        }    

        $grade_id = 0;
        for ($i = 42; $i <= 46; $i++) { // Sama seperti yang sebelumnya bedanya ini untuk Kambing dan Domba
            $grade_id = $grade_id + 1;
            GradeBobot::create(['grade_id' => $grade_id, 'bobot_id' => $i]);
        }

        for ($i = 1; $i <= 41 ; $i++) { // Buat masukin data pivot Tabel Hewan dan Tabel Bobot (Sapi dan Sapi Premium)
            for ($j = 3; $j <= 4; $j++) { 
                HewanBobot::create(['hewan_id' => $j, 'bobot_id' => $i]);
            }
        }    

        for ($i = 42; $i <= 46 ; $i++) { // Buat masukin data pivot Tabel Hewan dan Tabel Bobot (Kambing dan Domba)
            for ($j = 1; $j <= 2; $j++) { 
                HewanBobot::create(['hewan_id' => $j, 'bobot_id' => $i]);
            }
        } 

        for ($i = 2; $i <= 6 ; $i++) {
            for ($j = 3; $j <= 4; $j++) { 
                HewanGrade::create(['hewan_id' => $j, 'grade_id' => $i]);
            }
        }

        for ($i = 1; $i <= 5 ; $i++) {
            for ($j = 1; $j <= 2; $j++) { 
                HewanGrade::create(['hewan_id' => $j, 'grade_id' => $i]);
            }
        }
    }
}

