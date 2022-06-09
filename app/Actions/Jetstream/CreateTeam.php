<?php

namespace App\Actions\Jetstream;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\CreatesTeams;
use Laravel\Jetstream\Jetstream;

class CreateTeam implements CreatesTeams
{
    /**
     * Validate and create a new team for the given user.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return mixed
     */
    public function create($user, array $input)
    {
        Gate::forUser($user)->authorize('create', Jetstream::newTeamModel());

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
        ])->validateWithBag('createTeam');

        return $user->ownedTeams()->create([
            'name' => $input['name'],
            'personal_team' => false,
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
            'name_widget' => $input['name']
        ]);
    }
}
