<?php

namespace Database\Seeders;

use App\Models\CategorySubject;
use App\Models\Classes;
use App\Models\Major;
use App\Models\Position;
use App\Models\ppdb_payment;
use App\Models\SchoolProfile;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\student_parents;
use App\Models\Student;
use App\Models\ppdb_registrations;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatan = [
            [
                'name' => 'Administrator',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Staff IT',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Guru',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Siswa',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Alumni',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];
        Position::insert($jabatan);
        $admins = [
            [
                'name' => 'Super Admin',
                'username' => null,
                'position_id' => 1,
                'email' => 'superadmin@example.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'is_admin' => 1,
                'is_active' => 1,
                'status' => 'root',
                'password' => Hash::make('Password'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Hafed Jancok',
                'position_id' => 3,
                'username' => '000001',
                'email' => 'bagusmatali@gmail.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'is_admin' => 0,
                'is_active' => 1,
                'status' => 'user',
                'password' => Hash::make('Password000001'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        User::insert($admins);
        $teacher = [
            [
                'nip' => '000001',
                'user_id' => 2,
                'gender' => 'Laki-Laki',
                'birthdate' => '2000-05-11',
                'birthplace' => 'Boyolali',
                'phone' => '085624624663',
                'address' => 'Boyolali',
                'religion' => 'islam',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        Teacher::insert($teacher);

        $kategorimapel = [
            [
                'name' => 'UMUM',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'KHUSUS',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        CategorySubject::insert($kategorimapel);

        $major = [
            [
                'code' => 'RPL',
                'name' => 'Rekayasa Perangkat Lunak',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'code' => 'TKR',
                'name' => 'Teknik Kendaraan Ringan',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        Major::insert($major);

        $classess = [
            [
                'name' => 'A',
                'code' => 'a-rpl',
                'major_id' => 1,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'B',
                'code' => 'b-rpl',
                'major_id' => 1,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'C',
                'code' => 'c-rpl',
                'major_id' => 1,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        Classes::insert($classess);

        $mapel = [
            [
                'name' => 'Bahasa Indonesia',
                'code' => 'B Indo',
                'category_subject_id' => 1,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Bahasa Inggris',
                'code' => 'B Ing',
                'category_subject_id' => 1,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Matematika',
                'code' => 'MTK',
                'category_subject_id' => 1,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        Subject::insert($mapel);

        $sch_profile = [
            [
                'name' => 'nama Sekolah',

            ],
        ];

        SchoolProfile::insert($sch_profile);

       $stdent_parent = [
        'father_fullname' =>'hbfhf',
        'father_birthyear'=> Carbon::create(1980, 1, 31),
        'father_education'=>'hjdbjd',
        'father_occupation'=>'ksksk',
        'father_salary'=>'jdjk',
        'mother_fullname'=>'kjnjdfj',
        'mother_birthyear'=>Carbon::create(1985, 1, 31),
        'mother_education'=>'jjkdid',
        'mother_occupation'=>'njdjv',
        'mother_salary'=>'hjjdf',
       ];
       student_parents::insert($stdent_parent);

       $stdent = [
        'nis' => 123,
        'nisn' =>1234,
        'user_id'=> 2,
        'classes_id'=> 1,
        'student_parents_id'=> 1,
        'gender' => 'Laki-Laki',
        'birthdate'=> Carbon::create(2012, 1, 31),
        'birthplace'=>'fjfj',
        'phone'=>'4985460',
        'address'=>'jbdhj',
        'religion'=>'islam',
        'generation'=>'ksjk',
        'alumni'=>'2017',
       ];
       Student::insert($stdent);

       $ppdb_regis =[
        'nomor_ppdb' => '08449',
        'student_id'=> 1,
        'type'=> 'Prestasi',
        'status'=> 'Diterima',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
       ];
       ppdb_registrations::insert($ppdb_regis);

       $ppdb_pay = [
        'payment_code' => 'D87747',
        'ppdb_registrations_id' => 1,
        'payee' => 'jdkh',
        'method' => 'jdhhcd',
        'is_confirmed' =>Carbon::now()->format('Y-m-d H:i:s'),
        'payment_proof' => 'jsdksd',
       ];

       ppdb_payment::insert($ppdb_pay);
    }
}
