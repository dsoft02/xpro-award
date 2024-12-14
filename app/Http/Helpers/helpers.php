<?php

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Str;


if (!function_exists('getPageTitle')) {
    /**
     * Get site name and page title.
     *
     * @param string $pageTitle
     * @return string
     */
    function getPageTitle($pageTitle = '') {
        $siteName = 'XPRO Award 2024';
        return $pageTitle ? "{$siteName} - {$pageTitle}" : $siteName;
    }
}

if (!function_exists('isActiveRoute')) {
    /**
     * Check if the given route name is active.
     *
     * @param string|array $routeNames
     * @return string
     */
    function isActiveRoute($routeNames)
    {
        if (is_array($routeNames)) {
            return in_array(Route::currentRouteName(), $routeNames) ? 'active' : '';
        }

        return Route::currentRouteName() === $routeNames ? 'active' : '';
    }
}


function showDateTime($date, $format = 'Y-m-d h:i A')
{
    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->translatedFormat($format);
}

function urlPath($routeName, $routeParam = null)
{
    if ($routeParam == null) {
        $url = route($routeName);
    } else {
        $url = route($routeName, $routeParam);
    }
    $basePath = route('home');
    $path = str_replace($basePath, '', $url);
    return $path;
}

function showMobileNumber($number)
{
    $length = strlen($number);
    return substr_replace($number, '***', 2, $length - 4);
}

function showEmailAddress($email)
{
    $endPosition = strpos($email, '@') - 1;
    return substr_replace($email, '***', 1, $endPosition);
}

function getRealIP()
{
    $ip = $_SERVER["REMOTE_ADDR"];
    //Deep detect ip
    if (filter_var(@$_SERVER['HTTP_FORWARDED'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_FORWARDED'];
    }
    if (filter_var(@$_SERVER['HTTP_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_FORWARDED_FOR'];
    }
    if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    if (filter_var(@$_SERVER['HTTP_X_REAL_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_X_REAL_IP'];
    }
    if (filter_var(@$_SERVER['HTTP_CF_CONNECTING_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
    }
    if ($ip == '::1') {
        $ip = '127.0.0.1';
    }

    return $ip;
}



/**
 * Retrieve the settings object.
 *
 * @return object
 */
function getSettings()
{
    return Setting::getSettingsObject();
}
function getSetting($key, $default = null)
{
    return Setting::getValue($key, $default);
}

if (!function_exists('isVotingEnabled')) {
    function isVotingEnabled()
    {
        return Setting::isVotingEnabled();
    }
}


if (!function_exists('getDefaultDomains')) {
    function getDefaultDomains()
    {
        return 'gmail.com,yahoo.com,outlook.com,hotmail.com,icloud.com';
    }
}

if (!function_exists('isDeclareWinnerEnabled')) {
    function isDeclareWinnerEnabled()
    {
        return Setting::isDeclareWinnerEnabled();
    }
}

if (!function_exists('checkAndDisableVoting')) {
    function checkAndDisableVoting()
    {
        $enableVoting = Setting::getValue('enable_voting', false);
        $votingEndTime = Setting::getValue('voting_end_time');

        if ($enableVoting && ($votingEndTime && strtotime($votingEndTime) < time())) {
            Setting::updateOrCreate(['key' => 'enable_voting'], ['value' => 0]);
        }
    }
}
