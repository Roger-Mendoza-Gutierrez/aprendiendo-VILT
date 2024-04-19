<?php

namespace App\Models;

use Faker\Core\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color',
    ];

    public static function getAvailableBackgroundColor(){
        $elements = json_decode(
            file_get_contents(resource_path('json/customization.json'))
        );

        return $elements->backgrounds;
    }
}
