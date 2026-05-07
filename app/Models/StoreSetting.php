<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreSetting extends Model
{
    protected $table = 'store_settings';
    protected $fillable = ['key', 'value'];

    /**
     * Get all settings as a key => value associative array.
     */
    public static function getAllSettings(): array
    {
        return self::pluck('value', 'key')->toArray();
    }

    /**
     * Get a single setting value by key.
     */
    public static function get(string $key, string $default = ''): string
    {
        return self::where('key', $key)->value('value') ?? $default;
    }

    /**
     * Set (upsert) a setting value by key.
     */
    public static function set(string $key, string $value): void
    {
        self::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
