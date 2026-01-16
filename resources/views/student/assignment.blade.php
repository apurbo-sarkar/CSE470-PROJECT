@extends('student.app') 

@section('content')

<div class="container">
    <header>
        <h1>📚 My Assignments</h1>
        <p>Select a file below to download the requirements.</p>
    </header>

    <div class="assignment-grid">
        @forelse($assignments as $assignment)
            <div class="card">
                <div>
                    <h2 class="title">{{ $assignment->title }}</h2>
                    <p class="details">{{ $assignment->description }}</p>
                </div>
                <a href="{{ route('assignments.download', $assignment->id) }}" class="download-link" download>
                    Download {{ pathinfo($assignment->file_path, PATHINFO_EXTENSION) }}
                </a>
            </div>
        @empty
            <p>No assignments available yet.</p>
        @endforelse
    </div>
</div>

@endsection

@push('styles')
<style>
    :root {
        --primary: #2563eb;
        --bg: #f1f5f9;
        --card-bg: #ffffff;
        --text: #334155;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--bg);
        color: var(--text);
        margin: 0;
        padding: 40px 20px;
    }

    .container {
        max-width: 1000px;
        margin: 0 auto;
    }

    header {
        text-align: center;
        margin-bottom: 40px;
    }

    /* Responsive Grid Layout */
    .assignment-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }

    .card {
        background: var(--card-bg);
        padding: 24px;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .badge {
        display: inline-block;
        padding: 4px 12px;
        background: #e2e8f0;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: bold;
        margin-bottom: 12px;
        align-self: flex-start;
    }

    .title {
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0 0 10px 0;
        color: #1e293b;
    }

    .details {
        font-size: 0.9rem;
        color: #64748b;
        margin-bottom: 20px;
    }

    .download-link {
        background-color: var(--primary);
        color: white;
        text-align: center;
        text-decoration: none;
        padding: 10px;
        border-radius: 8px;
        font-weight: 600;
        transition: opacity 0.2s;
    }

    .download-link:hover {
        opacity: 0.9;
    }
</style>
@endpush