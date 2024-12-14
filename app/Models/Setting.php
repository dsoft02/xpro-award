<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';
    protected $fillable = ['key', 'value'];

    // Retrieve a setting's value with caching and optional default fallback
    public static function getValue(string $key, mixed $default = null): mixed
    {
        $default = $default ?? config("settings.{$key}");
        return Cache::remember("setting_{$key}", 60, function () use ($key, $default) {
            $setting = self::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    // Retrieve all settings as an object
    public static function getSettingsObject(): \stdClass
    {
        $settings = Cache::remember('general_settings', 60, function () {
            return self::all()->pluck('value', 'key')->toArray();
        });

        return (object) $settings;
    }

    // Dynamically set or update a setting
    public static function setValue(string $key, mixed $value): void
    {
        self::updateOrCreate(['key' => $key], ['value' => $value]);
        self::clearCache($key);
    }

    // Check if a specific setting is enabled
    public static function isVotingEnabled(): bool
    {
        return (bool) self::getValue('enable_voting', false);
    }

    public static function isDeclareWinnerEnabled(): bool
    {
        return (bool) self::getValue('declare_winner', false);
    }

    // Clear cache for a specific setting or all settings
    public static function clearCache(string $key = null): void
    {
        if ($key) {
            Cache::forget("setting_{$key}");
        }
        Cache::forget('general_settings');
    }

    // Override the save method to clear cache automatically
    public function save(array $options = []): bool
    {
        $result = parent::save($options);
        self::clearCache($this->key);
        return $result;
    }

    // Override the delete method to clear cache automatically
    public function delete(): bool
    {
        self::clearCache($this->key);
        return parent::delete();
    }
}
