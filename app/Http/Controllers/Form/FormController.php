<?php

namespace App\Http\Controllers\Form;

use App\Answer;
use App\Exceptions\FormNotFoundException;
use App\Form;
use App\FormAnswer;
use App\Http\Controllers\Controller;
use App\Question;
use App\User;
use App\Http\Requests\FormCreateRequest;
use FPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Exception;

class FormController extends Controller
{
    // Метод загрузки анкет пользователя
    public function list () {
        $forms = Form::getMyForm();

        return view('form.list', ['forms' => $forms]);
    }

    // Метод загрузки анкеты
    public function show ($formID) {
        $form = Form::findOrFail($formID);
        $questions = Question::getForm($formID)->get();
        return view('form.show', ['form' => $form, 'questions' => $questions]);
    }

    // Метод загрузки страницы создании формы
    public function create () {
        return view('form.create');
    }

    // Метод сохранения созданной формы
    public function save (FormCreateRequest $request){

        // Создаем форму
        $form = Form::create([
            'title' => $request->title,
            'user_id' => Auth::id()
        ]);

        // Создаем вопросы
        foreach ($request->questions as $key => $question) {
            if ($question != null) {
                Question::create([
                    'form_id' => $form->id,
                    'order' => $key,
                    'text' => $question
                ]);
            }
        }

        // Перенаправляем на страницу со списком созданных форм пользователя
        return redirect()->route('form.my');


    }

    //  Метод сохранения ответов на форму
    public function saveAnswer (Request $request, $formID) {

        // Создаем реакцию на форму
        $formAnswer = FormAnswer::create([
            'form_id' => $formID
        ]);

        // ID созданной реакции
        $formAnswerID = $formAnswer->id;

        // Вопросы в форме
        $questions = Form::find($formID)->questions()->get()->toArray();

        // Перебираем ответы, не пустые привязываем к реации на форму и сохраняем
        foreach ($request->answers as $key => $answer) {

            // Дан ли ответ на вопрос
            if ($answer == null) continue;

            // ID вопроса в форме на накоторый был ответ
            $questionID = $questions[$key]['id'];

            // Создаем ответ
            Answer::create([
                'text' => $answer,
                'question_id' => $questionID,
                'form_answer_id' => $formAnswerID,
            ]);
        }

        // Перенаправляем на заглушку
        return redirect()->route('form.thanks');
    }

    // Метод загрузки реакций на форму
    public function formAnswers ($formID) {

        $form = Form::findOrFail($formID);
        $dataForm = $form->get()->first();

        // Проверяем является ли юзер создателем формы
        if (Auth::id() != $dataForm->user_id)
            return redirect()->route('form.my');

        // Получаем реакции связанные с юзером, сортируем по убыванию ID (Сначало идут последние созданные)
        $formAnswers = $form->formAnswers()->get()->sortByDesc('id');

        return view('form.listAnswers', [
                'formID' => $formID,
                'formAnswers' => $formAnswers
        ]);

    }

    private function getAnswersAndQuestions() {
        return "test";
    }

    // Метод сохранения ответов реации в PDF
    public  function saveAnswersPdf ($FormAnswerID) {

        // Реакция на форму
        $formAnswer = FormAnswer::find($FormAnswerID);

        // Данные формы связанной с реацией
        $dataForm = $formAnswer->form()->get()->first();

        // ID формы на которую была реакции
        $formID = $dataForm->id;

        // Проверяем является ли юзер создателем формы
        if (Auth::id() != $dataForm->user_id)
            return redirect()->route('form.my');

        // Ответы в реакции
        $answers = $formAnswer->answers()->get()->toArray();;

        // Вопросы из формы
        $questions = $formAnswer->questions()->get();

        // Заголовок формы
        $title = $dataForm->title;

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->AddFont('Arial','','arial.php');
        $pdf->SetFont('Arial');

        $text = '';
        $br = "\n";

        $text .= "Ответ ID: " . $FormAnswerID . " На форму ID: " . $formID . $br;
        $text .= $title . $br;
        $text .= $br;

        foreach ($questions as $key => $question) {
            $text .= $question->text . $br;
            $text .= $answers[$key]['text'] . $br;
            $text .= $br;
        }

        $pdf->Write(5,iconv('utf-8', 'windows-1251', $text));
        $pdf->output();
    }


    // Метод загрузки ответов в реакции на форму
    public function formAnswer ($FormAnswerID) {

        // Реакция на форму
        $formAnswer = FormAnswer::find($FormAnswerID);

        // Данные формы связанной с реацией
        $dataForm = $formAnswer->form()->get()->first();

        // ID формы на которую была реакции
        //$formID = $dataForm->id;

        // Проверяем является ли юзер создателем формы
        if (Auth::id() != $dataForm->user_id)
            return redirect()->route('form.my');

        // Ответы в реакции
        $answers = $formAnswer->answers()->get();

        // Вопросы из формы
        $questions = $formAnswer->questions()->get();

        // Заголовок формы
        $title = $dataForm->title;

        return view('form.showAnswer', [
            'formAnswerID' => $FormAnswerID,
            'title' => $title,
            'questions' => $questions,
            'answers' => $answers
        ]);
    }

    // Метод удаления формы по ID
    public function formDelete ($formID) {

        $form = Form::find($formID);

        // Проверяем является ли юзер создателем формы
        if (Auth::id() != $form->user_id)
            return redirect()->route('form.my');

        // Реакции на форму
        $formAnswers = $form->formAnswers();

        // По ID реакции ищем ответы и удаляем
        foreach ($formAnswers->get() as $formAnswer) {
            Answer::where('form_answer_id', $formAnswer->id)->delete();
        }

        // Удаляем реакции
        $formAnswers->delete();

        // Удаляем вопросы в форме
        Question::where('form_id', $formID)->delete();

        // Удаляем форму
        Form::destroy($formID);

        return redirect()->route('form.my');
    }
}
