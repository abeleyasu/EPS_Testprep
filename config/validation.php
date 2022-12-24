<?php 

return [
    "personal_info" => [
        "rules" => [
            "first_name" => [
                "required" => true,
            ],
            "middle_name" => [
                "required" => true,
            ],
            "last_name" => [
                "required" => true,
            ],
            "street_address_one" => [
                "required" => true,
            ],
            "street_address_two" => [
                "required" => true,
            ],
            "city" => [
                "required" => true,
            ],
            "state" => [
                "required" => true,
            ],
            "zip_code" => [
                "required" => true,
            ],
            "cell_phone" => [
                "required" => true,
            ],
            "email" => [
                "required" => true,
                "email" => true
            ],
            "social_links[*][link]" => [
                "required" => true,
            ],
            "parent_email_one" => [
                "required" => true,
                "email" => true
            ],
            "parent_email_two" => [
                "required" => true,
                "email" => true
            ]
        ],
        "messages" => [
            "first_name" => "first name field is required",
            "middle_name" => "middle name field is required",
            "last_name" => "last name field is required",
            "street_address_one" => "street address one field is required",
            "street_address_two" => "street address two field is required",
            "city" => "city field is required",
            "state" => "state field is required",
            "zip_code" => "zip code field is required",
            "cell_phone" => "cell phone field is required",
            "email" => [
                "required" => "email field is required",
                "email" => "email must be a valid email"
            ],
            "social_links[*][link]" => "social link field is required",
            "parent_email_one" => [
                "required" => "parent email one field is required",
                "email" => "parent email one must be a valid email"
            ],
            "parent_email_two" => [
                "required" => "parent email two field is required",
                "email" => "parent email two must be a valid email"
            ]
        ]
    ]
];