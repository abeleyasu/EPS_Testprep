<?php

namespace App\Service\Interface;

interface MailgunServiceInterface {
    public function setupMailgun();
    public function sendMail($payload);
    public function sendEmailConfirmationCode();
}