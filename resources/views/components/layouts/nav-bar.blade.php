<div class="d-flex align-items-center">
    <div class="d-flex align-items-center me-3">
        <span class="badge bg-primary text-white rounded-circle fs-3 px-2 py-2">
            {{ substr(auth()->user()->names, 0, 1) }}{{ substr(auth()->user()->lastnames, 0, 1) }}
        </span>
        <span class="ms-2">{{ auth()->user()->names }}</span>
    </div>

    <form action="{{ route('logout') }}" method="POST" class="mb-0">
        @csrf
        <button type="submit" class="btn btn-danger btn-sm">
            <i class="bi bi-box-arrow-right"></i> Logout
        </button>
    </form>
</div>
