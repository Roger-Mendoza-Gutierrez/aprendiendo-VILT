<?php

namespace App\Models;

use Faker\Core\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'color',
        'color',
        'icon_name',
    ];

    public static function getAvailableTextColor()
    {
        $elements = json_decode(
            file_get_contents(resource_path('json/customization.json'))
        );

        return $elements->texts;
    }

    public static function getAvailableIcons()
    {
        $elements = json_decode(
            file_get_contents(resource_path('json/customization.json'))
        );

        return $elements->icons;
    }
}
