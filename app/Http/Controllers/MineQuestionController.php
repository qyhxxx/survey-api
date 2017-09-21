<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Submit;
use Illuminate\Http\Request;
use App\Questionnaire;
use App\Question;
use App\Option;
use App\Usr;
use App\Editor;
use BaconQrCode\Encoder\QrCode;

class MineQuestionController extends Controller
{
    //问卷缩略图页面
    public function mine(Request $request){
        $order_status = $request->input('order_status');
        $order_sequence = $request->input('order_sequence');
        $twt_name = $request->session()->get('data')['twt_name'];
        $questionnaires =Editor::questionnaires($twt_name);
        $id = null;
        $questionnaire = null;
        foreach ($questionnaires as $val) {
            $id = $val->qnid;
        }
        if($id != null) {
            $questionnaire = Questionnaire::sequence($order_status, $order_sequence, $id);
            return response()->json([
                'questionnaire' => $questionnaire,
            ]);
        }
        // return view('minequestion.mine');
    }
    //问卷缩略图页面搜索问卷
    public function reach(Request $request){
        $data = $request->input('data');
        $find = Questionnaire::reach($data);
        if(!$find){
            return redirect('/minequestion/false');
        }  //报错页面
        return response()->json([
            'find' => $find,
        ]);
    }
    //问卷展开[概述、设置]
    public function overview($qnid, Request $request){
        $questionnaire_data = Questionnaire::getdata($qnid);
        $questions = Question::getquestions($qnid);
        $editors = Editor::getdata($qnid);
        $submit_answers = Submit::answers($qnid);     //qu的有问题！
        $count_answers = count($submit_answers);
        $answers = Answer::getanswers($qnid);
        $everyday_ans = 0;
        $answer = null;
        if(!empty($answers)){
            foreach ($answers as $val){
                $addtime = $val->created_at;
                $everyday_ans["$addtime"]++;
                $answer[$val->twt_name] = new \app\Common\answer($val->answer);  //hhh
            }
        }
        if($request->isMethod('POST')){
            $hasnumber = $request->input('hasnumber');
            $recovery_at = $request->input('recovery_at');
            $ischecked = $request->input('ischecked');
            $onceanswer = $request->input('onceanswer');
            $allkilled = $request->input('allkilled');
            $partkilled = $request->input('partkilled');
            $install = [
                'hasnumber' => $hasnumber,
                'recovery_at' => $recovery_at,
                'ischecked' => $ischecked,
                'onceanswer' => $onceanswer,
            ];
            $install_add = Questionnaire::update_install($qnid,$install);
            $twt_name = $request->input('twt_name');
            $editor_add = Editor::add($twt_name, $qnid);
            if($allkilled){
                Answer::allkilled();
            }
            if($partkilled){
                Answer::partkilled($partkilled);
            }
        }
        return response()->json([
            'questionnaire_data' => $questionnaire_data,
            'questions' => $questions,
            'editors' => $editors,
            'answers' => $answer,
            'count_answers' => $count_answers,
            'everyday_ans' => $everyday_ans,
        ]);
    }
    //问卷展开[数据]
    public function answerdata($qnid,Request $request){
        $qid = $request->input('qid');
        $question = Question::getonequestion($qnid,$qid);
        $option = Option::getQcontentsByQid($qid);
        $option_amount = count($option);
        $answers = Answer::getdata($qid);
        $answers_amount = count($answers);
        foreach ($answers as $val){
            $answers_amount[$val->order]++;
        }
        return response()->json([
            'question' => $question,
            'option' => $option,
            'answers_amount' => $answers_amount,
        ]);
    }
    //发布(二维码)
    public function publish($qnid){
        $QrCode = QrCode::encoding('UTF-8')->size(100)->generate(public_path('/submit/qnid/{qnid}'));
        return response()->json([
            'QrCode' => $QrCode,
        ]);
    }



}