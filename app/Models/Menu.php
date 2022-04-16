<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const IS_ACTIVE_RADIO = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    public const LINK_TYPE_SELECT = [
        '1' => 'External Link',
        '2' => 'Article',
    ];

    public $table = 'menus';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'slug',
        'link_type',
        'external_link',
        'serial',
        'parent',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function menuArticles()
    {
        return $this->hasOne(Article::class, 'menu_id', 'id');
    }

    public function positions()
    {
        return $this->belongsToMany(Position::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

public static function parent($id){
        $menus = Menu::where('is_active',1)->where('parent',$id)->orderBy('serial','asc')->get();
        if(count($menus)>0){
            return $menus;
        }else{
            return false;
        }
}
    public function subChildren()
    {
        return $this->hasMany(Menu::class, 'parent', 'id');
    }

    public static function menus()
    {
        return Menu::where('is_active',1)->where('parent',0)->get();
    }
}
