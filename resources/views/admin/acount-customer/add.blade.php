@extends('layouts.app')

@section('content')
    <!-- Add Author Modal -->
    <div class="modal fade" id="addAuthorModal" tabindex="-1" aria-labelledby="addAuthorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAuthorModalLabel">Add New Author</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/authors" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="authorName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="authorName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="authorEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="authorEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="authorFunction" class="form-label">Function</label>
                            <input type="text" class="form-control" id="authorFunction" name="function" required>
                        </div>
                        <div class="mb-3">
                            <label for="authorStatus" class="form-label">Status</label>
                            <select class="form-control" id="authorStatus" name="status" required>
                                <option value="Online">Online</option>
                                <option value="Offline">Offline</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="authorEmployed" class="form-label">Employed Date</label>
                            <input type="date" class="form-control" id="authorEmployed" name="employed_date" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Author</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
