<!-- <script>
$(document).ready(function () {
$('#table_id').DataTable();
});
</script> -->

<div class="tab-pane" id="user-manager">
    <div style = "padding-top:2em;">
				<div class="form-group">
                    Search by Name : <input type="text" class="form-controller" id="search" name="search"></input>
                </div>
				<table class="table table-bordered table-hover" id = "table_id">
					<thead>
						<tr>
							<td style = "background:#D8D8D8;"><h5>Full Name</h5></td>
							<td style = "background:#D8D8D8;" ><h5>Email</h5></td>
							<td style = "background:#D8D8D8;"><h5>Updated At</h5></td>
							<td style = "background:#D8D8D8;"><h5>Phone</h5></td>
                            <td style = "background:#D8D8D8;"><h5>Account Type</h5></td>
							<!-- <td ></td> -->
						</tr>
					</thead>
					<tbody>
						@foreach($users as $us)
                        <tr>
							<td class="cart_description">
								<h5>{{$us->name}}</h5>
							</td>
							<td class="cart_description">
                            <h5>{{$us->email}}</h5>
							</td>
							<td class="cart_description">
                            <h5>{{ \Carbon\Carbon::parse($us->updated_at)->format('d/m/Y')}}</h5>
							</td>
                            <td class="cart_description">
								<h5>{{$us->phone}}</h5>
                            </td>
                            <td class="cart_description">
								<h5>
                                    @if($us->is_admin==1)
                                        Admin
                                    @else
                                        User
                                    @endif
                                </a>
							</td>
                            <td>
                                @if($us->is_admin==0)
								 <input type = "button" class = "btn btn-danger btn-sm" value = "Delete" id = "del_user" onclick = "del_user({{$us->id}})">
                           		 <!-- {!! Form::open(['action' => ['ProfileController@destroy',$us->id],'method'=>'POST']) !!}
									{{Form::hidden('_method','DELETE')}}
									{{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                           		 {!! Form::close() !!}    -->
                                @endif
							</td>
						</tr>
                        @endforeach
					</tbody>
				</table>
			</div>               
</div><!--/tab-pane-->
<script type="text/javascript">
            $('#search').on('keyup',function(){
				
                $value = $(this).val();
				console.log($value);
                $.ajax({
                    type: 'get',
                    url: '{{  url('search') }}',
                    data: {
						
                        'search': $value
                    },
                    success:function(data){
                        $('tbody').html(data);
                    }
                });
            })
			function del_user(id){
				console.log(id);
				$.ajax({
                    type: 'delete',
                    url: '{{  url('del_user') }}',
                    data: ({
						_token : $('meta[name="csrf-token"]').attr('content'), 
                        'id':id
                    }),
                    success:function(data){
                        $('tbody').html(data);
                    }
                });
			}
			$.ajaxSetup({
 			 headers: {
  			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 				}
			});
			// $('#del_user').on('onclick',function(){
                
            // })
            // $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>