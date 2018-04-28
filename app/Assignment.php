<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Image;

class Assignment extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'gender',
        'date_of_birth',
        'biography',
        'profile_picture',
        'created_at',
        'updated_at',
    ];

    public function age()
    {
        $dt = new Carbon();
        $before = $dt->subYears(13)->format('Y-m-d');
        return $before;
    }
    public function uploadImg($imageData)
    {
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        Image::make($imageData)->save(public_path('uploads/') . $fileName);
        return "uploads/" . $fileName;
    }
}
