<?php

namespace app\Http\Controllers\Admin;

use App\Answer;
use App\Helpers\functions;
use App\Option;
use App\Question;
use App\Questionnaire;
use App\Submit;

class QuestionnaireManagementController {
    public function listOfQuestionnaires() {
        $questionnaires = Questionnaire::getAllQuestionnaires();
        return view('Questionnaire.list', ['questionnaires' => $questionnaires]);
    }

    public function deletedList() {
        $questionnaires = Questionnaire::getDeletedList();
        return view('Questionnaire.deletedList', ['questionnaires' => $questionnaires]);
    }

    public function check($qnid) {
        header("Location:https://survey.twtstudio.com/answer/".$qnid);
        exit;
    }

    public function softDelete($qnid) {
        Questionnaire::softDeleteByQnid($qnid);
        functions::popup("隐藏成功");
        functions::skip(url('admin/questionnaire/list'));
    }

    public function restore($qnid) {
        Questionnaire::restore($qnid);
        functions::popup("恢复成功");
        functions::skip(url('admin/questionnaire/deletedList'));
    }

    public function forceDelete($qnid, $src = null) {
        Questionnaire::forceDeleteByQnid($qnid);
        functions::popup("删除成功");
        if ($src) {
            functions::skip(url('admin/questionnaire/list'));
        } else {
            functions::skip(url('admin/questionnaire/deletedList'));
        }
    }
}