<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Transaction extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'transactions';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Transaksi')
            ->logUnguarded()
            ->setDescriptionForEvent(function (string $eventName) {
                if ($eventName == 'created') {
                    return 'Tambah Transaksi';
                } else if ($eventName == 'updated') {
                    return 'Ubah Transaksi';
                } else if ($eventName == 'deleted') {
                    return 'Hapus Transaksi';
                }
            });
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
