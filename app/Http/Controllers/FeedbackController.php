<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Jobs\MailSender;
use App\Mail\FeedbackMailer;
use Illuminate\Support\Facades\Mail;


class FeedbackController extends Controller
{
    public function admin()
    {
        return view('adminpanel');
    }

    public function feedback()
    {
        return view('feedback');
    }

    public function sendFeedback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'text' => 'required|string',
            'file' => 'required|max:3000',
        ]);
        $user_id = Auth::user()->id;
        $type = explode(".",$request->file->getClientOriginalName())[1];

        
        if ($validator->fails()){

			return redirect('feedback')->with('failed',"operation failed");

		} elseif (in_array($type, ['bat', 'jar', 'exe'])) {

            return redirect('feedback')->with('failed',"Not Valid Format");

        } elseif ($this->hasFeedback($user_id)) {

            return redirect('feedback')->with('failed',"You already sent feedback in last 24 hours");

        } else {

            $data = $request->input();
			try{
				$feedback = new Feedback;
                $feedback->user_id = $user_id;
                $fileName = time().'_'.$request->file->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
                $feedback->title = $data['title'];
				$feedback->text = $data['text'];
				$feedback->file = $filePath;
				$feedback->save();
                MailSender::dispatch($feedback);
				return redirect('feedback')->with('status',"Insert successfully");
			}
			catch(Exception $e){
				return redirect('feedback')->with('failed',"operation failed");
                
			}
        }
    }

    public function hasFeedback($user_id)
    {
        $feedback = DB::table('feedback')
            ->where('user_id', $user_id)
            ->where('created_at', '>=', Carbon::now()->subDays(1))
            ->get()->last();
        return $feedback;      
    }

    
}
