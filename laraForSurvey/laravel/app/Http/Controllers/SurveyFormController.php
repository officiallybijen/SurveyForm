<?php

namespace App\Http\Controllers;

use App\Models\SurveyForm;
use Illuminate\Http\Request;

class SurveyFormController extends Controller
{
    public function test(){
        return "hello";
    }

    function add(Request $request){
        $s=new SurveyForm();
        $s->title=$request->title;
        $s->description=$request->description;
        $s->save();
        $arr = array('id' => $s->id);
        return json_encode($arr);
    }

    function index(){
        $allForm=SurveyForm::all();
        return $allForm;
    }

    function detail($formid=null){
        $survery=SurveyForm::find($formid);
        $title=$survery->title;
        $description=$survery->description;
        $a=["title"=>$title,"description"=>$description];
        return json_encode($a);
    }
}
