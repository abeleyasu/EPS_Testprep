<?php
/**
 * Class AppConstants
 * @author ningmar
 * @package App\Constants
 */

namespace App\Constants;


class AppConstants
{

    const BG_CLASS =[
        'bg-city',
        'bg-flat',
        'bg-default',
        'bg-smooth',
        'bg-modern',
        'bg-warning',
        'bg-success',
        'bg-info',
        'bg-danger',
        'bg-gray-dark',
        'bg-primary',
    ];

    const STRIPE_STATUS_COLOR_CODE = [
        'active' => 'bg-success-light text-success',
        'consumed' => 'bg-warning-light text-warning',
        'canceled' => 'bg-warning-light text-warning',
        'failed' => 'bg-danger-light text-danger'
    ];
}