<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile->name }} - CV</title>

    <!-- Inline CSS to Ensure Styling Works in PDF -->
    <style>

        @page {
            margin: 20px;
            margin-left: 30px;
            margin-right: 30px;
        }

        body {
            font-family: 'Roboto', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .resume-header {
            height: 188px;
            display: flex;
            align-items: center;
            background-color: #263a43;
            color: white;
            padding: 20px;
            position: relative;
        }       

        .resume-header .picture-holder {
            width: 200px; /* Adjust width as needed */
            height: 228px; /* Adjust height as needed */
            overflow: hidden;
            position: absolute;
            left: 0;
            bottom: 0;
        }

        .resume-header .name{
            font-size: 2.25rem;
            letter-spacing: 0.175rem;
        }

        .resume-header .title{
            font-size: 1.3rem;
        }

        .resume-header .picture {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .primary-info {
            margin-left: 200px; /* Push right side content */
            flex: 1;
            text-align: left; /* Align text properly */
            margin-top: 4px;
            color: rgba(255, 255, 255, 0.9);
        }

        h1 {
            margin: 0;
            font-size: 22px;
            text-transform: uppercase;
        }

        .title {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .contact-info {
            list-style: none;
            padding: 0;
            padding: 10px;
        }

        .contact-info li {
            margin-bottom: 5px;
            padding-top: 5px;
        }

        .contact-info i {
            margin-right: 5px;
        }

        .section {
            margin-top: 20px;
            padding: 15px;
            border-bottom: 2px solid #ddd;
        }

        .resume-section-title {
            font-size: 1.25rem;
            position: relative;
            color: #263a43;
            margin-top: 30px;
            font-weight: 500;
            font-family: 'Roboto', sans-serif;
        }

        .resume-section-title:after {
            content: "";
            position: absolute; !important
            left: 1;
            right:1;
            top: 25;
            width: 100%;
            height: 1.5px;
            background: #8d9aad;
        }

        .resume-section-content {
            color: #58677c;
        }

        .text-uppercase {
            text-transform: uppercase !important;
        }

        .pb-3 {
            padding-bottom: 0.5rem !important;
        }

        .section h2 {
            color: #1e2a32;
            font-size: 18px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .section-content {
            font-size: 14px;
        }

        .page-break {
            page-break-before: always;
        }

        .resume-company-name {
            color: #58677c;
            font-size: 0.875rem;
            font-weight: 50;
        }

        .ms-auto {
            margin-left: auto !important;
        }

        .position-relative {
            position: relative !important;
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        /*timeline */
        .resume-timeline {
            position: relative;
            padding-left: 15px;
            border-left: 3px solid #aab4c3; /* Acts as the timeline */
        }

        /* Timeline Dot */
        .resume-timeline-item {
            position: relative;
            padding-left: 1.5rem;
        }

        .resume-timeline-item:before {
            content: "";
            position: absolute;
            left: -24px; /* Align with the border */
            top: 23px;
            width: 10px;
            height: 10px;
            background: white;
            border: 3px solid #58677c;
            border-radius: 50%;
        }

        ol, ul, dl {
            margin-top: 0;
            margin-bottom: 1.12rem;
        }

        .mb-1 {
            margin-bottom: 0.25rem !important;
        }

        .mb-2 {
            margin-bottom: 0.5rem !important;
        }
        
        .mb-5 {
            margin-bottom: 1rem !important;
        }

        .flex-column {
            flex-direction: column !important;
        }

        .d-flex {
            display: flex !important;
        }

        .pb-5 {
            padding-bottom: 1rem !important;
        }

        .list-unstyled {
            padding-left: 0;
            list-style: none;
        }

        /*education section */
        .edu-container {
            display: flex !important; /* Ensure flex is applied */
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }


        .resume-degree {
            font-size: 16px;
            font-weight: bold;
        }

        .resume-degree {
            color: #263a43;
        }

        .resume-degree-time {
            font-size: 14px;
            color: gray;
            white-space: nowrap;
            margin-left: auto; /* Push to the right */
        }

        .resume-degree-org {
            font-size: 0.875rem;
        }

        /*skill progress bar*/
        .resume-progress {
            height: 1rem;
        }

        .progress {
            border-radius: 2px;
        }

        .theme-progress-bar-dark {
            background-color: #263a43;
        }

        .progress, .progress-stacked {
            --bs-progress-height: 1rem;
            --bs-progress-font-size: 0.75rem;
            --bs-progress-bg: var(--bs-secondary-bg);
            --bs-progress-border-radius: var(--bs-border-radius);
            --bs-progress-box-shadow: var(--bs-box-shadow-inset);
            --bs-progress-bar-color: #fff;
            --bs-progress-bar-bg: #0d6efd;
            --bs-progress-bar-transition: width 0.6sease;
            display: flex;
            height: var(--bs-progress-height);
            overflow: hidden;
            font-size: var(--bs-progress-font-size);
            background-color: var(--bs-progress-bg);
            border-radius: var(--bs-progress-border-radius);
        }

        /*award */
        .resume-award-name {
            font-weight: bold;
            color: #263a43;
            padding-bottom: 10px;
        }

        .resume-award-desc {
            font-size: 0.875rem;
            padding-bottom: 10px;
        }

        .resume-lang-name {
            color: #263a43;
        }

        small, .small {
            font-size: 0.875em;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

    </style>


    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <article class="resume-wrapper text-center position-relative">
        <div class="resume-wrapper-inner mx-auto text-start bg-white shadow-lg">
            <header class="resume-header">
                <div class="picture-holder">
                    @php
                        $profileImage = file_exists(public_path('images/profile.webp')) 
                            ? 'data:image/webp;base64,' . base64_encode(file_get_contents(public_path('images/profile.webp'))) 
                            : '';
                    @endphp
                    <img class="picture" src="{{ $profileImage }}" alt="Profile Image">
                </div>
            
                <div class="primary-info">
                    <h1 class="name text-white text-uppercase">{{ $profile->name }}</h1>
                    <div class="title">Diploma in Computer Science (Internet Computing)</div>
                    <ul class="list-unstyled contact-info">
                        <li><img src="{{ public_path('images/email.png') }}" width="16"> {{ $profile->email }}</li>
                        <li><img src="{{ public_path('images/phone.png') }}" width="16"> {{ $profile->phone }}</li>
                        <li><img src="{{ public_path('images/location.png') }}" width="16"> {{ $profile->location }}</li>
                    </ul>                                                         
                </div>
            </header>
            
            <div class="resume-body p-5">
                <section class="resume-section summary-section mb-0">
                    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Profile</h2>
                <div class="resume-section-content">
                    <p class="mb-0">{{ $profile->profile }}</p>
                </div>
                </section>
            </div>
                
            <div class="resume-body p-5">
                <section class="resume-section experience-section mb-5">
                    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Work And Key Project Experience</h2>
                    <div class="resume-section-content">
                        <div class="resume-timeline">
                            @foreach($experience as $exp)
                                <article class="resume-timeline-item pb-5">
                                    <div class="resume-timeline-item-header mb-2">
                                        <div class="d-flex flex-md-row">
                                            <h3 class="resume-position-title font-weight-bold mb-1">{{ $exp->title }}</h3>
                                            <div class="resume-company-name ms-auto">{{ $exp->type }}</div>
                                        </div>                                            
                                    </div>
                                    <div class="resume-timeline-item-desc">
                                        <ul>
                                            @foreach(explode("\n", $exp->description) as $line)
                                                <li>{{ $line }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
            
                
                <section class="resume-section education-section mb-5">
                    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Education</h2>
                    <div class="resume-section-content">
                        <ul class="list-unstyled">
                            @foreach($education as $edu)
                                <li class="mb-2">
                                    <div class="edu-container">
                                        <span class="resume-degree font-weight-bold">{{ $edu->degree }}</span>
                                        <span class="resume-degree-time">
                                            {{ $edu->start_date ? \Carbon\Carbon::parse($edu->start_date)->year : 'N/A' }} - 
                                            {{ $edu->end_date ? \Carbon\Carbon::parse($edu->end_date)->year : 'Present' }}
                                        </span>
                                    </div>
                                    <div class="resume-degree-org">{{ $edu->institution }}</div>
                                    <div class="resume-degree-org">{{ $edu->cgpa }}</div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                
                <section class="resume-section skills-section mb-5">
                    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Skills</h2>
                    <div class="resume-section-content">
                        <ul class="list-unstyled">
                            @foreach($skills as $skill)
                                <li class="mb-2">
                                    {{ $skill->category }} - {{ $skill->name }}
                                    <div style="width: 100%; background-color: #dcdcdc; height: 10px; margin-top: 5px;">
                                        <div style="width: {{ $skill->proficiency }}%; background-color: #263a43; height: 10px;"></div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                
                
                
                <section class="resume-section awards-section mb-5">
                    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Awards</h2>
                    <div class="resume-section-content">
                        <ul class="list-unstyled">
                            @foreach($awards as $award)
                                <li class="mb-2">
                                    <div class="resume-award-name font-weight-bold">{{ $award->name }}</div>
                                    <div class="resume-award-desc">{{ $award->description }}</div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                
                <section class="resume-section language-section mb-5">
                    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Languages</h2>
                    <div class="resume-section-content">
                        <ul class="list-unstyled">
                            @foreach($languages as $language)
                                <li class="mb-2">
                                    <span class="resume-lang-name font-weight-bold">{{ $language->name }}</span>
                                    <small class="text-muted font-weight-normal">({{ $language->proficiency }})</small>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>

                <section class="resume-section reference-section mb-5">
                    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">References</h2>
                    <div class="resume-section-content">
                        <ul class="list-unstyled">
                            @foreach($references as $reference)
                                <li class="mb-3">
                                    <span style="font-weight: bold;">{{ $reference->name }}</span><br>
                                    <small class="text-muted">{{ $reference->position }}</small><br>
                                    <small class="text-muted">{{ $reference->email }}</small><br>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>

            </div>
        </div>
    </article>
</body>
</html>
