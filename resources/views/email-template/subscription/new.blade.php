@extends('email-template.layout.mail')

@section('mail-head')
    <title>Welcome to College Prep System - Your College Journey Begins Today</title>
@endsection

@section('mail-content')

    <p>
        Congratulations on taking a pivotal step in your college preparation journey! We're thrilled to welcome you to {{ $plan_name }} with College Prep System. With this subscription, you've unlocked a wealth of resources designed to simplify, streamline, and supercharge your path to college.
    </p>

    <p><b>Here's What Awaits You:</b></p>
    <ol>
        <li>
            <p>
                <b>Expert-Crafted Modules: </b>
                Dive into detailed modules on college admissions, test prep, profile development, financial aid, and more.
            </p>
        </li>
        <li>
            <p>
                <b>Comprehensive Test Prep: </b>
                Access in-depth score reports, study resources, and personalized strategies for ACT, SAT, and PSAT.
            </p>
        </li>
        <li>
            <p>
                <b>College & Career Exploration: </b>
                Navigate an extensive database of colleges, career paths, and majors, tailored to align with your aspirations.
            </p>
        </li>
        <li>
            <p>
                <b>Personalized Dashboard: </b>
                Your central hub to track progress, set milestones, and access all the tools you need.
            </p>
        </li>
        <li>
            <p>
                <b>Exclusive Tools & Features: </b>
                From our High School Resume tool to the College Cost Comparison tool, your subscription grants you comprehensive access.
            </p>
        </li>
    </ol>

    <p><b>Getting Started:</b></p>
    <ol>
        <li>
            <p>
                <b>Log In & Explore: </b>
                Dive right in by logging into your account and exploring your personal dashboard.
            </p>
        </li>
        <li>
            <p>
                <b>Onboarding Tour: </b>
                Don't miss our "Getting Started" video guide, which offers a walkthrough of our platform.
            </p>
        </li>
        <li>
            <p>
                <b>Personalize Your Experience: </b>
                Add your test score goals, target colleges, and more to tailor the platform to your unique needs.
            </p>
        </li>
    </ol>

    <p>As you navigate the complexities of college preparation, remember you're not alone. We're here every step of the way, committed to providing the guidance, tools, and expertise to ensure your success.</p>

    <p>Should you have any questions, need support, or just want to share feedback, don't hesitate to contact our dedicated team at 
        @include('email-template.components.system-email'). 
        We're here to help!
    </p>
    
    
    @include('email-template.components.email-footer', [
        'custom_final_message' => 'Thank you for choosing College Prep System to help achieve your college dreams. Here\'s to achieving remarkable milestones together!'    
    ])
@endsection 