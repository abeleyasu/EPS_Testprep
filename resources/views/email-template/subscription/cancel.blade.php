@extends('email-template.layout.mail')

@section('mail-head')
    <title>Wishing You Success on Your College Journey – Your Subscription Cancellation Confirmation</title>
@endsection

@section('mail-content')

    <p>
    We have processed your request and successfully cancelled your subscription with College Prep System. We sincerely appreciate the time you've spent with us and hope our platform provided valuable insights and guidance during your college preparation journey.
    </p>

    <p>While we're sorry to see you go, we'd like to take a moment to remind you of what College Prep System brought to your academic journey:</p>

    <p>
        - <b>Expert-Designed Modules & Tools: </b>
        Offering a structured approach to college admissions, test prep, profile development, financial aid, and more.
    </p>

    <p>
        - <b>Comprehensive Test Prep Resources: </b>
        Detailed score reports, study materials, and strategies tailored for the ACT, SAT, and PSAT.
    </p>

    <p>
        - <b>Career and College Exploration: </b>
        An extensive database of colleges and career paths designed to align with your personal goals and aspirations.
    </p>

    <p>
        - <b>Guidance Every Step of the Way: </b>
        From application processes to post-admission steps, we aimed to be your steadfast ally.
    </p>

    <p>Remember, the door is always open. If ever you decide to rejoin, or if there's a high schooler in your circle gearing up for college, we'll be here ready to guide them.</p>

    <p>
        <b>Refer & Earn:</b>
        Do you have friends or family preparing for college? Refer them to College Prep System and enjoy exclusive rewards for valuable gift card redemption. It's our way of saying thank you for helping people close to you achieve their college dreams.
    </p>

    <p>
    Feedback helps us grow and provide better experiences. We'd love to hear why you chose to cancel and any suggestions you might have for us. Please feel free to reply to this email or fill out our quick [feedback form link].
    </p>
    
    
    @include('email-template.components.email-footer', [
        'custom_final_message' => 'Thank you once again for choosing College Prep System. Wishing you all the best in your academic and future endeavors.'    
    ])
@endsection 