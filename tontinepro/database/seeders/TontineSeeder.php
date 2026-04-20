<?php

namespace Database\Seeders;

use App\Models\Cycle;
use App\Models\Payment;
use App\Models\Tontine;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TontineSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::create([
            'name'     => 'Admin Togo',
            'email'    => 'admin@iai.tg',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
        ]);

        // Membres
        $members = collect([
            ['name' => 'Akossiwa Koffi',   'email' => 'akossiwa@iai.tg'],
            ['name' => 'Kodjo Mensah',      'email' => 'kodjo@iai.tg'],
            ['name' => 'Afi Amétowobla',    'email' => 'afi@iai.tg'],
            ['name' => 'Komlan Agbéko',     'email' => 'komlan@iai.tg'],
        ])->map(fn($data) => User::create([
            ...$data,
            'password' => Hash::make('password123'),
            'role'     => 'member',
        ]));

        // Tontine
        $tontine = Tontine::create([
            'name'             => 'Tontine des Amis IAI 2026',
            'amount_per_cycle' => 25000,
            'frequency'        => 'mensuel',
            'status'           => 'active',
        ]);

        // Attacher les membres avec leur ordre de bénéfice
        $pivotData = [];
        foreach ($members as $index => $member) {
            $pivotData[$member->id] = [
                'beneficiary_order' => $index + 1,
                'joined_at'         => now(),
            ];
        }
        $tontine->members()->attach($pivotData);

        // Cycle 1 (clôturé) — Akossiwa a bénéficié
        $cycle1 = Cycle::create([
            'tontine_id'          => $tontine->id,
            'cycle_number'        => 1,
            'beneficiary_user_id' => $members[0]->id,
            'opened_at'           => now()->subDays(35),
            'closed_at'           => now()->subDays(5),
        ]);

        // Paiements cycle 1
        foreach ($members as $index => $member) {
            Payment::create([
                'cycle_id' => $cycle1->id,
                'user_id'  => $member->id,
                'amount'   => 25000,
                'paid_at'  => $index < 3 ? now()->subDays(20) : null,
                'status'   => $index < 3 ? 'payé' : 'en retard',
            ]);
        }

        // Cycle 2 (en cours) — Kodjo est le bénéficiaire
        $cycle2 = Cycle::create([
            'tontine_id'          => $tontine->id,
            'cycle_number'        => 2,
            'beneficiary_user_id' => $members[1]->id,
            'opened_at'           => now()->subDays(4),
            'closed_at'           => null,
        ]);

        // 2 membres ont déjà payé ce cycle
        Payment::create([
            'cycle_id' => $cycle2->id,
            'user_id'  => $members[0]->id,
            'amount'   => 25000,
            'paid_at'  => now()->subDays(2),
            'status'   => 'payé',
        ]);
        Payment::create([
            'cycle_id' => $cycle2->id,
            'user_id'  => $members[2]->id,
            'amount'   => 25000,
            'paid_at'  => now()->subDay(),
            'status'   => 'payé',
        ]);
    }
}
