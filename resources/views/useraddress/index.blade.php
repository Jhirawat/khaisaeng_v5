@extends('layouts.main_user')

@section('style')
<style>
    /* เพิ่ม CSS ของคุณที่นี่ */
    .address-container {
        border: 1px solid #ddd;
        padding: 15px;
        margin-top: 20px;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .address-container h4 {
        margin-bottom: 15px;
    }

    .address-container p {
        margin-bottom: 5px;
        font-size: 14px;
    }
</style>
@endsection

@section('head')
<title>locations</title>
@endsection

@section('content')

<div class="2-columns ecommerce-application navbar-floating footer-static">
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">ที่อยู่</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="home">หน้าหลัก</a>
                                    </li>
                                    <li class="breadcrumb-item">ที่อยู่
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Checkout Customer Address Starts -->
                <h6><i class="step-icon step feather icon-home"></i>ที่อยู่ของคุณ</h6>

                <fieldset class="checkout-step-2 px-0">
                    <section id="checkout-address" class="list-view product-checkout">
                        <div class="card">
                            <div class="card-header flex-column align-items-start">
                                <h4 class="card-title">เพิ่มที่อยู่ใหม่</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form action="{{ route('store.useraddress') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="checkout-name">ชื่อจริง:</label>
                                                        <input type="text" class="form-control required" name="name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="checkout-number">หมายเลขโทรศัพท์:</label>
                                                        <input type="text" class="form-control required" name="phone">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="checkout-apt-number">บ้านเลขที่:</label>
                                                        <input type="text" class="form-control required" name="address">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="provinces">จังหวัด:</label>
                                                        <select id="provinces" class="form-control" name="province_id">
                                                            <option value="">กรุณาเลือก</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="districts">อำเภอ:</label>
                                                        <select id="districts" class="form-control" name="district_id">
                                                            <option value="">กรุณาเลือกจังหวัดก่อน</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="subdistricts">ตำบล:</label>
                                                        <select id="subdistricts" class="form-control"
                                                            name="subdistrict_id">
                                                            <option value="">กรุณาเลือกอำเภอก่อน</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="postcode">รหัสไปรษณีย์:</label>
                                                        <input type="text" id="postcode" class="form-control"
                                                            name="postcode" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="add-type">ประเภทสถานที่:</label>
                                                        <select class="form-control" name="address_type">
                                                            <option value="บ้าน">บ้าน</option>
                                                            <option value="สำนักงาน">สำนักงาน</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <button style="background-color: #257d0f ;color:white" class="btn"
                                                type="submit">บันทึกที่อยู่</button>
                                        </fieldset>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </section>
                </fieldset>

                <!-- แสดงรายการที่อยู่ -->
                <div class="row justify-content-center">
                    <div class="col-12">
                        <section id="ecommerce-products" class="grid-view">
                            <div class="row">
                                @foreach($addresses as $address)
                                    <div class="col-md-4 col-sm-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">{{ $address->name }}</h4>
                                            </div>
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <p>หมายเลขโทรศัพท์: {{ $address->phone }}</p>
                                                    <p>บ้านเลขที่: {{ $address->address }}</p>
                                                    <p>ตำบล: {{ $address->subdistrict->name }}</p>
                                                    <p>อำเภอ: {{ $address->district->name }}</p>
                                                    <p>จังหวัด: {{ $address->province->name }}</p>
                                                    <p>รหัสไปรษณีย์: {{ $address->postcode }}</p>
                                                    <p>ประเภทสถานที่: {{ $address->address_type }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    </div>
                </div>



                <!-- แสดงรายการที่อยู่ end -->

                <div class="col-md-4">
                    <div class="small-box address-container">
                        <h4>ที่อยู่ที่บันทึกไว้</h4>
                        @if($addresses->isEmpty())
                            <p>ยังไม่มีที่อยู่</p>
                        @else
                            @foreach($addresses as $address)
                                <p>{{ $address->name }} - {{ $address->phone }}</p>
                                <p>{{ $address->address }}</p>
                                <p>ตำบล: {{ $address->subdistrict->name }} -</p>
                                <p>อำเภอ: {{ $address->district->name }}</p>
                                <p>จังหวัด: {{ $address->province->name }}</p>
                                <p>รหัสไปรษณีย์: {{ $address->postcode }}</p>
                                <hr>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        loadProvinces();

        document.getElementById('provinces').addEventListener('change', function () {
            const provinceId = this.value;
            loadDistricts(provinceId);
        });

        document.getElementById('districts').addEventListener('change', function () {
            const districtId = this.value;
            loadSubdistricts(districtId);
        });

        document.getElementById('subdistricts').addEventListener('change', function () {
            const subdistrictId = this.value;
            loadPostalCode(subdistrictId);
        });
    });

    function loadProvinces() {
        fetch('/api/provinces')
            .then(response => response.json())
            .then(data => {
                const provinceSelect = document.getElementById('provinces');
                provinceSelect.innerHTML = '<option value="">กรุณาเลือก</option>';
                for (const [id, name] of Object.entries(data)) {
                    provinceSelect.innerHTML += `<option value="${id}">${name}</option>`;
                }
            })
            .catch(error => console.error('เกิดข้อผิดพลาดในการดึงข้อมูลจังหวัด:', error));
    }

    function loadDistricts(provinceId) {
        fetch(`/api/districts/${provinceId}`)
            .then(response => response.json())
            .then(data => {
                const districtSelect = document.getElementById('districts');
                districtSelect.innerHTML = '<option value="">กรุณาเลือก</option>';
                for (const [id, name] of Object.entries(data)) {
                    districtSelect.innerHTML += `<option value="${id}">${name}</option>`;
                }
            })
            .catch(error => console.error('เกิดข้อผิดพลาดในการดึงข้อมูลอำเภอ:', error));
    }

    function loadSubdistricts(districtId) {
        fetch(`/api/subdistricts/${districtId}`)
            .then(response => response.json())
            .then(data => {
                const subdistrictSelect = document.getElementById('subdistricts');
                subdistrictSelect.innerHTML = '<option value="">กรุณาเลือก</option>';
                for (const [id, name] of Object.entries(data)) {
                    subdistrictSelect.innerHTML += `<option value="${id}">${name}</option>`;
                }
            })
            .catch(error => console.error('เกิดข้อผิดพลาดในการดึงข้อมูลตำบล:', error));
    }

    function loadPostalCode(subdistrictId) {
        fetch(`/api/subdistricts/${subdistrictId}/postal-code`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('postcode').value = data.postal_code;
            })
            .catch(error => console.error('เกิดข้อผิดพลาดในการดึงข้อมูลรหัสไปรษณีย์:', error));
    }
</script>
@endsection