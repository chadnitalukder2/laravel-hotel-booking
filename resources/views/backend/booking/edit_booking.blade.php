@extends('admin.admin_dashboard')
@section('admin') 

<div class="page-content">
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5">


        <div class="col">
         <div class="card radius-10 border-start border-0 border-3 border-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Booking No:</p>
                        <h6 class="my-1 text-info">{{ $editData->code }}</h6>

                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bxs-cart'></i>
                    </div>
                </div>
            </div>
         </div>
       </div>


       <div class="col">
        <div class="card radius-10 border-start border-0 border-3 border-danger">
           <div class="card-body">
               <div class="d-flex align-items-center">
                   <div>
                       <p class="mb-0 text-secondary">Booking Date:</p>
                       <h6 class="my-1 text-danger">{{ \Carbon\Carbon::parse($editData->created_at)->format('d/m/Y')  }}</h6>

                   </div>
                   <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i class='bx bxs-wallet'></i>
                   </div>
               </div>
           </div>
        </div>
      </div>


      <div class="col">
        <div class="card radius-10 border-start border-0 border-3 border-success">
           <div class="card-body">
               <div class="d-flex align-items-center">
                   <div>
                       <p class="mb-0 text-secondary">Payment Method </p>
                       <h6 class="my-1 text-success">{{ $editData->payment_method }}</h6>

                   </div>
                   <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-bar-chart-alt-2' ></i>
                   </div>
               </div>
           </div>
        </div>
      </div>


      <div class="col">
        <div class="card radius-10 border-start border-0 border-3 border-warning">
           <div class="card-body">
               <div class="d-flex align-items-center">
                   <div>
                       <p class="mb-0 text-secondary">Payment Stauts </p>
                       <h6 class="my-1 text-warning">
                         @if ($editData->payment_status == '1')
                        <span class="text-success">Complete</span>
                        @else
                        <span class="text-danger">Pending</span>
                         @endif</h6>

                   </div>
                   <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i class='bx bxs-group'></i>
                   </div>
               </div>
           </div>
        </div>
      </div> 

      <div class="col">
        <div class="card radius-10 border-start border-0 border-3 border-warning">
           <div class="card-body">
               <div class="d-flex align-items-center">
                   <div>
                       <p class="mb-0 text-secondary">Booking Status</p>
                       <h6 class="my-1 text-warning">
                        @if ($editData->status == '1')
                        <span class="text-success">Complete</span>
                        @else
                        <span class="text-danger">Pending</span>
                         @endif </h6>

                   </div>
                   <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i class='bx bxs-group'></i>
                   </div>
               </div>
           </div>
        </div>
      </div> 



    </div><!--end row-->

    <div class="row">
       <div class="col-12 col-lg-8 d-flex">
          <div class="card radius-10 w-100">
          
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Room Type</th>
                                <th>Total Room</th>
                                <th>Price</th>
                                <th>Check In / Out Date</th>
                                <th>Total Days</th>
                                <th>Total </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $editData->room->roomType->name }}</td>
                                <td>{{ $editData->number_of_rooms }}</td>
                                <td>${{ $editData->actual_price }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $editData->check_in }}</span>  /<br> 
                                    <span class="badge bg-warning text-dark">{{ $editData->check_out }}</span></td>
                                <td>{{ $editData->total_night }}</td>
                                <td>${{ $editData->actual_price *  $editData->number_of_rooms }}</td>

                            </tr>
                        </tbody>

                    </table>

                    <div class="col-md-6" style="float: right">
                      <div class="col-md-6" style="float: right">
                    <style>
                        .test_table td{text-align: right;}
                    </style>
                    <table class="table test_table" style="float: right" border="none">
                        <tr>
                            <td>Subtotal</td>
                            <td>${{ $editData->subtotal }}</td>
                        </tr>
                        <tr>
                            <td>Discount</td>
                            <td>${{ $editData->discount }}</td>
                        </tr>
                        <tr>
                            <td>Grand Total</td>
                            <td>${{ $editData->total_price }}</td>
                        </tr>
                    </table>

                </div>

                    </div>
                    <!--============end responsive tabe -->

                <form action="{{ route('update.booking.status', $editData->id) }}" method="POST">
                    @csrf
                    <div class="row" style="margin-top: 40px;">
                        <div class="col-md-5">
                            <label for="">Payment Status</label>
                            <select name="payment_status" id="input7" class="form-select">
                                <option selected="">Select Status..</option>
                                <option value="0" {{ $editData->payment_status == 0 ? 'selected':''}}> Pending </option>
                                <option value="1" {{ $editData->payment_status == 1?'selected':''}}>Complete </option> 
                            </select>
                        </div>


                        <div class="col-md-5">
                            <label for="">Booking Status</label>
                            <select name="status" id="input7" class="form-select">
                                <option selected="">Select Status..</option>
                                <option value="0" {{ $editData->status == 0 ? 'selected':''}}> Pending </option>
                                <option value="1" {{ $editData->status == 1 ?'selected':''}}>Complete </option> 
                            </select>
                        </div>

                        <div class="col-md-12" style="margin-top: 20px;">
                            <button type="submit" class="btn btn-primary">Update</button> 
                        </div>

                    </div>
                </form> 
        </div>  


        </div>
          </div>




       </div>
       <div class="col-12 col-lg-4 ">
        <div class="card radius-10 w-100">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Manage Room Date</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label for="" >CheckIn</label>
                            <input value="{{ $editData->check_in }}" type="date" required name="check_in" class="form-control">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="" >CheckOut</label>
                            <input value="{{ $editData->check_out }}" type="date" required name="check_out" class="form-control">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="" >Room </label>
                            <input value="{{ $editData->number_of_rooms }}" type="number" required name="number_of_rooms" class="form-control">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="" >Availablity: <span class="text-success availablity " id="availablity"></span> </label>
                        </div>

                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary"> Update </button>
                        </div>

                        
                    </div>
                </form>
           </div>
       </div>


        <div class="card radius-10 w-100">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Customer Information</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">Name <span class="badge bg-success rounded-pill">{{ $editData['user']['name'] }}</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Email <span class="badge bg-danger rounded-pill">{{ $editData['user']['email'] }} </span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Phone <span class="badge bg-primary rounded-pill">{{ $editData['user']['phone'] }}</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Country <span class="badge bg-warning text-dark rounded-pill">{{ $editData->country }}</span>
                    </li>

                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">State <span class="badge bg-success rounded-pill">{{ $editData->state }}</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Zip Code <span class="badge bg-danger rounded-pill"> {{ $editData->zip_code }} </span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Address <span class="badge bg-danger rounded-pill"> {{ $editData->address }} </span>
                    </li>


                </ul>
            </div>
        </div>
        <!---END card radius-10 w-100------------>

    </div><!--end row-->






</div>

@endsection