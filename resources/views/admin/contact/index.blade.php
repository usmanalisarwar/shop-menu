@extends('admin.layouts.app')

@section('content')
<div class="section">
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Contacts
        </div>

        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Message</th>
              </tr>
            </thead>
            <tbody>
              @foreach($contacts as $contact)
              <tr>
                <th scope="row">{{ $contact->id }}</th>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->message }}</td>
                <td>
                  <!-- Action buttons could be added here, like Edit, Delete -->
                </td>
              </tr>
              @endforeach 
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
