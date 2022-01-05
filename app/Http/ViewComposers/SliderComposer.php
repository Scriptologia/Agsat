<?php
/**
 * Created by PhpStorm.
 * User: Remteh
 * Date: 28.12.2021
 * Time: 18:59
 */

namespace App\Http\ViewComposers;
use Illuminate\View\View;
use App\Models\Slider;

class SliderComposer
{
    public function compose(View $view)
    {
        return $view->with('sliders', Slider::get());
    }
}