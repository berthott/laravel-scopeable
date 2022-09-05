<?php

namespace berthott\Scopeable\Tests\Unit\Scopeable;

use berthott\Scopeable\Models\Traits\Scopeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityOne extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'scopeable_one_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'scopeable_one_id' => 'integer',
    ];

    /**
     * @param  mixed  $id
     * @return array
     */
    public static function rules($id): array
    {
        return [
            'name' => 'required',
            'scopeable_one_id' => 'required',
        ];
    }

    protected static function newFactory()
    {
        return EntityOneFactory::new();
    }

    public function scopeable_one()
    {
        return $this->belongsTo(ScopeableOne::class);
    }
}
