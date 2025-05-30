<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decree extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'nomor_sk',
        'jenis_sk',
        'category_id',
        'tentang',
        'deskripsi',
        'file_sk',
        'tanggal_terbit',
        'tanggal_berlaku',
        'ditandatangani_oleh',
    ];

    protected $casts = [
        'tanggal_terbit' => 'date',
        'tanggal_berlaku' => 'date',
    ];

    // Konstanta untuk jenis SK
    const JENIS_YAYASAN = 'SK Yayasan';
    const JENIS_REKTORAT = 'SK Rektorat';

    public static function jenisOptions()
    {
        return [
            self::JENIS_YAYASAN => 'SK Yayasan',
            self::JENIS_REKTORAT => 'SK Rektorat',
        ];
    }

    /**
     * Get the category that owns the decree.
     */
    public function category()
    {
        return $this->belongsTo(DecreeCategory::class, 'category_id');
    }

    public function getFormattedTanggalAttribute()
    {
        return $this->tanggal_terbit ? Carbon::parse($this->tanggal_terbit)->locale('id')->isoFormat('D MMMM YYYY') : '';
    }
    
    public function getFormattedTanggalBerlakuAttribute()
    {
        return $this->tanggal_berlaku ? Carbon::parse($this->tanggal_berlaku)->locale('id')->isoFormat('D MMMM YYYY') : '';
    }
    
    public function isYayasan()
    {
        return $this->jenis_sk === self::JENIS_YAYASAN;
    }
    
    public function isRektorat()
    {
        return $this->jenis_sk === self::JENIS_REKTORAT;
    }

    /**
     * Get the attributes that should be excluded from the activity log.
     */
    public function getActivityLogExcludedAttributes(): array
    {
        return [
            'created_at',
            'updated_at',
        ];
    }
}
