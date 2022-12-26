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
            "first_name" => "First name field is required",
            "middle_name" => "Middle name field is required",
            "last_name" => "Last name field is required",
            "street_address_one" => "Street address one field is required",
            "street_address_two" => "Street address two field is required",
            "city" => "City field is required",
            "state" => "State field is required",
            "zip_code" => "Zip code field is required",
            "cell_phone" => "Cell phone field is required",
            "email" => [
                "required" => "Email field is required",
                "email" => "Email must be a valid email"
            ],
            "social_links[*][link]" => "Social link field is required",
            "parent_email_one" => [
                "required" => "Parent email one field is required",
                "email" => "Parent email one must be a valid email"
            ],
            "parent_email_two" => [
                "required" => "Parent email two field is required",
                "email" => "Parent email two must be a valid email"
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
            "current_grade" => "Current grade field is required",
            "month" => "Month field is required",
            "year" => "Year field is required",
            "high_school_name" => "High school name field is required",
            "high_school_city" => "High school city field is required",
            "high_school_state" => "High school state field is required",
            "high_school_district" => "High school district field is required",
            "ib_courses[]" => "Ib courses field is required",
            "ap_courses[]" => "Ap courses field is required",
            "course_data[*][course_name]" => "Course name field is required",
            "course_data[*][search_college_name]" => "Search college name field is required",
            "honor_course_data[*][course_data]" => "Honors course name field is required",
            "testing_data[*][name_of_test]" => "Name of test field is required",
            "testing_data[*][results_score]" => "Result score field is required",
            "testing_data[*][date]" => "Date field is required",
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
            "honors_data[*][grade][]" =>[
                "required" =>true,
            ],
            "honors_data[*][location]" =>[
                "required" =>true,
            ],
        ],
        "messages"=>[
            "honors_data[*][position]" => "Honors position field is required",
            "honors_data[*][honor_achievement_award]" => "Honors achievement award field is required",
            "honors_data[*][grade][]" => "Honors grade field is required",
            "honors_data[*][location]" => "Honors location field is required",

        ]
    ]
];