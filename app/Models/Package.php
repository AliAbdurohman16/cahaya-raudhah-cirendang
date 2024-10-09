<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Package extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'packages';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Paket')
            ->logUnguarded()
            ->setDescriptionForEvent(function (string $eventName) {
                if ($eventName == 'created') {
                    return 'Tambah Paket';
                } else if ($eventName == 'updated') {
                    return 'Ubah Paket';
                } else if ($eventName == 'deleted') {
                    return 'Hapus Paket';
                }
            });
    }

    public function Hotels()
    {
        return $this->hasMany(Hotel::class, 'package_id');
    }

    public function Transactions()
    {
        return $this->hasMany(Transaction::class, 'package_id');
    }
}
