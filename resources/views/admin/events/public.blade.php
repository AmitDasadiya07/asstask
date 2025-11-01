@extends('layouts.app')

@section('content')
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    .card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 15px;
        overflow: hidden;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    }

    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15) !important;
    }

    .section-title {
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 25px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 80px;
        height: 4px;
        border-radius: 2px;
        transition: width 0.3s ease;
    }

    .section-title:hover::after {
        width: 120px;
    }

    .text-primary.section-title::after {
        background: linear-gradient(90deg, #007bff, #0056b3);
    }

    .text-success.section-title::after {
        background: linear-gradient(90deg, #28a745, #1e7e34);
    }

    .text-danger.section-title::after {
        background: linear-gradient(90deg, #dc3545, #bd2130);
    }

    .main-title {
        animation: pulse 2s infinite;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }

    .card-body {
        position: relative;
        padding: 1.5rem;
    }

    .card-title {
        color: #2d3748;
        font-weight: 600;
        margin-bottom: 12px;
        transition: color 0.3s ease;
    }

    .card:hover .card-title {
        color: #667eea;
    }

    .card-text {
        color: #4a5568;
        line-height: 1.6;
    }

    .event-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 2px solid #e2e8f0;
    }

    .event-meta strong {
        color: #667eea;
    }

    .no-events {
        padding: 40px;
        text-align: center;
        background: linear-gradient(135deg, #f6f8fb 0%, #e9ecef 100%);
        border-radius: 15px;
        margin-top: 20px;
    }

    .event-section {
        margin-bottom: 50px;
        animation: slideInLeft 0.8s ease-out;
    }

    .container {
        animation: fadeInUp 0.5s ease-out;
    }

    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        transition: width 0.3s ease;
    }

    .card:hover::before {
        width: 8px;
    }

    .event-section:nth-child(1) .card::before {
        background: linear-gradient(180deg, #007bff, #0056b3);
    }

    .event-section:nth-child(2) .card::before {
        background: linear-gradient(180deg, #28a745, #1e7e34);
    }

    .event-section:nth-child(3) .card::before {
        background: linear-gradient(180deg, #dc3545, #bd2130);
    }

    @media (max-width: 768px) {
        .event-meta {
            flex-direction: column;
            gap: 10px;
        }
    }
</style>

<div class="container mt-4">
    <h1 class="mb-4 text-center main-title">🎯 Dynamic Events</h1>

    {{-- Today's Events --}}
    <div class="mb-5 event-section">
        <h3 class="text-primary section-title">📅 Today's Events</h3>
        @if($todayEvents->count())
            @foreach($todayEvents as $event)
                <div class="card mt-3 shadow-sm animate-fade-in-up" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ $event->description }}</p>
                        <p class="text-muted mb-0 event-meta">
                            <span><strong>Date:</strong> {{ $event->date->format('Y-m-d') }}</span>
                            @if($event->time)
                                <span><strong>Time:</strong> {{ $event->time }}</span>
                            @endif
                            @if($event->location)
                                <span><strong>Location:</strong> {{ $event->location }}</span>
                            @endif
                        </p>
                    </div>
                </div>
            @endforeach
        @else
            <div class="no-events">
                <p class="text-muted mb-0">No events today.</p>
            </div>
        @endif
    </div>

    {{-- Future Events --}}
    <div class="mb-5 event-section">
        <h3 class="text-success section-title">🚀 Future Events</h3>
        @if($futureEvents->count())
            @foreach($futureEvents as $event)
                <div class="card mt-3 shadow-sm animate-fade-in-up" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ $event->description }}</p>
                        <p class="text-muted mb-0 event-meta">
                            <span><strong>Date:</strong> {{ $event->date->format('Y-m-d') }}</span>
                            @if($event->time)
                                <span><strong>Time:</strong> {{ $event->time }}</span>
                            @endif
                            @if($event->location)
                                <span><strong>Location:</strong> {{ $event->location }}</span>
                            @endif
                        </p>
                    </div>
                </div>
            @endforeach
        @else
            <div class="no-events">
                <p class="text-muted mb-0">No upcoming events.</p>
            </div>
        @endif
    </div>

    {{-- Past Events --}}
    <div class="mb-5 event-section">
        <h3 class="text-danger section-title">⌛ Past Events</h3>
        @if($pastEvents->count())
            @foreach($pastEvents as $event)
                <div class="card mt-3 shadow-sm animate-fade-in-up" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ $event->description }}</p>
                        <p class="text-muted mb-0 event-meta">
                            <span><strong>Date:</strong> {{ $event->date->format('Y-m-d') }}</span>
                            @if($event->time)
                                <span><strong>Time:</strong> {{ $event->time }}</span>
                            @endif
                            @if($event->location)
                                <span><strong>Location:</strong> {{ $event->location }}</span>
                            @endif
                        </p>
                    </div>
                </div>
            @endforeach
        @else
            <div class="no-events">
                <p class="text-muted mb-0">No past events.</p>
            </div>
        @endif
    </div>
</div>
@endsection