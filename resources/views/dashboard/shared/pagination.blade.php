<div class="row mb-3">
    <div class="col-6">
        <form method="GET" action="{{ url()->current() }}">
            <select id="perPage" name="per_page" class="form-control w-auto d-inline" onchange="this.form.submit()">
                <option value="5" {{ ($filters['per_page'] ?? 10) == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ ($filters['per_page'] ?? 10) == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ ($filters['per_page'] ?? 10) == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ ($filters['per_page'] ?? 10) == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ ($filters['per_page'] ?? 10) == 100 ? 'selected' : '' }}>100</option>
            </select>
            @foreach (request()->except('per_page') as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
        </form>
    </div>
</div>
