@extends('layouts.app')

@section('content')
<style>
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.3);
        }
        50% {
            opacity: 1;
            transform: scale(1.05);
        }
        70% {
            transform: scale(0.9);
        }
        100% {
            transform: scale(1);
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

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.02);
        }
    }

    @keyframes glow {
        0%, 100% {
            box-shadow: 0 0 20px rgba(102, 126, 234, 0.3);
        }
        50% {
            box-shadow: 0 0 40px rgba(102, 126, 234, 0.6);
        }
    }

    .container {
        animation: fadeInDown 0.6s ease-out;
    }

    h1 {
        animation: bounceIn 0.8s ease-out;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
    }

    .d-flex.justify-content-end {
        animation: fadeInDown 0.7s ease-out;
    }

    .btn {
        transition: all 0.3s ease;
        border-radius: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
        border: none;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .btn-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
    }

    .btn-info {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    }

    .accordion {
        animation: slideInLeft 0.8s ease-out;
    }

    .accordion-item {
        border: none;
        border-radius: 15px !important;
        overflow: hidden;
        margin-bottom: 20px !important;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        animation: slideInLeft 0.6s ease-out;
        animation-fill-mode: both;
    }

    .accordion-item:nth-child(1) { animation-delay: 0.1s; }
    .accordion-item:nth-child(2) { animation-delay: 0.2s; }
    .accordion-item:nth-child(3) { animation-delay: 0.3s; }

    .accordion-item:hover {
        transform: translateX(5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }

    .accordion-button {
        border: none !important;
        padding: 20px 25px;
        font-weight: 700;
        font-size: 1.1rem;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .accordion-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }

    .accordion-button:hover::before {
        left: 100%;
    }

    .accordion-button:not(.collapsed) {
        box-shadow: none;
        animation: pulse 0.5s ease-out;
    }

    .accordion-button.bg-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
    }

    .accordion-button.bg-primary {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
    }

    .accordion-button.bg-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%) !important;
    }

    .accordion-body {
        padding: 25px;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    }

    .card {
        border: none;
        border-radius: 12px;
        transition: all 0.3s ease;
        background: white;
        overflow: hidden;
        position: relative;
    }

    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, #667eea, #764ba2);
        transition: width 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        animation: glow 2s infinite;
    }

    .card:hover::before {
        width: 8px;
    }

    .card-body {
        padding: 20px;
    }

    .card-body h5 {
        color: #2d3748;
        font-weight: 700;
        margin-bottom: 12px;
        transition: color 0.3s ease;
    }

    .card:hover h5 {
        color: #667eea;
    }

    .card-body p {
        color: #4a5568;
        line-height: 1.6;
        margin-bottom: 10px;
    }

    .card-body small {
        color: #718096;
        font-weight: 500;
    }

    .text-muted {
        background: linear-gradient(135deg, #e9ecef 0%, #f8f9fa 100%);
        padding: 30px;
        border-radius: 12px;
        text-align: center;
        font-style: italic;
    }

    .accordion-collapse {
        transition: all 0.3s ease-in-out;
    }

    @keyframes expandAccordion {
        from {
            opacity: 0;
            max-height: 0;
        }
        to {
            opacity: 1;
            max-height: 1000px;
        }
    }

    .accordion-collapse.show {
        animation: expandAccordion 0.4s ease-out;
    }

    @media (max-width: 768px) {
        .accordion-button {
            font-size: 1rem;
            padding: 15px 20px;
        }

        .accordion-item:hover {
            transform: translateX(0);
        }
    }
</style>

<div class="container mt-4">
    <h1 class="text-center mb-4">🎯 Categorized Events</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary me-2">🔙 Back to All Events</a>
        <a href="{{ route('admin.events.categorized') }}" class="btn btn-info">🔄 Refresh</a>
    </div>

    {{-- Accordion Layout --}}
    <div class="accordion" id="eventAccordion">
        @foreach ([
            'Today\'s Events' => ['events' => $todayEvents, 'color' => 'success'],
            'Future Events' => ['events' => $futureEvents, 'color' => 'primary'],
            'Past Events' => ['events' => $pastEvents, 'color' => 'secondary']
        ] as $label => $data)
        <div class="accordion-item mb-3">
            <h2 class="accordion-header">
                <button class="accordion-button bg-{{ $data['color'] }} text-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ Str::slug($label) }}">
                    {{ $label }} ({{ $data['events']->count() }})
                </button>
            </h2>
            <div id="{{ Str::slug($label) }}" class="accordion-collapse collapse">
                <div class="accordion-body">
                    @forelse ($data['events'] as $e)
                        <div class="card mb-2 shadow-sm">
                            <div class="card-body">
                                <h5>{{ $e->title }}</h5>
                                <p class="text-muted">{{ $e->description }}</p>
                                <small>{{ $e->date->format('Y-m-d') }} {{ $e->time ?? '' }} - {{ $e->location ?? 'N/A' }}</small>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No events found.</p>
                    @endforelse
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection