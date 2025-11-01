@extends('layouts.app')

@section('content')
<style>
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes gradientShift {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    .container {
        animation: fadeInScale 0.5s ease-out;
        max-width: 800px;
    }

    h1 {
        animation: slideInRight 0.6s ease-out;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%, #667eea 200%);
        background-size: 200% 200%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        margin-bottom: 30px;
        animation: gradientShift 3s ease infinite, slideInRight 0.6s ease-out;
    }

    form {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        animation: fadeInScale 0.7s ease-out;
        position: relative;
        overflow: hidden;
    }

    form::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(102, 126, 234, 0.05), transparent);
        transform: rotate(45deg);
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
        0% {
            transform: translateX(-100%) rotate(45deg);
        }
        100% {
            transform: translateX(100%) rotate(45deg);
        }
    }

    .form-label {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 8px;
        transition: color 0.3s ease;
        position: relative;
        z-index: 1;
    }

    .form-control, .form-select {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 16px;
        transition: all 0.3s ease;
        background: #f8f9fa;
        position: relative;
        z-index: 1;
    }

    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background: white;
        transform: translateY(-2px);
    }

    .form-control:hover, .form-select:hover {
        border-color: #cbd5e0;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .mb-3 {
        animation: slideInRight 0.5s ease-out;
        animation-fill-mode: both;
        position: relative;
        z-index: 1;
    }

    .mb-3:nth-child(1) { animation-delay: 0.1s; }
    .mb-3:nth-child(2) { animation-delay: 0.2s; }
    .mb-3:nth-child(3) { animation-delay: 0.3s; }
    .mb-3:nth-child(4) { animation-delay: 0.4s; }

    .row .mb-3:nth-child(1) { animation-delay: 0.3s; }
    .row .mb-3:nth-child(2) { animation-delay: 0.35s; }

    .btn {
        border-radius: 12px;
        padding: 12px 32px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        border: none;
        position: relative;
        overflow: hidden;
        z-index: 1;
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
        width: 400px;
        height: 400px;
    }

    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    .btn-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        animation: slideInRight 0.6s ease-out 0.5s both;
    }

    .btn-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
        animation: slideInRight 0.6s ease-out 0.55s both;
        margin-left: 10px;
    }

    .input-icon {
        position: relative;
    }

    .input-icon::after {
        content: '✨';
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .input-icon:focus-within::after {
        opacity: 1;
    }

    @media (max-width: 768px) {
        form {
            padding: 25px;
        }

        .btn {
            width: 100%;
            margin-bottom: 10px;
        }

        .btn-secondary {
            margin-left: 0;
        }
    }
</style>

<div class="container mt-4">
    <h1>Add New Event</h1>

    <form action="{{ route('admin.events.store') }}" method="POST" class="mt-4">
        @csrf

        <div class="mb-3">
            <label class="form-label">Title *</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Date *</label>
                <input type="date" name="date" class="form-control" value="{{ old('date') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Time</label>
                <input type="time" name="time" class="form-control" value="{{ old('time') }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control" value="{{ old('location') }}">
        </div>

        <button class="btn btn-success">Save Event</button>
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection