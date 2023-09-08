<?php

declare(strict_types=1);

use App\Enums\SchoolEnum;
use App\Models\StudentCard;
use App\Models\User;
use Carbon\Carbon;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;

it('can store a student card', function () {
    actingAs(User::factory()->create())
        ->post(
            uri: route('student-cards.store'),
            data: [
                'user_id' => $userId = User::factory()->create()->id,
                'school' => $school = fake()->randomElement(SchoolEnum::cases())->value,
                'description' => $description = Str::random(16),
                'is_internal' => $isInternal = fake()->boolean,
                'dat_of_birth' => $dob = Carbon::create('2000', '1', '1')->format('Y-m-d'),
            ]
        )->assertOk();

    assertDatabaseCount('student_cards', 1);

    $studentCard = StudentCard::first();

    expect($studentCard->user_id)->toBe($userId);
    expect($studentCard->school->value)->toBe($school);
    expect($studentCard->description)->toBe($description);
    expect($studentCard->is_internal)->toBe($isInternal);
    expect($studentCard->dat_of_birth->format('Y-m-d'))->toBe($dob);
});

it('can not store a student card', function () {
    actingAs(User::factory()->create())
        ->post(
            uri: route('student-cards.store'),
            data: [
                'description' => $description = Str::random(2),
                'dat_of_birth' => $dob = Carbon::create('2000', '1', '1')->format('d-m-Y'),
            ]
        )->assertInvalid([
            'user_id',
            'school',
            'description',
            'dat_of_birth',
        ]);

    assertDatabaseCount('student_cards', 0);
});
