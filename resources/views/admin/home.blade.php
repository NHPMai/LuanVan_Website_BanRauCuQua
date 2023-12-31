@extends('admin.main')

@section('content')


<!-- <div class="row">
  <form autocomplete="off" style="display: flex;">
    @csrf
    <div class="col-3">
      <p>Từ ngày: <input type="text" id="datepicker" style="width: 150px"> </p>

    </div>

    <div class="col-3">
      <p>Đến ngày: <input type="text" id="datepicker2" style="width: 140px"> </p>
    </div>

    <div class="col-3">
      <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
    </div>

    <div class="col-3">
      <p>Lọc theo:
        <select class="dashboard-filter">
          <option>--Chọn--</option>
          <option value="7ngay">7 ngày qua</option>
          <option value="thangtruoc">Tháng trước</option>
          <option value="thangnay">Tháng này
          <option value="quy1">Quý 1</option>
          <option value="quy2">Quý 2</option>
          <option value="quy3">Quý 3</option>
          <option value="quy4">Quý 4</option>
          {{--<option value="365ngayqua">365 ngày qua</option>--}}
        </select>
      </p>
    </div>
  </form>
  {{-- </div>--}}
</div>

<div class="col-12">
  <div id="chart" style="height: 250px;"></div>
</div> -->

@if (Auth('admin')->user()->email == 'admin@gmail.com')


<div class="row" style="margin-bottom: 20px;">

  <div class="col-lg-3 col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3>Sản Phẩm</h3>

        <p style="font-weight:bold; font-size: 20px; ">Tổng: {{$products->count()}}</p> 
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="/admin/products/list" class="small-box-footer">Chi Tiết <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>


  <div class="col-lg-3 col-6">
    <div class="small-box bg-success">
      <div class="inner">
        <h3>Nhà Cung Cấp<sup style="font-size: 20px">%</sup></h3>
        <p style="font-weight:bold; font-size: 20px; ">Tổng: {{$suppliers->count()}}</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="/admin/suppliers/list" class="small-box-footer">Chi Tiết <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>


  <div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>Đơn Hàng</h3>
        <p style="font-weight:bold; font-size: 20px; ">Tổng: {{$donhangs->count()}}</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="/admin/customers" class="small-box-footer">Chi Tiết <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>


  <div class="col-lg-3 col-6">
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>Kho Hàng</h3>
        <p style="font-weight:bold; font-size: 20px; ">Tổng:  {{$warehouses->count()}}</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="/admin/warehouses/list" class="small-box-footer">Chi Tiết<i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>

<div>
  <section class=" connectedSortable">
    <div class="card ">
      <div class="card-header border-0">

        <h3 class="card-title btn btn-dark btn-sm">
          <i class="fas fa-chart-pie"></i>
          Biểu Đồ
        </h3>

        <div class="card-tools">
          <!-- <div class="btn-group">
            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
              <i class="fas fa-bars"></i>
            </button>
            <div class="dropdown-menu" role="menu">
              <a href="#" class="dropdown-item">Add new event</a>
              <a href="#" class="dropdown-item">Clear events</a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">View calendar</a>
            </div>
          </div> -->
          <button type="button" class="btn btn-dark btn-sm" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-dark btn-sm" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <hr style="margin-top:0">
      <div class="card-body pt-0">
        <div class="row">
          <form autocomplete="off" style="display: flex;">
            @csrf
            <div class="col-3">
              <p style="font-weight: 600; font-size:18px">Từ ngày: <input type="text" id="datepicker" style="width: 150px"> </p>

            </div>

            <div class="col-3">
              <p style="font-weight: 600; font-size:18px">Đến ngày: <input type="text" id="datepicker2" style="width: 140px"> </p>
            </div>

            <div class="col-3">
              <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả" style="margin-top: 25px; text-align:center">
            </div>

            <div class="col-3">
              <p style="font-weight: 600; font-size:18px">Lọc theo:
                <select class="dashboard-filter">
                  <option>--Chọn--</option>
                  <option value="7ngay">7 ngày qua</option>
                  <option value="thangtruoc">Tháng trước</option>
                  <option value="thangnay">Tháng này
                  <option value="quy1">Quý 1</option>
                  <option value="quy2">Quý 2</option>
                  <option value="quy3">Quý 3</option>
                  <option value="quy4">Quý 4</option>
                </select>
              </p>
            </div>
          </form>
        </div>

        <div class="col-12">
          <div id="chart" style="height: 250px;"></div>
        </div>

      </div>
    </div>

  </section>
</div>

@endif

<!-- <div class="container-fluid">

  <div class="row">

    <div class="col-lg-3 col-6">
      <div class="small-box bg-info">
        <div class="inner">
          <h3>Sản Phẩm</h3>

          <p style="font-weight:bold; font-size: 20px; ">Tổng:</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="/admin/products/list" class="small-box-footer">Chi Tiết <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>


    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>Nhà Cung Cấp<sup style="font-size: 20px">%</sup></h3>
          <p style="font-weight:bold; font-size: 20px; ">Tổng: </p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="/admin/suppliers/list" class="small-box-footer">Chi Tiết <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>


    <div class="col-lg-3 col-6">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>Đơn Hàng</h3>
          <p style="font-weight:bold; font-size: 20px; ">Tổng: </p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="/admin/customers" class="small-box-footer">Chi Tiết <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>


    <div class="col-lg-3 col-6">
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>Kho Hàng</h3>
          <p style="font-weight:bold; font-size: 20px; ">Tổng: </p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="/admin/warehousings/list" class="small-box-footer">Chi Tiết<i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

  </div>

  <div class="row">
   
    <section class="col-lg-7 connectedSortable">

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <i class="ion ion-clipboard mr-1"></i>
            Danh Sách Công Việc
          </h3>
        </div>
        
        <div class="card-body">
          <ul class="todo-list" data-widget="todo-list">
            <li>
              
              <span class="handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
              </span>
              
              <div class="icheck-primary d-inline ml-2">
                <input type="checkbox" value="" name="todo1" id="todoCheck1">
                <label for="todoCheck1"></label>
              </div>
             
              <span class="text">Kiểm tra đơn hàng</span>
              
              <small class="badge badge-danger"><i class="far fa-clock"></i> 2 giờ</small>
              
              <div class="tools">
                <i class="fas fa-edit"></i>
                <i class="fas fa-trash-o"></i>
              </div>
            </li>
            <li>
              <span class="handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
              </span>
              <div class="icheck-primary d-inline ml-2">
                <input type="checkbox" value="" name="todo2" id="todoCheck2" checked>
                <label for="todoCheck2"></label>
              </div>
              <span class="text">Kiểm tra hàng hóa</span>
              <small class="badge badge-info"><i class="far fa-clock"></i> 3 giờ</small>
              <div class="tools">
                <i class="fas fa-edit"></i>
                <i class="fas fa-trash-o"></i>
              </div>
            </li>
            <li>
              <span class="handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
              </span>
              <div class="icheck-primary d-inline ml-2">
                <input type="checkbox" value="" name="todo3" id="todoCheck3">
                <label for="todoCheck3"></label>
              </div>
              <span class="text">Cập nhật sản phẩm</span>
              <small class="badge badge-warning"><i class="far fa-clock"></i> 1 day</small>
              <div class="tools">
                <i class="fas fa-edit"></i>
                <i class="fas fa-trash-o"></i>
              </div>
            </li>
            <li>
              <span class="handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
              </span>
              <div class="icheck-primary d-inline ml-2">
                <input type="checkbox" value="" name="todo4" id="todoCheck4">
                <label for="todoCheck4"></label>
              </div>
              <span class="text">Cập nhật kho hàng</span>
              <small class="badge badge-success"><i class="far fa-clock"></i> 3 days</small>
              <div class="tools">
                <i class="fas fa-edit"></i>
                <i class="fas fa-trash-o"></i>
              </div>
            </li>
            <li>
              <span class="handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
              </span>
              <div class="icheck-primary d-inline ml-2">
                <input type="checkbox" value="" name="todo5" id="todoCheck5">
                <label for="todoCheck5"></label>
              </div>
              <span class="text">Cập nhật trang người dùng</span>
              <small class="badge badge-primary"><i class="far fa-clock"></i> 1 week</small>
              <div class="tools">
                <i class="fas fa-edit"></i>
                <i class="fas fa-trash-o"></i>
              </div>
            </li>
            <li>
              <span class="handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
              </span>
              <div class="icheck-primary d-inline ml-2">
                <input type="checkbox" value="" name="todo6" id="todoCheck6">
                <label for="todoCheck6"></label>
              </div>
              <span class="text">Đọc đánh giá khách hàng</span>
              <small class="badge badge-secondary"><i class="far fa-clock"></i> 1 month</small>
              <div class="tools">
                <i class="fas fa-edit"></i>
                <i class="fas fa-trash-o"></i>
              </div>
            </li>
          </ul>
        </div>
       
        <div class="card-footer clearfix">
          <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add item</button>
        </div>
      </div>
  
    </section>
   
    <section class="col-lg-5 connectedSortable">

  
      <div class="card bg-gradient-primary">
        <div class="card-header border-0">
          <h3 class="card-title">
            <i class="fas fa-map-marker-alt mr-1"></i>
            Visitors
          </h3>
         
          <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
              <i class="far fa-calendar-alt"></i>
            </button>
            <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
          
        </div>

        <div class="card-body">
          <div id="world-map" style="height: 250px; width: 100%;"></div>
        </div>
       
        <div class="card-footer bg-transparent">
          <div class="row">
            <div class="col-4 text-center">
              <div id="sparkline-1"></div>
              <div class="text-white">Visitors</div>
            </div>
          
            <div class="col-4 text-center">
              <div id="sparkline-2"></div>
              <div class="text-white">Online</div>
            </div>
        
            <div class="col-4 text-center">
              <div id="sparkline-3"></div>
              <div class="text-white">Sales</div>
            </div>
            
          </div>
        </div>
      </div>
     

      <div class="card bg-gradient-success">
        <div class="card-header border-0">

          <h3 class="card-title">
            <i class="far fa-calendar-alt"></i>
            Calendar
          </h3>
        
          <div class="card-tools">
            <div class="btn-group">
              <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                <i class="fas fa-bars"></i>
              </button>
              <div class="dropdown-menu" role="menu">
                <a href="#" class="dropdown-item">Add new event</a>
                <a href="#" class="dropdown-item">Clear events</a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">View calendar</a>
              </div>
            </div>
            <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
      
        <div class="card-body pt-0">
          <div id="calendar" style="width: 100%"></div>
        </div>
      </div>

    </section>
 
  </div>

</div> -->
@endsection