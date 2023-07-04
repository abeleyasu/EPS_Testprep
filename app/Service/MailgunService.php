<?php 

namespace App\Service;

use Illuminate\Support\ServiceProvider;
use App\Service\Interface\MailgunServiceInterface;
use Mailgun\HttpClient\HttpClientConfigurator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Mailgun\Mailgun;
use Illuminate\Support\Facades\Auth;
use Exception;

class MailgunService implements MailgunServiceInterface
{

    protected $config;
    protected $mailgun;

    public function __construct()
    {
        $this->config = config('services.mailgun');
        $this->mailgun = $this->setupMailgun();
    }

    public function endpoint() {
        if (isset($this->config['endpoint'])) {
            if (strpos($this->config['endpoint'], 'https') !== false) {
                return $this->config['endpoint'];
            } else {
                return 'https://'.$this->config['endpoint'];
            }
        } else {
            return 'https://api.mailgun.net/v3';
        }
    }

    public function secretkey() {
        return $this->config['secret'];
    }

    public function domain() {
        return $this->config['domain'];
    }

    public function setDebug() {
        if (isset($this->config['debug'])) {
            return $this->config['debug'];
        } else {
            return false;
        }
    }

    public function setupMailgun() {
        $configurator = new HttpClientConfigurator();
        $configurator->setEndpoint($this->endpoint());
        $configurator->setApiKey($this->secretkey());
        $configurator->setDebug($this->setDebug());
        $mailgun = new Mailgun($configurator);
        return $mailgun;
    }

    public function sendMail($payload) {
        return $this->send($payload);
    }

    public function send($data) {
        try {
            return $this->mailgun->messages()->send($this->domain(), $this->initializeMailData($data));
        } catch (\Exception $e) {
            return abort(500)->with('error', $e->getMessage());
        }
    }

    public function initializeMailData($email_setting) {
        $data = [];
        $data['to'] = isset($email_setting['to']) ? $email_setting['to'] : Auth::user()->email;
        $data['subject'] = isset($email_setting['subject']) ? $email_setting['subject'] : env('APP_NAME');
        $data['from'] = isset($email_setting['from']) ? $email_setting['from'] : env('MAIL_FROM_NAME') . ' <' . env('MAIL_FROM_ADDRESS') . '>';
        $data['cc'] = isset($email_setting['cc']) ? $email_setting['cc'] : null;
        $data['bcc'] = isset($email_setting['bcc']) ? $email_setting['bcc'] : null;
        $data['text'] = isset($email_setting['text']) ? $email_setting['text'] : null;
        $data['html'] = isset($email_setting['html']) ? $email_setting['html'] : null;
        $data['attachment'] = isset($email_setting['attachment']) ? $email_setting['attachment'] : null; 
        $data['inline'] = isset($email_setting['inline']) ? $email_setting['inline'] : null;
        $data['template'] = isset($email_setting['template']) ? $email_setting['template'] : null; 
        $data['options'] = isset($email_setting['options']) ? $email_setting['options'] : null;
        return $data;
    }

    public function sendEmailVerificationLink($user) {
        $url = $this->verificationUrl($user);
        $data = [
            'to' => $user->email,
            'subject' => 'Welcome to College Prep System – Please Verify Your Email',
            'html' => view('email-template.email-verification', [
                'url' => $url,
                'name' => $user->first_name
            ])->render()
        ];
        return $this->send($data);
    }

    public function sendEmailConfirmationCode($user = null) {
        try {
            if ($user) {
                return $this->sendEmailVerificationLink($user);
            } else if (Auth::user()) {
                return $this->sendEmailVerificationLink(Auth::user());
            } else {
                return abort(500);
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return abort(500)->with('error', $e->getMessage());
        }
    }

    protected function verificationUrl($user) {
        return URL::temporarySignedRoute(
           'verification.verify',
            Carbon::now()->addMinutes(
                Config::get('auth.verification.expire', 60)),
                    [
                        'id' => $user->id,
                        'hash' => sha1($user->email),
                    ]     
            ); 
    }
}
?>