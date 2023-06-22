<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<head><base href="../../">
    <meta charset="utf-8" />
    <title>Braintree | Certification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,600;1,900&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,600;1,900&display=swap');
    </style>
</head>

<body style="margin: -45px">
    <div style="width:1685px; heigth: 1191px;" >
        <img src="{{ public_path('images/certification.jpg') }}" style="width:100%;height:100%;position:absolute;left:0;top:0" />
        <div style="position: absolute; margin-top: 600px; left: 50%; transform: translateX(-50%); font-size: 110px; font-weight: 600; font-style: italic;font-family: 'Playfair Display', serif;">{{ $name }}</div>
        <div style="position: absolute; margin-top: 840px; width:65%; text-align: center; left: 50%; transform: translateX(-50%); font-size: 45px; font-weight: 400; font-style: italic">
            {{ __('has successfully completed the') }} <b>{{ $course_title }}</b> {{ __('course conducted by') }} Mr.Jerome Silva between
            {{ $course_started_date }} to {{ $course_completed_date }}
        </div>
    </div>
</body>
</html>
