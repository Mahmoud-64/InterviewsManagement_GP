<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Foundation\Auth\VerifiesEmails;
// use Illuminate\Auth\Events\Verified;

use App\User;

class VerificationController extends Controller
{
    // use VerifiesEmails;
    /**
    * Show the email verification notice.
    *
    */
    public function show()
    {
        //
    }
    /**
    * Mark the authenticated user's email address as verified.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function verify(Request $request) {
        $userID = $request['id'];
        $user = User::findOrFail($userID);
        $date = date("Y-m-d g:i:s");
        $user->email_verified_at = $date; // to enable the "email_verified_at field of that user be a current time stamp by mimicing the must verify email feature
        $user->save();
        return response()->json('Email verified!');
    }
    /**
    * Resend the email verification notification.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
        return response()->json(["verify_email"=>'User already have verified email!'], 422);
        // return redirect($this->redirectPath());
        }
        $request->user()->sendEmailVerificationNotification();
        return response()->json(["verify_email"=>'The notification has been resubmitted']);
        // return back()->with('resent', true);
    }
}
