<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Document extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'documents';

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
            ->useLogName('Dokumen')
            ->logUnguarded()
            ->setDescriptionForEvent(function (string $eventName) {
                if ($eventName == 'created') {
                    return 'Tambah Dokumen';
                } else if ($eventName == 'updated') {
                    return 'Ubah Dokumen';
                } else if ($eventName == 'deleted') {
                    return 'Hapus Dokumen';
                }
            });
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
