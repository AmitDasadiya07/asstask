@extends('layouts.app')

@section('content')
<style>
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .container {
        animation: fadeIn 0.5s ease-out;
    }

    h1 {
        animation: slideDown 0.6s ease-out;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
    }

    .alert {
        animation: slideDown 0.5s ease-out;
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
    }

    .btn {
        transition: all 0.3s ease;
        border-radius: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
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

    .btn-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
    }

    .btn-info {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        border: none;
    }

    .btn-warning {
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        border: none;
        color: #fff;
    }

    .btn-danger {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border: none;
    }

    .table {
        animation: scaleIn 0.6s ease-out;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .table thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .table thead th {
        border: none;
        padding: 15px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #e2e8f0;
    }

    .table tbody tr:hover {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        transform: scale(1.01);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .table tbody td {
        padding: 15px;
        vertical-align: middle;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
        align-items: center;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 0.85rem;
        border-radius: 8px;
    }

    .d-flex.justify-content-between {
        animation: slideDown 0.7s ease-out;
    }

    .table-wrapper {
        background: white;
        border-radius: 15px;
        padding: 0;
        overflow: hidden;
    }

    .pagination {
        margin-top: 20px;
        animation: fadeIn 1s ease-out;
    }

    @media (max-width: 768px) {
        .action-buttons {
            flex-direction: column;
        }
        
        .table {
            font-size: 0.9rem;
        }
    }
</style>

<div class="container mt-4">
    <h1 class="mb-4">All Events</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('admin.events.create') }}" class="btn btn-success">+ Add New Event</a>
        <a href="{{ route('admin.events.categorized') }}" class="btn btn-info">View Categorized</a>
    </div>

    <div class="table-wrapper">
        <table class="table table-bordered table-striped shadow-sm">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->date }}</td>
                        <td>{{ $event->time ?? '-' }}</td>
                        <td>{{ $event->location ?? '-' }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this event?')">🗑️ Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</div>
@endsection