@extends('email-template.layout.mail')

@section('mail-content')
    <p>Congratulations on taking the first step toward your college journey by registering with College Prep System! We're excited to have you join our community and we're confident that you'll find our platform to be a valuable asset as you navigate the college admissions and test preparation process.</p>
    <p>Before you get started, we need to verify your email address to secure your account.</p>
    <p>Please click the link below to verify your email:</p>
    <div style="text-align: center;">
        <a href="{{ $url }}" target="_blank" style="display: inline-block;padding: .75rem .75rem;text-decoration: none;color: #fff;background-color: #4b5563;border-color: #4b5563;font-weight: 600;padding-right: 1.5rem;padding-left: 1.5rem;font-size: 1rem;border-radius: 0.25rem;border: 1px solid transparent;">Verify Email</a>
    </div>
    <p>Once you've verified your email, here's what you can look forward to by using College Prep System:</p>
    <ol>
        <li>
            <p>
                <b>Admissions and Test Prep Modules & Tools:</b>
                Take advantage of our detailed, streamlined modules and powerful tools to help you improve your college profile and test scores.
            </p>
        </li>
        <li>
            <p>
                <b>Profile Development:</b>
                Build a strong foundation for the college admissions process by developing a compelling profile that truly showcases your potential to admissions committees. Use our High School Resume tool to organize your academic and extracurricular milestones, pinpointing areas for further enhancement.
            </p>
        </li>
        <li>
            <p>
                <b>Career Assessment/Exploration:</b>
                Discover your unique strengths, interests, and potential career paths through our intuitive career assessment module. Research career information such as descriptions, salaries, job growth, and colleges who offer degrees for these careers, and add potential careers to your Career List.
            </p>
        </li>
        <li>
            <p>
                <b>College Search:</b>
                Use our extensive database to find colleges that align with your goals and preferences, add them to your College List, categorize them into Smart, Match, or Reach schools, compare your profile statistics with those on your College List, and more.
            </p>
        </li>
        <li>
            <p>
                <b>ACT, SAT, and PSAT Test Preparation:</b>
                Beyond providing comprehensive practice materials, we also deliver unrivaled, detailed score reports for official ACT, SAT, and PSAT practice tests, pinpointing the exact concept to review to improve your scores quickly and displaying the most frequently missed concepts. Click a concept to instantly access its lessons, videos, and strategies. Create custom quizzes on concepts you'd like to master. Use our digital score proctor while taking your test. Grade your Official and unofficial practice tests, track your score progress each week, and more.
            </p>
        </li>
        <li>
            <p>
                <b>College Applications:</b>
                Get assistance with every step of the application process, including guidance on how to craft an impressive application and personal essay. Use our College Application Deadline Organizer tool to keep track of important deadlines and get deadline reminders sent straight to your email and/or phone.
            </p>
        </li>
        <li>
            <p>
                <b>Scholarships and Financial Aid:</b>
                Learn how to navigate the financial aid process including the FAFSA, CSS Profile, and finding potential scholarships you are eligible for. Use our College Cost Comparison tool to compare the final costs of your colleges on your College List.
            </p>
        </li>
        <li>
            <p>
                <b>Final College Decision and Next Steps:</b>
                Once you've received your acceptance letters, we'll help you weigh your options and make the best decision for your future.
            </p>
        </li>
        <li>
            <p>
                <b>Post-Admission Steps:</b>
                We'll guide you through the necessary steps after getting accepted, such as orientation, housing, and course registration.
            </p>
        </li>
        <li>
            <p>
                <b>Reminders/Notifications:</b>
                Get text and/or email reminders for application deadlines, studying/tutoring/advising sessions, practice tests, and more.
            </p>
        </li>
    </ol>
    <p>To access these resources, simply log in to your account, navigate to your dashboard, and start exploring.</p>
    <p>If you need any assistance or have questions, please feel free to contact our support team at @include('email-template.components.system-email'). We're here to help you every step of the way.</p>
    <p>Thank you for choosing College Prep System to guide you on this exciting journey. We look forward to seeing you excel.</p>
    @include('email-template.components.email-footer')
    <p>College Prep System is all you need to achieve your college dreams.</p>
@endsection 