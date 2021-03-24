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
                    @if(sizeof($rolePermissions) == 0)
                        <tr>
                            <td colspan="3" style="text-align: center">
                                Data Kosong
                            </td>
                        </tr>
                    @endif
                    @foreach ($rolePermissions as $r)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $r->name }}
                            </td>
                            <td>
                                <form class="destroy" action="{{ route('role_permission.permission.destroy',['id_permission' => $r->id]) }}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <input type="hidden" name="role" value="{{$role->id}}">
                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
