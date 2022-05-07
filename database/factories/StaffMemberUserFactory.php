<?php

namespace Eutranet\Corporate\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;
use Eutranet\Setup\Models\StaffMember;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * @extends Factory
 */
class StaffPortfolioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    #[ArrayShape(['staff_member_id' => "mixed", 'user_id' => "mixed"])] public function definition(): array
    {
        if (DB::table('staff_portfolio')->get()->count() < 1) {
            $staffIds = StaffMember::lists('id')->all(); // returns an array of all ids in the Lessons table
            $userIds = User::lists('id')->all();

            // we should actually validate that the record doesn't already exist
            return [
                'staff_member_id' => $this->faker->unique()->randomElement($staffIds),
                'user_id' => $this->faker->randomElement($userIds)
            ];
        }
        return [];
    }
}
