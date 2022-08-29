<?php
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\UserRole;


class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	

		DB::table('users')->insert([
            [

				'name' => 'Super Admin',
				'first_name' => 'App',
				'last_name' => 'Super Admin',
				'email' => 'superadmin@cps.com',
				'phone' => '123456789',
				'role' => 1,
				'password' => bcrypt('admin123@admin'),
            ]
		]);

		DB::table('user_roles')->insert([
			'name' => 'Super Admin',
			'slug' => 'super_admin'
		]);
		DB::table('user_roles')->insert([
			'name' => 'Standard User',
			'slug' => 'standard_user'
		]);
		DB::table('user_roles')->insert(
		[
			'name' => 'Student - Homeschool High School',
			'slug' => 'student_homeschool_high_school'
		]);
		DB::table('user_roles')->insert([
			'name' => 'Student - Private High School',
			'slug' => 'student_private_high_school'
		]);
		DB::table('user_roles')->insert([
			'name' => 'Student - Online High School',
			'slug' => 'student_online_high_school'
		]);
		DB::table('user_roles')->insert([
			'name' => 'Parent - High School',
			'slug' => 'parent_high_school'
		]);
		DB::table('user_roles')->insert([
			'name' => 'CPS Administrator - Manager',
			'slug' => 'cps_administrator_manager'
		]);
		DB::table('user_roles')->insert([
			'name' => 'College Advisor - High School',
			'slug' => 'college_advisor_high_school'
		]);
		DB::table('user_roles')->insert([
			'name' => 'College Advisor - Independent',
			'slug' => 'college_advisor_independent'
		]);
		DB::table('user_roles')->insert([
			'name' => 'Tutor',
			'slug' => 'tutor'
		]);
		DB::table('user_roles')->insert([
			'name' => 'District Administrator',
			'slug' => 'district_administrator'
		]);
		DB::table('user_roles')->insert([
			'name' => 'Principal - High School',
			'slug' => 'principal_high_school'
		]);
		DB::table('user_roles')->insert([
			'name' => 'Assistant Principal - High School',
			'slug' => 'assistant_principal_high School'
		]);
		DB::table('user_roles')->insert([
			'name' => 'School Administrator - Manager',
			'slug' => 'school_administrator_manager'
		]);
		DB::table('user_roles')->insert([
			'name' => 'School Administrator',
			'slug' => 'school_administrator'
		]);
		DB::table('user_roles')->insert([
			'name' => 'Counselor - High School',
			'slug' => 'counselor_high_school'
		]);
		DB::table('user_roles')->insert([
			'name' => 'Department Chair Teacher - High School',
			'slug' => 'department_chair_teacher_high_school'
		]);
		DB::table('user_roles')->insert([
			'name' => 'Faculty - High School',
			'slug' => 'faculty_high_school'
		]);
    }
}
