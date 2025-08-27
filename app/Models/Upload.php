<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Upload extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'original_filename',
        'stored_filename',
        'file_path',
        'file_size',
        'status',
    ];
}
