<div class="table-responsive text-nowrap">
    <table class="table table-bordered py-4" id="myTable">
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
                <th>actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>

                    @foreach ($row as $cell)
                        @if ($cell != $loop->first)
                            <td>
                                {{ $cell }}
                            </td>
                        @endif
                    @endforeach

                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
                                    class="bx bx-dots-vertical-rounded"></i></button>
                            <div class="dropdown-menu">
                                <button type="button" class="btn-edit dropdown-item" data-bs-toggle="offcanvas"
                                    data-bs-target="#{{ $offcanvasId }}" aria-controls="offcanvasEnd"
                                    data-id="{{ $row[0] }}"><i class="bx bx-edit-alt me-1"></i>
                                    Edit
                                </button>
                                <form action="{{ route($delete, $loop->first) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
