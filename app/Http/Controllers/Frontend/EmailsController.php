<?php

namespace App\Http\Controllers\Frontend;

use App\Emails;
use App\Http\Controllers\Controller;
use App\User;
use App\VerifyEmailcodes;
use Illuminate\Http\Request;
use App\EmailTemplates;
use Illuminate\Support\Facades\DB;
use Mail;

class EmailsController extends Controller
{

    public function __construct()
    {

        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    public function save($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.mail', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => $request['sender_address'],
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function userVerifyEmail($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.userVerifyEmail', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => $request['sender_address'],
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Mail send for sending to buyer approved rfq by admin
     * @param data, username, address....
     * @since 2020-12-14
     * @author Nemanja
     */
    public function sendapprovedRFQ($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.buyermaster', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => $request['sender_address'],
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function sendQuoteAcceptedMail($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.quoteaccept', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => $request['sender_address'],
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function sendQuoteRejectedMail($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.quotereject', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => $request['sender_address'],
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function sendQuoteNowMail($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.quotenow', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => $request['sender_address'],
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function sendQuoteNowMailEdit($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.quotenowedit', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => $request['sender_address'],
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function acceptMail($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.acceptmail', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => $request['sender_address'],
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function acceptMailSeller($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.acceptmail', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => $request['sender_address'],
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function acceptMailBuyer($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.acceptmail', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => $request['sender_address'],
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function paymentMailSeller($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.paymentmailseller', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => 'no-reply@mambodubai.com',
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function paymentMailBuyer($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.paymentmailbuyer', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => 'no-reply@mambodubai.com',
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function paymentAcceptMailSeller($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.paymentacceptmailseller', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => 'no-reply@mambodubai.com',
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function paymentAcceptMailBuyer($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.paymentacceptmailbuyer', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => 'no-reply@mambodubai.com',
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function paymentDisputeMailSeller($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.paymentdisputemailseller', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => 'no-reply@mambodubai.com',
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function paymentDisputeMailBuyer($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.paymentdisputemailbuyer', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => 'no-reply@mambodubai.com',
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function deliveryMail($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.deliverymail', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => 'no-reply@mambodubai.com',
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function deliveryMailSeller($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.deliverymailseller', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => 'no-reply@mambodubai.com',
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function deliveryMailBuyer($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.deliverymailbuyer', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => 'no-reply@mambodubai.com',
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function deliveryAcceptMailSeller($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.deliveryacceptmail', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => $request['sender_address'],
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function deliveryAcceptMailBuyer($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.deliveryacceptmail', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => $request['sender_address'],
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function deliveryDisputeMailSeller($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.deliverydisputemailseller', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => 'no-reply@mambodubai.com',
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function deliveryDisputeMailBuyer($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.deliverydisputemailbuyer', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => 'no-reply@mambodubai.com',
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function requestCallbackSeller($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.requestcallbackseller', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => 'no-reply@mambodubai.com',
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function requestCallbackBuyer($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.requestcallbackbuyer', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => 'no-reply@mambodubai.com',
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function requestCallbackNoProductSeller($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.requestcallbacknoproductseller', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => 'no-reply@mambodubai.com',
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function requestCallbackNoProductBuyer($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.requestcallbacknoproductbuyer', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => 'no-reply@mambodubai.com',
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function welcome($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.welcome', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => 'no-reply@mambodubai.com',
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function welcomeAdmin($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.welcomeadmin', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => 'no-reply@mambodubai.com',
                'receiver_address' => 'sales@mambodubai.com',
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    /**
     * Mail send for sending rfq as buyer
     * @param data, username, address....
     * @since 2020-11-24
     * @author Nemanja
     */
    public function sendRequest($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.mailrequest', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => $request['sender_address'],
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Mail send for add a product as seller
     * @param data, username, address....
     * @since 2020-11-25
     * @author Nemanja
     */
    public function addProductseller($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.mailsellerproduct', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => $request['sender_address'],
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Mail send for approved seller product by admin
     * @param data, username, address....
     * @since 2020-11-25
     * @author Nemanja
     */
    public function approveProductadmin($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.mailapproveproduct', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => $request['sender_address'],
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Mail send for sending approved rfq to seller
     * @param data, username, address....
     * @since 2020-11-24
     * @author Nemanja
     */
    public function approveRequest($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.sellermaster', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => $request['sender_address'],
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function approveGeneralRequest($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.generalrfq', $data, function ($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('no-reply@mambodubai.com', 'MamboDubai');
            });

            $email = Emails::create([
                'sender_address' => $request['sender_address'],
                'receiver_address' => $request['receiver_address'],
                'header' => $subject,
                'title' => "Hi, " . $username,
                'description' => $description,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function sendverifycode(Request $request)
    {

        $this->validate(request(), [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $verify = VerifyEmailcodes::where('email', $request['email'])->first();

        if ($verify == '') {
            DB::beginTransaction();
            $host = request()->getHost();
            $str = rand(100000, 999999);
            $url = "https://" . $host . "/emails/validatecode/" . $request['role'] . "/" . $str;
            $name = $request['user_name'];
            $phone = $request['phone'];
            $country = $request['country'];
            $useremail = $request['email'];
            $role = $request['role'];
            $username = 'Mambo Dubai';

            $email_template = EmailTemplates :: where('email_type','welcome_email')->first();
            $subject = $email_template->email_subject;
            $data = [];
            $data['name'] = ucfirst(strtolower($name));
            $data['useremail'] = $useremail;
            $data['verify_link'] = $url;

            $data['body'] = $email_template->email_body;

            try {

                Mail::send('frontend.mail.maillogin', $data, function ($message) use ($username, $useremail, $subject) {
                    $message->to($useremail, $username)->subject($subject);
                    $message->from('no-reply@mambodubai.com', 'MamboDubai');
                });

                $verify = VerifyEmailcodes::where('email', $useremail)->first();
                if (@$verify) {

                    $verify->name = $name;
                    $verify->phone = $phone;
                    $verify->country = $country;
                    $verify->verify_code = $str;
                    $verify->password = $request['password'];
                    $verify->update();
                } else {
                    $VerifyEmailcodes = VerifyEmailcodes::create([
                        'email' => $useremail,
                        'name' => $name,
                        'phone' => $phone,
                        'country' => $country,
                        'verify_code' => $str,
                        'password' => $request['password'],
                    ]);
                }

                $id = '';
                $msg = '';

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        } else {
            echo 'checkverify';
        }
       
    }

    public function directconfirmpage($email, $role, $id, $msg = null)
    {
        if (@$id && @$role && @$email) {
            $useremail = $email;

            return view('auth.confirmverifycode', compact('useremail', 'role', 'id', 'msg'));
        }
    }

    public function validatecode($useremail, $role, $verify_codes)
    {
        $validate = VerifyEmailcodes::where('email', $useremail)->first();
        if (@$validate) {
            if ($validate->verify_code == $verify_codes) {
                if ($role == 'buyer') {
                    return view('auth/register', compact('useremail'));
                }
                if ($role == 'seller') {
                    return view('auth/sellerregister', compact('useremail'));
                }
            } else {
                $msg = "Verify codes is failed. ";
                $id = '';
                return view('auth.confirmverifycode', compact('useremail', 'role', 'id', 'msg'));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function forgotpassword($id)
    {
        //
    }

}
