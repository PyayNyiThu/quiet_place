<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr align="center">
                    <th>{{__('messages.no')}}</th>
                    <th>{{__('messages.price')}}</th>
                    <th>{{__('messages.photo')}}</th>
                    <th>{{__('messages.rooms.description')}}</th>
                    <th>{{__('messages.rooms.room_type')}}</th>
                    <th>{{__('messages.township')}}</th>
                    <th>{{__('messages.size')}}</th>
                    <th>{{__('messages.capacity')}}</th>
                    <th>{{__('messages.rooms.service')}}</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($rooms as $row)
                    <tr align="center">
                        <td>{{ $i++ }}</td>
                        <td>{{ $row->price }} MMK</td>
                        <td><img src="{{ asset($row->photo) }}" width="100" height="100"></td>
                        <td>{{ $row->description }}</td>
                        <td>{{ $row->roomtype->name }}</td>
                        <td>{{ $row->township->name }}</td>
                        <td>{{ $row->size }}</td>
                        <td>{{ $row->capacity }}</td>
                        <td>
                            @foreach ($row->services as $service)
                                {{ $service->name }} ,
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>