@extends('tasks.layout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center py-3">
                <h5 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-tasks me-2"></i>Task List
                </h5>
                <div>
                    <a href="{{ url('/task/export') }}" class="btn btn-success btn-sm" title="Export Tasks">
                        <i class="fas fa-file-export me-1"></i> Export
                    </a>
                    <a href="{{ url('/task/create') }}" class="btn btn-primary btn-sm" title="Add New Task">
                        <i class="fas fa-plus me-1"></i> Add Task
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($tasks->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-tasks fa-3x mb-3 text-muted"></i>
                        <h4>No tasks found</h4>
                        <p>Get started by creating a new task.</p>
                        <a href="{{ url('/task/create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Create Task
                        </a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Create_at</th>
                                    <th>Update_at</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="font-weight-bold">{{ $item->title }}</td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 250px;" title="{{ $item->description }}">
                                                {{ $item->description ?? '-' }}
                                            </div>
                                        </td>
                                        <td>
                                            @if($item->status == 'Pending')
                                                <span class="badge bg-warning text-dark">
                                                    <i class="fas fa-clock me-1"></i> Pending
                                                </span>
                                            @elseif($item->status == 'Completed')
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle me-1"></i> Completed
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at->format('M d, Y H:i:s') }}</td>
                                        <td>{{ $item->updated_at->diffForHumans() }}</td>
                                        <td class="text-end action-buttons">
                                            <a href="{{ url('/task/' . $item->id . '/edit') }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="Edit Task">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" 
                                                  action="{{ url('/task/' . $item->id) }}" 
                                                  class="d-inline" 
                                                  onsubmit="return confirm('Are you sure you want to delete this task?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger" 
                                                        title="Delete Task">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    @if(method_exists($tasks, 'links'))
                        <div class="d-flex justify-content-center mt-4">
                            {{ $tasks->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
