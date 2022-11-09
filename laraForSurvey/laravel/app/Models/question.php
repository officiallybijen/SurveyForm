<?php

namespace App\Models;

use App\Models\SurveyForm;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    use HasFactory;

    public function SurveyForm(){
        return $this->belongsTo(SurveyForm::class);
    }
}
