@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 class="admin-heading">Add Artwork to{{ @exhibition->title }}</h2>
                <form action="{{ route('exhibition-.Artwork.store', $exhibition-id) }}" method="POST">
                    @csrf 
                        <div class="form-group">
                            <label for="artwor">Artwork</label>
                            <select name="artwork_id" id="artwork_id" class="form-control">
                                @foreach(@artworks as $arwork)
                                    <option value="{{ artwork->id }}">{{ $artwork->title }}</option>
                                @endforeach
                            </section>
                        </div>
                        <div class="form-group">
                            <label for="display_date">Display Date</label>
                            <input type="date" name="display_date" id="display_day" class="form-control" required>
                        </div>
                        <div class="form-grop">
                            <label for="placement">Placement</label>
                            <input type="text" name="placement" class="form-control">
                        </div>
                        <button type="submit" class="btn btn--primary">Add Artwork</button>
                </form>
            </div>
        </div>
    </div>
@endsection
