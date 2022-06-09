<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'firstname' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'firstname' => $input['firstname'],
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) {
                $this->createTeam($user);
            });
        });
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]." Przychodnia",
            'personal_team' => true,
            'id_pack' => 0,
            'pack_sms' => 0,
            'pack_email' => 0,
            'switch_sms' => 1,
            'switch_email' => 1,
            'sms_clock' => 36,
            'email_clock' => 48,
            'sms_text' => 'Informujemy, że dnia {date_visit} o godz. {clock_visit} jest pan/i umówiona w przychodni {name} u lekarza {dr_name} na wizytę.',
            'email_text' => 'Informujemy, że dnia {date_visit} o godz. {clock_visit} jest pan/i umówiona w przychodni {name} u lekarza {dr_name} na wizytę. Wizytę można anulować telefoniczne lub poprzez link poniżej. {cancel_visit}',
            'switch_widget' => 1,
            'delete_visit_widget' => 1,
            'logo_widget' => '',
            'name_widget' => explode(' ', $user->name, 2)[0]." Przychodnia",
        ]));
    }
}
