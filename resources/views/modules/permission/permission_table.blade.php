<h2 class="panel-title" style="padding: 1.5rem 0px">Permission</h2>
<table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="15%">No</th>
                        <th width="35%">Permission</th>
                        <th width="15%">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($rolePermissions as $r)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $r->name }}
                            </td>
                            <td>
                                <form class="destroy" action="{{ route('role_permission.permission.destroy',['id_permission' => $r->id_permission]) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="role" value="{{$role->id_role}}">
                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
