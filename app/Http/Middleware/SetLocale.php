<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public static $mainLanguage = 'uk'; //основной язык, который не должен отображаться в URl

    public static $languages = ['uk', 'ru']; // Указываем, какие языки будем использовать в приложении.

    public static function getLocale()
    {
        $locale = Request()->segment(1);
        if (!empty($locale) && in_array($locale, self::$languages) && $locale !== self::$mainLanguage) {
            return $locale;
        }
        return '';
    }

    public static function getUrl ($locale) {
        app()->setLocale($locale);
        $url = url()->previous();
        $url = parse_url($url)['path'];
        $loc = explode('/',$url);
        if (!empty($loc[1]) && in_array($loc[1], self::$languages) ) {
            $loc[1] = $locale;
            if($locale === self::$mainLanguage) {
                unset($loc[1]);
            }
            $url = implode("/", $loc);
        }
        else {
            if($locale === self::$mainLanguage) {
                $locale = '';
            }
            $url = $locale.implode("/", $loc);
        }
        return $url;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        $locale = ltrim(Request()->route()->getPrefix(), '/');
        $locale = self::getLocale();
        if($locale) app()->setLocale($locale);
        else app()->setLocale(self::$mainLanguage);
        return $next($request);
    }
}
