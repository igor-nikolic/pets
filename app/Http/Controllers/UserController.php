<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUser;
use App\Http\Requests\StoreUser;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginUser $lu){
        $email = trim($lu->input('loginemail'));
        $password = $lu->input('loginpassword');
        $user = new User();
        $user->email = $email;
        $user->password = $password;
        $userData = $user->login();
        if($userData){
            if(password_verify($password,$userData->password)){
                $lu->session()->put('user',$userData);
                Log::info('User with email : '.$userData->email.' logged in at '.date('Y-m-d H:i:s'));
                return redirect('/')->with('message','Welcome '.$userData->first_name.' '.$userData->last_name);
            }else{
                Log::info('Login failed for user | email: '.$email);
                return redirect('/')->with('message','You have entered wrong password!');
            }
        }else{
            Log::info('Login failed for user | email: '.$email);
            return redirect('/')->with('message','Login failed! You may have entered wrong credentials or your account has been deleted!');
        }
    }
    public function logout(Request $r){
        if($r->session()->has('user')){
            Log::info('User '.$r->session()->get('user')->email.' logged out at '.date('Y-m-d H:i:s'));
            $r->session()->forget('user');
            $r->session()->flush();
        }
        return redirect("/");
    }

    public function register(StoreUser $su){
        $activation_string = time() ."|". $su->input('email');
        $activation_hash = base64_encode($activation_string);
        $user = new User();
        $user->firstName = ucwords(trim($su->input('first_name')));
        $user->lastName = ucwords(trim($su->input('last_name')));
        $user->email = $su->input('email');
        $user->password = $su->input('password');
        $user->created_at = date('Y-m-d H:i:s');
        $user->activation_hash = $activation_hash;
        $user_id = $user->store();
        if($user_id) {
            $mail = new PHPMailer(true);                            // Passing `true` enables exceptions

            try {
                // Server settings
                $mail->SMTPDebug = 0;                                	// Enable verbose debug output
                $mail->isSMTP();                                     	// Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';												// Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                              	// Enable SMTP authentication
                $mail->Username = 'ovajemailnijepravi@gmail.com';             // SMTP username
                $mail->Password = 'Testing_123';              // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('ovajemailnijepravi@gmail.com', 'Account verification mail');
                $mail->addAddress($user->email, 'Optional name');	// Add a recipient, Name is optional
                $mail->addReplyTo('ovajemailnijepravi@gmail.com', 'Pet\'s kingdom');
//                $mail->addCC('his-her-email@gmail.com');
//                $mail->addBCC('his-her-email@gmail.com');

                //Attachments (optional)
                // $mail->addAttachment('/var/tmp/file.tar.gz');			// Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');	// Optional name

                //Content
                $mail->isHTML(true); 																	// Set email format to HTML
                $mail->Subject = 'Activation for pet\'s kingdom';
                $mail->Body    = "Click <a href='http://localhost:8000/activate/".$user->activation_hash."'>here</a> to activate your account!";						// message

                $mail->send();
                $su->session()->flash('message','We have sent you a confirmation link to your email');
                return redirect('/');
            } catch (Exception $e) {
                return redirect('/')->with('message','Mail server error');
            }
        }
        else {
            return redirect('/')->with('message','You didn\'t register! Please try again later!');
        }
    }
    public function activate($hash){
        $dehashed = base64_decode($hash);
        $email = explode('|',$dehashed)[1];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect('/')->with('message','Activation failed! Wrong URL!');
        }
        $user = new User();
        $user->email = $email;
        $user->activation_hash = $hash;
        if($user->isActivated()){
            request()->session()->flash('message','You have already verified your account!');
            return redirect('/');
        }else{
            if($user->activate()){
                Log::info('User with email : '.$email.' activated at '.date('Y-m-d H:i:s'));
                request()->session()->flash('message','You account has been verified! You can login now!');
                return redirect('/');
            }else{
                request()->session()->flash('message','You account has not been verified!');
                return redirect('/');
            }
        }


    }
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
        //
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
}
