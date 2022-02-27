<a href="{{ route('employees.edit', $id ) }}" class="btn btn-warning btn-circle mb-2">
    <i class="fas fa-pencil-alt"> Edit</i>
</a>
<form action="{{ route('employees.destroy', $id) }}" method="post" class="d-inline">
    @csrf 
    @method('DELETE')
    <button class="btn btn-danger btn-circle mb-2">
        <i class="fas fa-trash"> Delete</i>
    </button>
</form>