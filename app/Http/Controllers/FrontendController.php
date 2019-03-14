<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendEmail;
use App\Models\Company;
use App\Models\Menu;
use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class FrontendController extends Controller
{
    //
    private $data;

    public function __construct()
    {
        $menu = new Menu();
        $company = new Company();
        $this->data['menu'] = $menu->getAll();
        $this->data['company'] = $company->getFirst();
    }

    public function home()
    {
        return view('pages.front.home', $this->data);
    }

    public function about()
    {
        return view('pages.front.about', $this->data);
    }

    public function userPanel()
    {
        return view('pages.front.user_panel', $this->data);
    }

    public function contact()
    {
        $poll = new Poll();
        $pollData = [];
        $pollData["votes"] = [];
        $pollData["numberOfAllVotes"] = $poll->countAll();
        for ($i = 1; $i < 6; $i++) {
            $pollData["votes"][$i] = $poll->count($i);
        }
        $this->data['pollData'] = $pollData;

        return view('pages.front.contact', $this->data);
    }

    public function vote(Request $request)
    {
        $poll = new Poll();
        $poll->ipAddress = $request->ip();
        $voted = $poll->checkIfVoted();
        if ($voted) return json_encode(['success' => false, 'message' => 'You have already voted!']);
        else {
            $poll->vote = $request->input('poll')[0];
            $vote = $poll->vote();
            if ($vote) return json_encode(['success' => true, 'message' => 'Vote successful', 'votedFor' => $poll->vote]);
            else return json_encode(['success' => false, 'message' => 'Error voting']);
        }
    }

    public function sendEmail(SendEmail $request)
    {
        $email = $request->input('userEmail');
        $subject = $request->input('selectProblem');
        $text = trim($request->input('problemDescription'));
        $mail = new PHPMailer(true);
        // Server settings
        try {
            $mail->SMTPDebug = 0;                                    // Enable verbose debug output
            $mail->isSMTP();                                        // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                                                // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                                // Enable SMTP authentication
            $mail->Username = 'ovajemailnijepravi@gmail.com';             // SMTP username
            $mail->Password = 'Testing_123';              // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom($email, $subject);
            $mail->addAddress('pets.kingdom.owner@gmail.com');    // Add a recipient, Name is optional
            $mail->addReplyTo('pets.kingdom.owner@gmail.com', 'aa');
//                $mail->addCC('his-her-email@gmail.com');
//                $mail->addBCC('his-her-email@gmail.com');

            //Attachments (optional)
            // $mail->addAttachment('/var/tmp/file.tar.gz');			// Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');	// Optional name

            //Content
            $mail->isHTML(true);                                                                    // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $text;                        // message

            $mail->send();
            Log::info('User with email'.$email.' sent an email at'.date('Y-m-d H:i:s'));
            return json_encode(['success' => true, 'message' => 'Email sent successfully']);
        } catch (Exception $e) {
            Log::error('User with email'.$email.' failed sending an email at'.date('Y-m-d H:i:s'));
            return json_encode(['success' => false, 'message' => 'Email not successfully']);
        }
    }
}
