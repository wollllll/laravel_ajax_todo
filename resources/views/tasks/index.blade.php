@extends('layouts._base')

@section('content')
    <main>
        <div class="container w-75">
            <section>
                <h1>俺のTODO</h1>
            </section>

            <section>
                <textarea class="form-control" name="store-content" rows="6"></textarea>
                <div class="w-50 mx-auto mt-5">
                    <input type="submit" id="store-btn" class="btn btn-outline-primary btn-block"
                           data-store-url="{{ route('tasks.store') }}" value="記録">
                </div>
            </section>

            <section class="mt-5">
                <ul id="task-lists" class="row">
                    @foreach($tasks as $task)
                        @include('tasks.list')
                    @endforeach
                </ul>
            </section>

            <section>
                <div class="mx-auto w-25 mt-3">
                    <button type="button" id="show-more-btn" class="btn btn-outline-secondary w-100"
                            data-show-more-url="{{ route('tasks.showMore') }}">
                        show more
                    </button>
                </div>
            </section>
        </div>
    </main>
@endsection
