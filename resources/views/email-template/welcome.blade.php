@extends('email-template.layout.mail')

@section('mail-head')
    <title>Welcome to College Prep System - Your Account is Ready!</title>
@endsection

@section('mail-content')
    <p>Thank you for verifying your email address! We're excited to inform you that your account is now fully activated and ready to use.</p>
    <p>
        <h3>Getting Started:</h3>
        <ol>
            <li>
                <p>
                    <b>Log In:</b>
                    Access your account by logging in with your registered credentials on our website or app.
                </p>
            </li>
            <li>
                <p>
                    <b>Quick Survey:</b>
                    On your first login, you'll encou’nter a brief survey tailored to understand your unique college prep needs. Taking a moment to complete this will enable us to provide a more seamless and personalized experience.
                </p>
            </li>
            <li>
                <p>
                    <b>Dashboard Navigation:</b>
                    Once logged in, navigate to your personal dashboard. This will be the central hub for all the resources and tools available to you. From here, you can:
                    <div>-<b> Add</b> to your college list and application deadlines.</div>
                    <div>-<b> Input</b> your initial and goal test scores.</div>
                    <div>-<b> Learn</b> with the Milestone modules, guiding you through each step of the college prep process.</div>
                    <div>-<b> Set</b> notifications and other events in your calendar, ensuring you never miss a crucial date.</div>
                    <div>-<b> Access</b> the powerful admissions and test prep tools located on the left navigation bar, designed to make your college prep journey simple, structured, and more manageable than ever.</div>
                </p>
            </li>
            <li>
                <p>
                    <b>Getting Started Video:</b>
                    Before diving deep, we recommend you watch the "getting started how to use this website" video. It will provide a quick overview of the best way to use our platform and help you determine the ideal module or tool to start with, depending on your current stage in the college prep process.
                </p>
            </li>
            <li>
                <p>
                    <b>Start Exploring:</b>
                    Dive into the comprehensive modules and tools we offer. No matter where you are in the college prep process, we have the best guides and tools created by long-time admissions and test prep experts. From test preparation materials to career assessments or financial aid guidance, we've got you covered.
                </p>
            </li>
        </ol>
    </p>
    @include('email-template.components.email-footer')
@endsection