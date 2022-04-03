<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\SlidersController;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Link;
use App\Models\LinkCategory;
use App\Models\Menu;
use App\Models\Position;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $sliders = Slider::where('is_active','1')->get();
        $about = ArticleCategory::find(1);
        $service = ArticleCategory::find(2);
        $career_resource_menu = Position::find(4);
        $skill_resource_menu = Position::find(5);
        return view('theme.home',compact('sliders','about','service','career_resource_menu','skill_resource_menu'));
    }

    public function aToZ(){
        $category =  LinkCategory::with('linkCategoryLinks')->where('id',12)->first();
        return view('theme.a-to-z',compact('category'));
    }



}
