<?php
/**
 * Created by PhpStorm.
 * User: Remteh
 * Date: 28.12.2021
 * Time: 18:59
 */

namespace App\Http\ViewComposers;
use App\Models\Company;
use Illuminate\View\View;

class FooterComposer
{
    public function compose(View $view)
    {
        return $view->with('company' , Company::first());
    }
}