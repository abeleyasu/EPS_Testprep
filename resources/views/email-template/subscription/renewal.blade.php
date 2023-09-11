@extends('email-template.layout.mail')

@section('mail-head')
    <title>Reminder: Your Subscription Renewal is One Week Away!</title>
@endsection

@section('mail-content')
    <p>Thank you for choosing College Prep System to support your college preparation journey. Our primary goal is to ensure students have the best tools and resources to confidently tackle college applications, standardized tests, and the rest of the college prep process.</p>
    <p>
        <b>Important Reminder: </b>Your subscription for College Prep System is set to automatically renew in one week.
    </p>
    <p>
        <b>Subscription Details:</b>
        <table>
            <tr>
                <td>Plan:</td>
                <td>{{ $plan_name }}</td>
            </tr>
            <tr>
                <td>Renewal Date:</td>
                <td>{{ $renewal_date }}</td>
            </tr>
            <tr>
                <td>Price:</td>
                <td>{{ $amount }}</td>
            </tr>
        </table>
    </p>
    <p>
        <b>To ensure a seamless continuation of our services, please take a moment to:</b>
    </p>
    <p>
        <ol>
            <li>
                <p>
                    <b>Update payment methods: </b>
                    if there have been any recent changes to your credit card or bank details. We remain committed to providing you with a comprehensive system that boosts confidence, performance, and success in the college application process.
                </p>
            </li>
        </ol>
    </p>
    <p>If you decide not to continue with the subscription, you can cancel at any time before the renewal date. Instructions for cancellation can be found in your account settings or our FAQs.</p>
    <p>For any questions, concerns, or feedback, please don't hesitate to reach out to our dedicated customer support team at @include('email-template.components.system-email').</p>
    @include('email-template.components.email-footer')
@endsection