<?php

namespace App\Http\Controllers;

use App\Models\answer;
use App\Models\question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function test(){
        return "test page";
    }

    public function index(){
        return "index page";
    }

    public function add(Request $request){
        $ques=question::where('SurveyForm_id',$request['form_id'])->get();
        $d='question'.strval(1);
        $i=1;
        foreach($ques as $q){
            $ans=new answer();
            $ans->question_id=$q->id;
            $ans->answer=$request['question'.strval($i)];
            $ans->save();
            $i++;
        }

        return 1;
    }

    public function allans($formid=null){//get all answer and question for given form id
        $ques=question::select('id','title')->where('SurveyForm_id',$formid)->where('type','dropdown')->first();
        $ans=answer::where('question_id',$ques->id)->get();
        return $ans;
    }
}
