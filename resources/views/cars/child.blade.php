<table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <th>{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->status == 0 ? 'Inactive' : 'Active' }} </td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $users->links() !!} 
{{ $users->appends(request()->query())->links() }}