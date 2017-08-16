@extends('layout.default')
@section('title')
用户列表
@stop 
@section('content')  

<div class="row"> 
    <div class="col-lg-12">  
        @if(isset($accounts))
        {{ $accounts->links() }}
        <table class="table table-bordered table-hover table-striped tablesorter">
            <thead>
                <tr>  
                    <th>Id </th>
                    <th>Nome  </th>
                    <th>Card  </th>
                    <th>Phone  </th>
                    <th>Vitórias  </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accounts as $account)
                <tr> 
                    <td> {{ $account->id }}</td>
                    <td> {{ $account->name }}</td>
                    <td> {{ $account->idcard }}</td>
                    <td> {{ $account->phone }}</td>
                    <td> {{ $account->win_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table> 
        {{ $accounts->links() }}
        @endif
    </div>  

</div><!-- /.row -->
@stop

@section('scripts')
<!-- Page Specific Plugins -->
<script src="{{asset('js/tablesorter/jquery.tablesorter.js')}}"></script>
<script src="{{asset('js/tablesorter/tables.js')}}"></script>

@stop
