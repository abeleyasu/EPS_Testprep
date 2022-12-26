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
    ],
    "educations" => [
        "rules" => [
            "current_grade" => [
                "required" => true,
            ],
            "month" => [
                "required" => true,
            ],
            "year" => [
                "required" => true,
            ],
            "high_school_name" => [
                "required" => true,
            ],
            "high_school_city" => [
                "required" => true,
            ],
            "high_school_state" => [
                "required" => true,
            ],
            "high_school_district" => [
                "required" => true,
            ],
            "ib_courses[]" => [
                "required" => true,
            ],
            "ap_courses[]" => [
                "required" => true,
            ],
            "course_data[*][course_name]" => [
                "required" => true,
            ],
            "course_data[*][search_college_name]" => [
                "required" => true,
            ],
            "honor_course_data[*][course_data]" => [
                "required" => true,
            ],
            "testing_data[*][name_of_test]" => [
                "required" => true,
            ],
            "testing_data[*][results_score]" => [
                "required" => true,
            ],
            "testing_data[*][date]" => [
                "required" => true,
            ],
        ],
        "messages" => [
            "current_grade" => "current grade field is required",
            "month" => "month field is required",
            "year" => "year field is required",
            "high_school_name" => "high school name field is required",
            "high_school_city" => "high school city field is required",
            "high_school_state" => "high school state field is required",
            "high_school_district" => "high school district field is required",
            "ib_courses[]" => "ib courses field is required",
            "ap_courses[]" => "ap courses field is required",
            "course_data[*][course_name]" => "course name field is required",
            "course_data[*][search_college_name]" => "search college name field is required",
            "honor_course_data[*][course_data]" => "honors course name field is required",
            "testing_data[*][name_of_test]" => "name of test field is required",
            "testing_data[*][results_score]" => "result score field is required",
            "testing_data[*][date]" => "date field is required",
        ]   
    ],
    "honors"=>[
        "rules"=>[
            "honors_data[*][position]" =>[
                "required" =>true,
            ],
            "honors_data[*][honor_achievement_award]" =>[
                "required" =>true,
            ],
            "honors_data[*][grade]" =>[
                "required" =>true,
            ],
            "honors_data[*][location]" =>[
                "required" =>true,
            ],
        ],
        "messages"=>[
            "honors_data[*][position]" => "honors position field is required",
            "honors_data[*][honor_achievement_award]" => "honors achievement award field is required",
            "honors_data[*][grade]" => "honors grade field is required",
            "honors_data[*][location]" => "honors location field is required",

        ]
    ]
];