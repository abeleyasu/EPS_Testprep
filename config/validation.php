<?php 

return [
    "personal_info" => [
        "rules" => [
            "first_name" => [
                "required" => true,
            ],
            "last_name" => [
                "required" => true,
            ],
            "street_address_one" => [
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
                "zipcodeUS" => true
            ],
            "cell_phone" => [
                "required" => true,
                "phoneUS" => true
            ], 
            "email" => [
                "required" => true,
                "email" => true
            ],
            "social_links[*][link]" => [
                "url" => true
            ],
            "parent_email_one" => [
                "required" => true,
                "email" => true
            ],
            "parent_email_two" => [
                "email" => true
            ]
        ],
        "messages" => [
            "first_name" => "First name field is required",
            "last_name" => "Last name field is required",
            "street_address_one" => "Street address one field is required",
            "city" => "City field is required",
            "state" => "State field is required",
            "zip_code" => [
                "required" => "Zip code field is required",
                "zipcodeUS" => "Zip code format should be US"   
            ],
            "cell_phone" => [
                "required" => "Cell phone field is required",
                "phoneUS" => "Cell Phone format should be US"
            ],
            "email" => [
                "required" => "Email field is required",
                "email" => "Email must be a valid email"
            ],
            "social_links[*][link]" => "Social link must be a valid url",
            "parent_email_one" => [
                "required" => "Parent email one field is required",
                "email" => "Parent email one must be a valid email"
            ],
            "parent_email_two" => "Parent email two must be a valid email"
        ]
    ],
    "educations" => [
        "rules" => [
            "current_grade[]" => [
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
            "cumulative_gpa_unweighted" => [
                "maxlength" => 4,
                "range" => [0,8]
            ],
            "cumulative_gpa_weighted" => [
                "maxlength" => 4,
                "range" => [0,8]
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
            "current_grade[]" => "Current grade field is required",
            "month" => "Month field is required",
            "year" => "Year field is required",
            "high_school_name" => "High school name field is required",
            "high_school_city" => "High school city field is required",
            "high_school_state" => "High school state field is required",
            "high_school_district" => "High school district field is required",
            "cumulative_gpa_unweighted" =>[
                "max" => "Unweighted GPA must between 0 and 8",
                "range" => "Unweighted GPA must between 0 and 8",
                "maxlength" => "Unweighted GPA must have two decimal value"
            ],
            "cumulative_gpa_weighted" =>[
                "max" => "Weighted GPA must between 0 and 8",
                "range" => "Weighted GPA must between 0 and 8",
                "maxlength" => "Weighted GPA must have two decimal value"


            ],
            "testing_data[*][name_of_test]" => "Name of test field is required",
            "testing_data[*][results_score]" => "Result score field is required",
            "testing_data[*][date]" => "Date field is required",
        ]   
    ],
    "honors"=>[
        "rules"=>[
            "honors_data[*][position]" =>[
                "required" => true,
            ],
            "honors_data[*][honor_achievement_award]" =>[
                "required" => true,
            ],
            "honors_data[*][grade][]" =>[
                "required" => true,
            ],
            "honors_data[*][location]" =>[
                "required" => true,
            ],
        ],
        "messages"=>[
            "honors_data[*][position]" => "Honors position field is required",
            "honors_data[*][honor_achievement_award]" => "Honors achievement award field is required",
            "honors_data[*][grade][]" => "Honors grade field is required",
            "honors_data[*][location]" => "Honors location field is required",

        ]
    ],
    "activities" => [
        "rules" => [
            "demonstrated_data[*][grade][]" =>[
                "required" => true,
            ],
            "activities_data[*][grade][]" =>[
                "required" => true,
            ],
            "athletics_data[*][grade][]" =>[
                "required" => true,
            ],
            "community_service_data[*][grade][]" =>[
                "required" => true,
            ],
        ],
        "messages" => [
            "demonstrated_data[*][grade][]" => "Demonstrated Activity In The Area Of Your major grade field is required",
            "activities_data[*][grade][]" => "Activities & Clubs grade field is required",
            "athletics_data[*][grade][]" => "Athletics grade field is required",
            "community_service_data[*][grade][]" => "Community Service / Volunteerism grade field is required",
        ]
    ],
    "employment_certifications" => [
        "rules" => [
            "employment_data[*][grade][]" =>[
                "required" => true,
            ],
            "significant_data[*][grade][]" =>[
                "required" => true,
            ],
        ],
        "messages" => [
            "employment_data[*][grade][]" => "Employment & Certifications grade field is required",
            "significant_data[*][grade][]" => "Other Significant Responsibilities Or Interests grade field is required",
        ]
    ],
];