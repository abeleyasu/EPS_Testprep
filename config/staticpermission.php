<?php 

return [
    'permissions' => [
        [
            'name' => 'Courses',
            'permissions' => [
                'Access Courses'
            ],
            'redirect_route' => 'courses.index',
            'protected_routes' => 'courses.detail|courses.milestone|milestone.detail|modules.detail|sections.detail|sections.show-detail|tasks.detail|tasks.show-detail|tasks.change_status',
        ],
        [
            'name' => 'Calendar',
            'permissions' => [
                'Access Calendar'
            ],
            'redirect_route' => '',
            'protected_routes' => '',
        ],
        [
            'name' => 'Test Proctor',
            'permissions' => [
                'Access Test Proctor'
            ],
            'redirect_route' => '',
            'protected_routes' => '',
        ],
        [
            'name' => 'Practice Tests',
            'permissions' => [
                'Access Practice Tests'
            ],
            'redirect_route' => 'test_prep_dashboard',
            'protected_routes' => '',
        ],
        [
            'name' => 'Test Home Page',
            'permissions' => [
                'Access Test Home Page'
            ],
            'redirect_route' => 'test_home_page',
            'protected_routes' => 'single_test|practicetest|single_section|all_section',
        ],
        [
            'name' => 'Self Made Tests',
            'permissions' => [
                'Access Self Made Tests'
            ],
            'redirect_route' => 'self-made-test.index',
            'protected_routes' => '',
        ],
        [
            'name' => 'High School Resume',
            'permissions' => [
                'Access High School Resume'
            ],
            'redirect_route' => 'admin-dashboard.highSchoolResume.list',
            'protected_routes' => 'admin-dashboard.highSchoolResume.personalInfo|admin-dashboard.highSchoolResume.educationInfo|admin-dashboard.highSchoolResume.honors|admin-dashboard.highSchoolResume.activities|admin-dashboard.highSchoolResume.employmentCertification|admin-dashboard.highSchoolResume.featuresAttributes|admin-dashboard.highSchoolResume.preview',
        ],
        [
            'name' => 'College Application Deadline Organizer',
            'permissions' => [
                'Access College Application Deadline Organizer'
            ],
            'redirect_route' => 'admin-dashboard.collegeApplicationDeadline',
            'protected_routes' => NULL,
        ],
        [
            'name' => 'Initial College List',
            'permissions' => [
                'Access Initial College List'
            ],
            'redirect_route' => 'admin-dashboard.initialCollegeList.step1',
            'protected_routes' => 'admin-dashboard.initialCollegeList.step2|admin-dashboard.initialCollegeList.step3|admin-dashboard.initialCollegeList.step4',
        ],
        [
            'name' => 'Cost Comparison Tool',
            'permissions' => [
                'Access Cost Comparison Tool'
            ],
            'redirect_route' => 'admin-dashboard.cost_comparison',
            'protected_routes' => NULL,
        ],
        [
            'name' => 'Reminders',
            'permissions' => [
                'Access Reminders'
            ],
            'redirect_route' => 'user.reminders',
            'protected_routes' => NULL,
        ],
        [
            'name' => 'Dasboard',
            'permissions' => [
                [
                    'name' => 'Access Test Prep Dashboard',
                    'redirect_route' => 'test_prep_dashboard',
                    'protected_routes' => NULL,
                ],
                [
                    'name' => 'Access Admission Dashboard',
                    'redirect_route' => 'admin-dashboard.dashboard',
                    'protected_routes' => NULL,
                ],
            ],
        ]
    ]
]


?>