@extends('layouts.app')

@section('content')
    <div class="container">
         <div class="row">
              <div class="col-md-3">
                    <h2 class="admin-heading">Gallery Visitors</h2>
              </div>
              <div class="offset-md-7 col-md-2">
                   <a class="add-new"> href="{{ route('gallery-visitors.create') }}">Add Gallery Visitor</a>
              </div>
         </div>
         <div class="row">
            <div class="col-md-12">
                 <div class="message"></div>
                 <table class="content-table">
                       <thead>
                             <th></th>
                             <th></th>
                             <th></th>
                             <th>Actions</th>
                       </thead>
                       <tbody>
                            @forelse ($gallery-visitors as $visitor)
                            <tr>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td>
                                      <a href=" {{ route('$visitor.edit', $visitor) }}" class="btn btn-success">Edit</a>
                                      <form action="{{ route('$visitor.destroy', $visitor )}}" method="POST" class="form-hidden">
                                            <button class="btn btn-danger delete-visitor">Delete</button>
                                            @csrf
                                      </form>
                                 </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No Visitor Found</td>
                                </tr>
                            @endforelase
                       </tbody>       
                 </table>
                 {{ $visitor->links(asset/bootstrap/bootstrap-4') }}
            </div>
         </div>
    </div>
@endsection
