@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 class="admin-heading">Exhibition Artwork</h2>
            </div>
            <div class="offset-md-6 col-md-3">
                <a class="add-new"> href="{{ route('ExhibitionArtworks.create') }}">Add Exbihition Artwork</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                           <th>Title</th>
                           <th>Display Date</th>
                           <th>Placement</th>
                           <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($artworks as $artwork)
                            <tr>
                                <td>{{ $artwork->title }}</td>
                                <td>{{ $artworks->pivot->display_date ? $artwork->pivot->disply_date->format('Y-m-d'): 'N/A' }}</td>
                                <td>{{ $artwork->pivot->placement}}</td>
                                <td>
                                     <form action="{{ route('exhibitions.artworks.destroy',[$exhibination->id])" method="POST">
                                        @csrf 
                                            method('DELETE')
                                        <button type="submit" class="btn btn-danger">Remove</button
                                     </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
