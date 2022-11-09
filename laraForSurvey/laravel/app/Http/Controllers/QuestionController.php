<?php

namespace App\Http\Controllers;

use App\Models\booleanValues;
use App\Models\question;
use App\Models\choice;
use App\Models\SurveyForm;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    function test($formid = null)
    {
        return $formid;
    }

    function index()
    {
        return "bye";
    }

    function add(Request $request)
    {
        $q = new question();
        $q->questionId = $request->id;
        $q->title = $request->title;
        $q->type = $request->type;
        $q->isRequired = $request->isRequired;
        $q->SurveyForm_id = $request->SurveyForm_id;
        $q->save();
        if ($request->type == 'dropdown' || $request->type == 'radiogroup') {
            foreach ($request->choices as $c) {
                $choice = new choice();
                $choice->question_id = $q->id;
                $choice->value = $c['value'];
                $choice->text = $c['text'];
                $choice->save();
            }
        }

        if ($request->type == 'boolean') {
            $b = new booleanValues();
            $b->labelTrue = $request->labelTrue;
            $b->labelFalse = $request->labelFalse;
            $b->question_id = $q->id;
            $b->save();
        }

        $arr = array("status" => "success");
        return json_encode($arr);
    }

    function getquestion($formid = null)
    {
        $q = question::where("SurveyForm_id", $formid)->get();
        $index = 0;
        foreach ($q as $item) {

            if ($item->type == "dropdown" || $item->type == 'radiogroup') {
                $a = json_decode($item, TRUE);
                $choice = choice::where("question_id", $item->id)->get();
                $a["choices"] = [];
                foreach ($choice as $c) {
                    array_push($a["choices"], ["value" => $c->value, "text" => $c->text]);
                }
                $q[$index] = $a;
            }

            if ($item->type == 'boolean') {
                $boo = booleanValues::where('question_id', $item->id)->get();
                foreach ($boo as $b) {
                    $item['labelFalse'] = $b['labelFalse'];
                    $item['labelTrue'] = $b['labelTrue'];
                }
            }

            $index++;
        }
  
        return $q;
    }
}
