<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Battle extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function entities(): Battle
    {
        $entitiesInCombat = Entity::query()->whereIn('id', json_decode($this->entities_in_combat))->get();

        $this->entities = $entitiesInCombat;

        return $this;
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
