<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\SlidersController;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Link;
use App\Models\LinkCategory;
use App\Models\Menu;
use App\Models\Partner;
use App\Models\Position;
use App\Models\Slider;
use App\Models\Social;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $sliders = Slider::where('is_active','1')->get();
        $about = ArticleCategory::find(1);
        $service = ArticleCategory::find(2);
        $career_resource_menu = Position::find(4);
        $skill_resource_menu = Position::find(5);
        $partners = Partner::where('is_active','1')->get();
        $socials = Social::where('is_active','1')->get();
        return view('theme.home',compact('sliders','about','service','career_resource_menu','skill_resource_menu','partners','socials'));
    }

public function articleDetails($slug){
    $menu = Menu::where('slug',$slug)->first();


    if ($menu!=null){
        $article = Article::where('menu_id',$menu->id)->first();

        if ($article!=null){
            return view('theme.article-details',compact('article'));
        }
        else{
            return redirect(route('error404'));
        }
    }else{
        return redirect(route('error404'));
    }
}

public function error404(){
    return view('theme.404');
}
}
