<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Position extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public const IS_ACTIVE_RADIO = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    public $table = 'positions';

    protected $appends = [
        'image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'content',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function positionMenus()
    {
        return $this->belongsToMany(Menu::class)->where('is_active','1')->orderBy('serial','asc');
    }

    public function positionRootMenus()
    {
        return $this->belongsToMany(Menu::class)->where('parent','0')->where('is_active','1')->orderBy('serial','asc');
    }

    public function getImageAttribute()
    {
        $file = $this->getMedia('image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public static function positionWiseMenu($id){
        $position = Position::find($id);
        return $position->positionMenus;
    }

    public static function positionWiseRootMenu($id){
        $position = Position::find($id);
        return $position->positionRootMenus;
    }
}
