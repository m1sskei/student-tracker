<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity; // CCTV 1
use Spatie\Activitylog\LogOptions; // CCTV 2

class Task extends Model
{
    // Idinagdag ang LogsActivity dito
    use HasFactory, LogsActivity;

    protected $fillable = [
        'title',
        'description',
        'priority',
        'due_date',
        'status',
        'user_id'
    ];

    // Ito ang magsasabi kung ano ang ire-record
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'status', 'priority']) // Babantayan niya kapag may nagbago dito
            ->logOnlyDirty() // Ire-record lang kapag may totoong na-edit
            ->dontSubmitEmptyLogs();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}