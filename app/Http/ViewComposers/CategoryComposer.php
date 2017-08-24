<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\UserRepository;

use App\Models\Category;

class CategoryComposer
{
    public function compose(View $view)
    {
        //获取分类
        $category_header = Category::orderBy('order')->get();
        $view->with('category_header' , $category_header);
    }
}
