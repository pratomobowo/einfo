<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\User;

class Activity extends Model
{
    use HasFactory, LogsActivity;

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';
    const STATUS_DISPOSED = 'disposed';
    
    // Kategori kegiatan constants
    const KATEGORI_INTERNAL = 'internal';
    const KATEGORI_EKSTERNAL = 'eksternal';

    protected $fillable = [
        'official_id',
        'original_official_id',
        'title',
        'description',
        'date',
        'time',
        'location',
        'kategori_kegiatan',
        'status',
        'assignment_letter',
        'disposition',
        'created_by',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
    ];
    
    protected $appends = [
        'formatted_time',
        'formatted_date'
    ];
    
    protected $with = ['official', 'creator'];
    
    /**
     * Get the attributes that should be excluded from the activity log.
     */
    public function getActivityLogExcludedAttributes(): array
    {
        return [
            'created_at',
            'updated_at',
            'formatted_time',
            'formatted_date',
        ];
    }

    public function official()
    {
        return $this->belongsTo(Official::class);
    }
    
    public function originalOfficial()
    {
        return $this->belongsTo(Official::class, 'original_official_id');
    }
    
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    // Accessor untuk format tanggal yang konsisten
    public function getFormattedDateAttribute()
    {
        if (!$this->date) {
            return '';
        }
        
        if ($this->date instanceof Carbon) {
            return $this->date->format('d M Y');
        }
        
        try {
            return Carbon::parse($this->date)->format('d M Y');
        } catch (\Exception $e) {
            return $this->date;
        }
    }
    
    // Accessor untuk format waktu yang benar
    public function getFormattedTimeAttribute()
    {
        if (!$this->time) {
            return '';
        }
        
        // Jika time sudah dalam format Carbon, gunakan format H:i
        if ($this->time instanceof Carbon) {
            return $this->time->format('H:i');
        }
        
        // Jika masih string, coba parse dan format
        try {
            return Carbon::parse($this->time)->format('H:i');
        } catch (\Exception $e) {
            return $this->time;
        }
    }

    // Status methods
    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }
    
    public function isApproved()
    {
        return $this->status === self::STATUS_APPROVED;
    }
    
    public function isRejected()
    {
        return $this->status === self::STATUS_REJECTED;
    }
    
    public function isDisposed()
    {
        return $this->status === self::STATUS_DISPOSED;
    }
    
    // Kategori kegiatan methods
    public function isInternal()
    {
        return $this->kategori_kegiatan === self::KATEGORI_INTERNAL;
    }
    
    public function isEksternal()
    {
        return $this->kategori_kegiatan === self::KATEGORI_EKSTERNAL;
    }
}
