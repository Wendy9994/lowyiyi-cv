<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile->name }} - CV</title>
    
    <!-- Regular styles for normal view -->
    <link rel="stylesheet" href="{{ asset('css/pillar-1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
    <article class="resume-wrapper text-center position-relative">
        <div class="resume-wrapper-inner mx-auto text-start bg-white shadow-lg">
            <header class="resume-header pt-4 pt-md-0">
                <div class="row">
                    <div class="col-md-auto resume-picture-holder text-center">
                        <img class="picture" src="{{ asset('images/profile.webp') }}" alt="Profile Image">
                    </div>
                    <div class="col">
                        <div class="primary-info col-auto">
                            <h1 class="name mt-0 mb-1 text-white text-uppercase">{{ $profile->name }}</h1>
                            <div class="title mb-3">Diploma in Computer Science (Internet Computing)</div>
                            <ul class="list-unstyled">
                                <ul class="list-unstyled contact-info">
                                    <li><i class="fas fa-envelope me-2"></i> {{ $profile->email }}</li>
                                    <li><i class="fas fa-phone me-2"></i> {{ $profile->phone }}</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i> {{ $profile->location }}</li>
                                </ul>                                                              
                            </ul>
                        </div>
                    </div>
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
                        <div class="resume-timeline position-relative">
                            @foreach($experience as $exp)
                                <article class="resume-timeline-item position-relative pb-5">
                                    <div class="resume-timeline-item-header mb-2">
                                        <div class="d-flex flex-column flex-md-row">
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
                            <li class="mb-2">{{ $skill->category }} - {{ $skill->name }}</li>
                                <div class="progress resume-progress">
                                 <!-- Use style attribute to set width or aria-valuenow to set the progress -->
                                    <div   div class="progress-bar theme-progress-bar-dark" role="progressbar" 
                                         style="width: {{ $skill->proficiency }}%" 
                                         aria-valuenow="{{ $skill->proficiency }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                    </div>
                                </div>
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
                
                <a href="{{ route('cv.preview') }}" target="_blank" class="btn btn-success">
                    <i class="fas fa-print"></i> Print CV
                </a>   
            </div>
        </div>
    </article>
</body>
</html>