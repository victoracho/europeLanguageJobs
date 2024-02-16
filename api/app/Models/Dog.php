<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    use  HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'breed',
        'photo',
        'size',
        'hair',
        'classifier_id',
    ];
    public function classification()
    {
        return $this->hasOne(DogClassifier::class, 'id', 'classifier_id');
    }
}
