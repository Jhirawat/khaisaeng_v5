@extends('layouts.main_user')

@section('style')
<style>
    /* เพิ่ม CSS ของคุณที่นี่ */
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

                <!-- Checkout Customer Address Starts -->
                <h6><i class="step-icon step feather icon-home"></i>ที่อยู่ของคุณ</h6>

                <fieldset class="checkout-step-2 px-0">
                    <section id="checkout-address" class="list-view product-checkout">
                        <div class="card">
                            <div class="card-header flex-column align-items-start">
                                <h4 class="card-title">เพิ่มที่อยู่ใหม่</h4>
                                <!-- <p class="text-muted mt-25">Be sure to check "Deliver to this address" when you have finished</p> -->
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form action="{{ route('store.useraddress') }}" method="POST"
                                        enctype="multipart/form-data">
                                        <fieldset>
                                            @csrf
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
                                                        <input type="number" class="form-control required" name="phone">
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
                                                        <select id="provinces" class="form-control">
                                                            <option value="">กรุณาเลือก</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="districts">อำเภอ:</label>
                                                        <select id="districts" class="form-control">
                                                            <option value="">กรุณาเลือกจังหวัดก่อน</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="subdistricts">ตำบล:</label>
                                                        <select id="subdistricts" class="form-control">
                                                            <option value="">กรุณาเลือกอำเภอก่อน</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="postcode">รหัสไปรษณีย์:</label>
                                                        <input type="text" id="postcode" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="add-type">ประเภทสถานที่:</label>
                                                        <select class="form-control" name="address_type">
                                                            <option>บ้าน</option>
                                                            <option>สำนักงาน</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('address.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- form fields here -->
    <button type="submit">บันทึกที่อยู่</button>
</form>
                                </div>
                            </div>
                </fieldset>
            </div>
            </form>
            </section>
            </fieldset>
            <!-- ShowAddressLL start -->
            <div class="row justify-content-center">
                <div class="col-12">
                    <section id="ecommerce-products" class="grid-view">
                        <div class="row"></div>
                    </section>
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
