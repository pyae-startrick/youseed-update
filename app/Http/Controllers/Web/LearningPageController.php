<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Quiz;
use App\Models\QuizzesResult;
use App\Models\Session;
use App\Models\TextLesson;
use App\Models\Webinar;
use App\Models\WebinarChapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LearningPageController extends Controller
{
    public function index(Request $request, $slug)
    {
        $webinarController = new WebinarController();

        $data = $webinarController->course($slug, true);
        // if (!$data or !$data['hasBought']) {
        //     abort(403);
        // }
        $datas = [];
        // dd($data);
        foreach ($data as $value) {
            array_push($datas, $value);
        }
        // dd($datas[11][0]);
        $meetingID = json_decode($datas[11][0]->sessions[0]->id);
        // dd($meetingID);
        // $className = Webinar::where('id', $webinarID)
        // dd($meetingID);
        $meetings = \Bigbluebutton::getRecordings([
            'meetingID' => $meetingID,
            // 'meetingID' => ['tamku','xyz'], //pass as array if get multiple recordings 
            // 'recordID' => 'a3f1s',
            // 'recordID' => ['xyz.1','pqr.1'], //pass as array note :If a recordID is specified, the meetingID is ignored.
            'state' => 'any' // It can be a set of states separate by commas  
        ]);
        // dd(implode(',',$meetingID));

        $get_meetings = json_decode($meetings);
        // ddd($get_meetings);
        // $mil = $get_meetings[0]->startTime;
        // $seconds = $mil / 1000;
        // $date = date("d/m/Y H:i:s", $seconds); 

        // $session = Session::where('id', 112)
        //     ->where('status', WebinarChapter::$chapterActive)
        //     ->first();
        //     // dd($session);
        // $webinar = Webinar::where('id', $session->webinar_id)->first();
        // dd($webinar->slug);
        $user = auth()->user();

        // , compact('get_meetings','meetingID')
        return view('web.default.course.learningPage.index', compact('get_meetings', 'meetingID','user'))->with($data);
    }

    public function deleteRecording($id)
    {
        \Bigbluebutton::deleteRecordings([
            'recordID' => $id,
            // 'recordID' => ['a3f1s','a4ff2'] //pass array if multiple delete recordings
        ]);
        return redirect()->back();
    }

    public function getItemInfo(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'type' => 'required|in:file,session,text_lesson,quiz',
            'id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        $type = $data['type'];
        $id = $data['id'];

        switch ($type) {
            case 'file':
                return $this->getFileInfo($id);
            case 'text_lesson':
                return $this->getTextLessonInfo($id);
            case 'session':
                return $this->getSessionInfo($id);
            case 'quiz':
                return $this->getQuizInfo($id);
        }
    }

    private function checkCourseAccess($courseId): bool
    {
        $user = auth()->user();

        $course = Webinar::find($courseId);

        return (!empty($course) and $course->checkUserHasBought($user));
    }


    private function getFileInfo($id)
    {
        $file = File::select('id', 'downloadable', 'webinar_id', 'storage')
            ->where('id', $id)
            ->where('status', WebinarChapter::$chapterActive)
            ->first();

        if (!empty($file) and $this->checkCourseAccess($file->webinar_id)) {

            // for translate send on array of data
            $data = [
                'file' => [
                    'id' => $file->id,
                    'title' => $file->title,
                    'storage' => $file->storage,
                    'downloadable' => $file->downloadable ?? false,
                ]
            ];

            return response()->json($data);
        }

        abort(403);
    }
    private function getSessionInfo($id)
    {
        $session = Session::where('id', $id)
            ->where('status', WebinarChapter::$chapterActive)
            ->first();

        $webinar = Webinar::where('id', $session->webinar_id)->first();



        if (!empty($session) and $this->checkCourseAccess($session->webinar_id)) {

            $isFinished = $session->isFinished();
            // for translate send on array of data
            $data = [
                'session' => [
                    'id' => $session->id,
                    'title' => $session->title,
                    // 'is_finished' => $isFinished,
                    'is_started' => (time() > $session->date),
                    // 'join_url' => !$isFinished ? $session->getJoinLink(true) : null,
                    'join_url' => $session->getJoinLink(true),
                    'start_data' => dateTimeFormat($session->date, 'j M Y H:i'),
                    'slug' => $webinar->slug
                ],
            ];

            return response()->json($data);
        }

        abort(403);
    }

    private function checkQuizResult($quiz)
    {
        $user = auth()->user();

        $userQuizDone = QuizzesResult::where('quiz_id', $quiz->id)
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();

        $canDownloadCertificate = false;
        $canTryAgainQuiz = false;

        if (count($userQuizDone)) {
            $quiz->user_grade = $userQuizDone->first()->user_grade;
            $quiz->result_status = $userQuizDone->first()->status;
            $quiz->result_count = $userQuizDone->count();
            $quiz->result = $userQuizDone->first();

            if ($quiz->result_status == 'passed') {
                $canDownloadCertificate = true;
            }
        }

        if (!isset($quiz->attempt) or (count($userQuizDone) < $quiz->attempt and $quiz->result_status !== 'pass')) {
            $canTryAgainQuiz = true;
        }

        $quiz->can_try = $canTryAgainQuiz;
        $quiz->can_download_certificate = $canDownloadCertificate;

        return $quiz;
    }

    private function getQuizInfo($id)
    {
        $quiz = Quiz::where('id', $id)
            ->where('status', WebinarChapter::$chapterActive)
            ->first();

        $user = auth()->user();
        // dd($user);
        if ($user->role_name == 'user') {
            if (!empty($quiz) and $this->checkCourseAccess($quiz->webinar_id)) {
                $quiz = $this->checkQuizResult($quiz);
                // dd($quiz);
                // for translate send on array of data
                $data = [
                    'quiz' => [
                        'id' => $quiz->id,
                        'title' => $quiz->title,
                        'can_try' => $quiz->can_try,
                    ]
                ];

                return response()->json($data);
            }
        } else {
            $quiz = $this->checkQuizResult($quiz);
                // dd($quiz);
                // for translate send on array of data
                $data = [
                    'quiz' => [
                        'id' => $quiz->id,
                        'title' => $quiz->title,
                        'can_try' => false,
                    ]
                ];

                return response()->json($data);
        }

        abort(403);
    }

    private function getTextLessonInfo($id)
    {
        $user = auth()->user();

        $textLesson = TextLesson::where('id', $id)
            ->where('status', WebinarChapter::$chapterActive)
            ->with([
                'attachments' => function ($query) {
                    $query->with('file');
                },
                'learningStatus' => function ($query) use ($user) {
                    $query->where('user_id', !empty($user) ? $user->id : null);
                }
            ])
            ->first();

        if (!empty($textLesson) and $this->checkCourseAccess($textLesson->webinar_id)) {

            $attachments = [];

            if (!empty($textLesson->attachments) and count($textLesson->attachments)) {
                foreach ($textLesson->attachments as $attachment) {
                    if ($attachment and $attachment->file) {
                        $attachments[] = [
                            'id' => $attachment->id,
                            'file' => [
                                'id' => $attachment->file->id,
                                'title' => $attachment->file->title,
                                'file_type' => $attachment->file->file_type,
                                'volume' => $attachment->file->volume,
                            ]
                        ];
                    }
                }
            }

            // for translate send on array of data
            $data = [
                'textLesson' => [
                    'id' => $textLesson->id,
                    'title' => $textLesson->title,
                    'image' => url($textLesson->image),
                    'study_time' => $textLesson->study_time,
                    'summary' => $textLesson->summary,
                    'content' => $textLesson->content,
                    'attachments' => $attachments,
                    'learningStatus' => $textLesson->learningStatus,
                ]
            ];

            return response()->json($data);
        }

        abort(403);
    }
}
