@extends('backend/layouts/admin/template')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
<style>
    .member-list h4 {
        color: #fff;
    }

    .member-list p {
        font-size: 14px;
    }

    .member-list span {
        font-size: 14px;
        color: red;
        font-weight: bold;
    }

    .member-list h6 {
        text-align: center;
    }

    .header h4 {
        color: #fff;
        border-bottom: 2px solid #eeeeee;
        padding-bottom: 15px;
    }
</style>
@section('content')
    @php

        $count_member = number_format(DB::table('members')->where('invitation', null)->count());
        $count_member_online = number_format(
            DB::table('members')->where('status', 'online')->where('invitation', null)->count(),
        );
        $count_member_offline = number_format(
            DB::table('members')->where('status', '!=', 'online')->where('invitation', null)->count(),
        );

    @endphp
    <div class="container-fluid py-4">
        <div class="header">
            <h4>ข้อมูลสมาชิก</h4>
        </div>
        <div class="member-list">
            <div class="row">
                <div class="col-lg-5 mt-4 mb-lg-0 mb-4">
                    <form action="{{ url('/search-member-list') }}">
                        <div class="card z-index-2">
                            <div class="card-header pb-0 pt-3 bg-transparent">
                                <h6 class="text-capitalize">ค้นหาเบอร์โทรศัพท์</h6>
                                <div class="row mb-2">
                                    <div class="col-md-9">
                                        <input class="phone_format form-control" type="text"
                                            placeholder="ค้นหาเบอร์โทรศัพท์" name="search">
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-outline-primary" type="submit"
                                            id="button-addon2">ค้นหาข้อมูล</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5 mt-4 mb-lg-0 mb-4">
                    <div class="card z-index-2">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h6 class="text-capitalize">ระดับของสมาชิก
                                <a data-bs-toggle="modal" data-bs-target="#settingTier" data-bs-toggle="modal"
                                    data-bs-target="#settingTier">
                                    <span><i class="ni ni-settings" aria-hidden="true"></i></span>
                                </a>
                            </h6>
                            @php
                                $tiers = DB::table('tiers')->get();
                            @endphp
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <select name="tier" id="tier" class="form-control">
                                        @foreach ($tiers as $tier => $value)
                                            <option value="{{ $value->tier }}">{{ $value->tier }} ({{ $value->detail }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-4">

        <div class="member-list">
            <div class="row">

                <div class="col-md-2">
                    <div class="card z-index-2 h-100">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <a href="{{ url('/member/list') }}">
                                <h6 class="text-capitalize">ลูกค้าทั้งหมด <span>( {{ $count_member }} )</span></h6>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card z-index-2 h-100">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <a href="{{ url('/member/list/status-on') }}">
                                <h6 class="text-capitalize">ใช้งานได้ <span>( {{ $count_member_online }} )</span></h6>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card z-index-2 h-100">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <a href="{{ url('/member/list/status-off') }}">
                                <h6 class="text-capitalize">ไม่สามารถใช้งานได้ <span>( {{ $count_member_offline }} )</span>
                                </h6>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-lg-0 mb-4 mt-4">
                    <div class="card z-index-2 h-100">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h5 class="text-capitalize">รายชื่อสมาชิก (ข้อมูลทั้งหมด)</h5>
                        </div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table align-items-center" id="filter-table">
                                    <thead class="thead-light">
                                        <tr style="text-align: center;">
                                            <th>ลำดับ</th>
                                            <th>หมายเลขสมาชิก</th>
                                            <th>เบอร์โทร</th>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>พอยท์</th>
                                            <th>ระดับสมาชิก</th>
                                            <th>วันที่สมัคร</th>
                                            <th>สถานะ</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="data-wrapper">
                                        @include('backend/admin/member/data')
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Data Loader -->

                <div class="auto-load text-center" style="display: none;">

                    <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="60" viewBox="0 0 100 100"
                        enable-background="new 0 0 0 0" xml:space="preserve">

                        <path fill="#000"
                            d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">

                            <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                                from="0 50 50" to="360 50 50" repeatCount="indefinite" />

                        </path>

                    </svg>

                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="settingTier" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ url('addtier') }}" method="POST" enctype="multipart/form-data" class="modal-content">@csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="settingTierTitle">เพิ่มระดับสมาชิก</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">ชื่อระดับ</label>
                            <input type="text" name="tier" class="form-control"
                                placeholder="เช่น SILVER, GOLD, BLACK" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">คำอธิบายระดับสมาชิก</label>
                            <textarea name="detail" class="form-control"
                                placeholder="เช่น ระดับ SILVER สมาชิกที่มียอดค่าใช้จ่ายตั้งแต่ 0-200000 บาท"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">ยอดค่าใช้จ่ายเริ่มต้น</label>
                            <input type="text" name="min_price" class="form-control"
                                placeholder="เช่น 0 ( ยอดสะสมที่เป็นค่าเริ่มต้นของระดับ SILVER ยอดค่าใช้จ่าย 0.- )" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">ยอดค่าใช้จ่ายสูงสุด</label>
                            <input type="text" name="max_price" class="form-control"
                                placeholder="เช่น 200000 ( ยอดสะสมที่เป็นค่าสูงสุดของระดับ ยอดค่าใช้จ่าย 200000.- )" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                        style="font-family:'Noto Sans Thai';">ปิด</button>
                    <button type="submit" class="btn btn-primary"
                        style="font-family:'Noto Sans Thai';">เพิ่มระดับสมาชิก</button>
                </div>
            </form>
        </div>
    </div>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        // number phone
        function phoneFormatter() {
            $('input.phone_format').on('input', function() {
                var number = $(this).val().replace(/[^\d]/g, '')
                if (number.length >= 5 && number.length < 10) {
                    number = number.replace(/(\d{3})(\d{2})/, "$1-$2");
                } else if (number.length >= 10) {
                    number = number.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3");
                }
                $(this).val(number)
                $('input.phone_format').attr({
                    maxLength: 12
                });
            });
        };
        $(phoneFormatter);
    </script>

    <script>
        $(document).ready(function() {
            $("#tier").on('change', function() {
                var input, filter, table, tr, td, i, txtValue;

                input = document.getElementById("tier");
                filter = input.value.toUpperCase();
                table = document.getElementById("filter-table");
                tr = table.getElementsByTagName("tr");

                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[5];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            });
        });
    </script>

    <script>
        var ENDPOINT = "{{ route('member-list') }}";
        var page = 1;

        // Call on Scroll
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {
                page++;
                infinteLoadMore(page);
            }
        });

        // call infinteLoadMore()
        function infinteLoadMore(page) {
            $.ajax({
                    url: ENDPOINT + "?page=" + page,
                    datatype: "html",
                    type: "get",
                    beforeSend: function() {
                        $('.auto-load').show();
                    }
                })
                .done(function(response) {
                    if (response.html == '') {
                        $('.auto-load').html("We don't have more data to display :(");
                        return;
                    }
                    $('.auto-load').hide();
                    $("#data-wrapper").append(response.html);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }
    </script>
@endsection
