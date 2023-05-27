@extends('backend.layout')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Phân quyền - {{ $user->name }}</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('role.index') }}">Admin</a></li>
                <li class="breadcrumb-item active">Phân quyền cho {{ $user->name }}</li>
            </ol>
            {{-- Đệ qui functions --}}
            @if (session('mess'))
                <div class="alert alert-success">{{ session('mess') }}</div>
            @endif
            <form action="{{ route('role.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <ul style="list-style: none">
                    @foreach ($fun as $fun)
                        <li>
                            <label><input type="checkbox" name="funs[]" value="{{ $fun->id }}"
                                    @if (in_array($fun->id, $funs)) {{ 'checked' }} @endif>
                                {{ $fun->name }}</label>
                            <ul style="list-style: none">
                                @foreach (App\Models\Fun::where('parent_id', $fun->id)->get() as $child)
                                    <li>
                                        <label><input type="checkbox" name="funs[]" value="{{ $child->id }}"
                                                @if (in_array($child->id, $funs)) {{ 'checked' }} @endif>
                                            {{ $child->name }}</label>
                                        <ul style="list-style: none">
                                            @foreach (App\Models\Fun::where('parent_id', $child->id)->get() as $child_2)
                                                <li>
                                                    <label><input type="checkbox" name="funs[]"
                                                            value="{{ $child_2->id }}"
                                                            @if (in_array($child_2->id, $funs)) {{ 'checked' }} @endif>
                                                        {{ $child_2->name }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
                <button class="btn btn-primary">GHI</button>
                <a href="{{route('role.index')}}" class="btn btn-warning">Quay về</a>
            </form>
        </div>
    </main>
@endsection
