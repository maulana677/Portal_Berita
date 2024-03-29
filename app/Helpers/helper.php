<?php

use App\Models\Language;
use App\Models\Setting;
use PhpParser\Node\Expr\Cast\String_;

/** format tag berita */
function formatTags(array $tags): String
{
    return implode(',', $tags);
}

/** get selected language from session */
function getLanguage(): string
{
    if (session()->has('language')) {
        return session('language');
    } else {
        try {
            $language = Language::where('default', 1)->first();
            setLanguage($language->lang);

            return $language->lang;
        } catch (\Throwable $th) {
            setLanguage('en');

            return $language->lang;
        }
    }
}

/** set language code in session */
function setLanguage(string $code): void
{
    session(['language' => $code]);
}

/** truncate text */
function truncate(string $text, int $limit = 50): String
{
    return \Str::limit($text, $limit, '...');
}

/** convert a number in K format */
function convertToKFormat(int $number): String
{
    if ($number < 1000) {
        return $number;
    } elseif ($number < 1000000) {
        return round($number / 1000, 1) . 'K';
    } else {
        return round($number / 1000000, 1) . 'M';
    }
}

/** make Sidebar Active */
function setSidebarActive(array $routes): ?string
{
    foreach ($routes as $route) {
        if (request()->routeIs($route)) {
            return 'active';
        }
    }
    return '';
}

/** get setting */
function getSetting($key)
{
    $data = Setting::where('key', $key)->first();
    return $data->value;
}

/** check permission */
function canAccess(array $permissions)
{
    $permission = auth()->guard('admin')->user()->hasAnyPermission($permissions, 'admin');
    $superAdmin = auth()->guard('admin')->user()->hasRole('Super Admin');

    if ($permission || $superAdmin) {
        return true;
    } else {
        return false;
    }
}

/** get admin role */
function getRole()
{
    $role = auth()->guard('admin')->user()->getRoleNames();
    return $role->first();
}

/** check user permissions */
function checkPermission(string $permission)
{
    return auth()->guard('admin')->user()->hasPermissionTo($permission);
}
