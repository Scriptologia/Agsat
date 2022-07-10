<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public static $mainLanguage = 'uk'; //основной язык, который не должен отображаться в URl

    public static $languages = ['uk', 'ru']; // Указываем, какие языки будем использовать в приложении.
    /*
     * Проверяет наличие корректной метки языка в текущем URL
     * Возвращает метку или значеие null, если нет метки
     */
    public static function getLocale()
    {
        $locale = Request()->segment(1);
        //Проверяем метку языка  - есть ли она среди доступных языков
        if (!empty($locale) && in_array($locale, self::$languages)) {
//            if ($locale !== self::$mainLanguage) return null;
            return $locale;
        }
        return null;
    }

    public static function getUrl ($locale, $url){
        $url = parse_url($url)['path'];
        $loc = explode('/',$url);
        if (!empty($loc[1]) && in_array($loc[1], self::$languages)) {
            $loc[1] = $locale;
//            if($locale === self::$mainLanguage)  unset($loc[1]);
            $url = implode("/", $loc);
            return $url ;
        }
        if ( in_array($locale, self::$languages)) {
            return $url = $locale.$url ;
        }
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
        $locale = self::getLocale();
        if($locale) app()->setLocale($locale);
        //если метки нет - устанавливаем основной язык $mainLanguage
        else app()->setLocale(self::$mainLanguage);
        return $next($request);
    }
}
