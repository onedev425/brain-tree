<?php

namespace App\Services;

use App\Mail\SendinblueMail;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Configuration;

class EmailService
{
    private array $email_data;
    public function __construct($data = [])
    {
        $this->email_data = $data;
    }

    public function sendEmail(): string
    {
        $email = new SendinblueMail($this->email_data);
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', env('SENDINBLUE_API_KEY'));
        $apiInstance = new TransactionalEmailsApi(new \GuzzleHttp\Client(), $config);

        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail();
        $sendSmtpEmail['sender'] = ['email' => env('MAIL_FROM_ADDRESS')];
        $sendSmtpEmail['to'] = [['email' => $this->email_data['to']]];
        $sendSmtpEmail['subject'] = $this->email_data['subject'];
        $sendSmtpEmail['htmlContent'] = $email->render();

        try {
            $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
            return 'success';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
